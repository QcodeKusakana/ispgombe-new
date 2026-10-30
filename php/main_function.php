<?php
// Database credentials are supplied by the hosting environment, never stored in source.
// Keep technical errors in server logs; never expose paths or SQL details to visitors.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
$secureCookie = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.gc_maxlifetime', '1800');
    session_set_cookie_params([
        'httponly' => true,
        'secure' => $secureCookie,
        'samesite' => 'Lax',
        'path' => '/',
    ]);
    session_start();
}
if (!empty($_SESSION['LAST_ACTIVITY']) && (time() - (int) $_SESSION['LAST_ACTIVITY']) > 1800) {
    $_SESSION = [];
    session_regenerate_id(true);
}
$_SESSION['LAST_ACTIVITY'] = time();

/**
 * Return a stable private key for opaque URL identifiers.
 * Production deployments can provide ISPGOMBE_URL_ID_KEY; local installations
 * get a machine-local key stored outside the web root.
 */
function opaque_url_id_key(): ?string
{
    $configured = getenv('ISPGOMBE_URL_ID_KEY');
    if (is_string($configured) && strlen($configured) >= 32) {
        return hash('sha256', $configured, true);
    }

    static $key = null;
    if (is_string($key)) {
        return $key;
    }

    $root = realpath(dirname(__DIR__));
    if ($root === false) {
        return null;
    }
    $directory = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'ispgombe-url-keys';
    if (!is_dir($directory) && !@mkdir($directory, 0700, true) && !is_dir($directory)) {
        return null;
    }
    $path = $directory . DIRECTORY_SEPARATOR . hash('sha256', $root) . '.key';
    $handle = @fopen($path, 'c+b');
    if (!$handle || !flock($handle, LOCK_EX)) {
        if (is_resource($handle)) { fclose($handle); }
        return null;
    }
    rewind($handle);
    $stored = stream_get_contents($handle);
    if (!is_string($stored) || strlen($stored) !== 32) {
        $stored = random_bytes(32);
        rewind($handle);
        ftruncate($handle, 0);
        fwrite($handle, $stored);
        fflush($handle);
        @chmod($path, 0600);
    }
    flock($handle, LOCK_UN);
    fclose($handle);
    $key = $stored;
    return $key;
}

/** Encrypt a positive database identifier and bind the token to its parameter name. */
function opaque_url_id_encode($identifier, string $parameter): string
{
    $id = filter_var($identifier, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $key = opaque_url_id_key();
    if ($id === false || $id === null || $key === null || !function_exists('openssl_encrypt')) {
        return (string) $identifier;
    }
    $iv = random_bytes(12);
    $tag = '';
    $ciphertext = openssl_encrypt((string) $id, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag, 'ispgombe:url-id:' . $parameter, 16);
    if (!is_string($ciphertext)) {
        return (string) $identifier;
    }
    return 'oid_' . rtrim(strtr(base64_encode($iv . $tag . $ciphertext), '+/', '-_'), '=');
}

/** Decode a signed/authenticated URL identifier; null means invalid or altered. */
function opaque_url_id_decode(string $token, string $parameter): ?int
{
    if (!str_starts_with($token, 'oid_')) {
        return null;
    }
    $key = opaque_url_id_key();
    $encoded = substr($token, 4);
    $raw = base64_decode(strtr($encoded, '-_', '+/') . str_repeat('=', (4 - strlen($encoded) % 4) % 4), true);
    if ($key === null || !is_string($raw) || strlen($raw) < 29 || !function_exists('openssl_decrypt')) {
        return null;
    }
    $iv = substr($raw, 0, 12);
    $tag = substr($raw, 12, 16);
    $ciphertext = substr($raw, 28);
    $plain = openssl_decrypt($ciphertext, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag, 'ispgombe:url-id:' . $parameter);
    $id = is_string($plain) ? filter_var($plain, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) : false;
    return $id === false || $id === null ? null : (int) $id;
}

/** Decode opaque IDs before legacy controllers read their usual $_GET fields. */
function opaque_url_ids_normalize_query(array $parameters): void
{
    foreach ($parameters as $parameter) {
        if (isset($_GET[$parameter]) && is_string($_GET[$parameter]) && str_starts_with($_GET[$parameter], 'oid_')) {
            $decoded = opaque_url_id_decode($_GET[$parameter], $parameter);
            $_GET[$parameter] = $decoded === null ? '' : (string) $decoded;
        }
    }
}

/** Redirect legacy numeric ID URLs once so the address bar also uses opaque IDs. */
function opaque_url_ids_canonicalize_request(array $parameters): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET' || headers_sent()) {
        return;
    }
    $query = (string) ($_SERVER['QUERY_STRING'] ?? '');
    if ($query === '') {
        return;
    }
    $updated = preg_replace_callback(
        '/(^|&|&amp;)(' . implode('|', $parameters) . ')=([1-9][0-9]*)(?=(?:&|&amp;|#|$))/i',
        static function (array $match): string {
            return $match[1] . $match[2] . '=' . rawurlencode(opaque_url_id_encode($match[3], $match[2]));
        },
        $query
    );
    if (!is_string($updated) || $updated === $query) {
        return;
    }
    $path = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
    if (!is_string($path) || $path === '' || $path[0] !== '/') {
        return;
    }
    header('Location: ' . $path . '?' . $updated, true, 302);
    exit;
}

/** Rewrite numeric ID parameters in generated HTML links without touching unrelated query values. */
function opaque_url_ids_rewrite_html(string $html): string
{
    $key = opaque_url_id_key();
    if ($key === null || !function_exists('openssl_encrypt')) {
        return $html;
    }
    $parameters = ['id', 'ID', 'edit', 'dep', 'info', 'fac', 'ss', 'niv'];
    return preg_replace_callback(
        '/((?:\\?|&|&amp;))(' . implode('|', $parameters) . ')=([1-9][0-9]*)(?=(?:&|&amp;|#|["\'<>\\s]|$))/i',
        static function (array $match): string {
            return $match[1] . $match[2] . '=' . rawurlencode(opaque_url_id_encode($match[3], $match[2]));
        },
        $html
    ) ?? $html;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_is_valid($token): bool
{
    return is_string($token) && isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Per-network and per-identifier login throttling stored outside the public webroot.
 * Failed attempts are keyed by a one-way digest; no username or address is persisted.
 */
function auth_rate_limit(string $scope, string $identifier, bool $recordFailure = false, bool $clear = false): bool
{
    $remote = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    $keys = [
        hash('sha256', $scope . "\0account\0" . strtolower(trim($identifier)) . "\0" . $remote),
        hash('sha256', $scope . "\0network\0" . $remote),
    ];
    $directory = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'ispgombe-auth-limits';
    if (!is_dir($directory) && !@mkdir($directory, 0700, true) && !is_dir($directory)) {
        // Fail closed for login when the throttle cannot be persisted.
        return false;
    }
    $path = $directory . DIRECTORY_SEPARATOR . 'limits.json';
    $handle = @fopen($path, 'c+');
    if (!$handle || !flock($handle, LOCK_EX)) {
        if (is_resource($handle)) { fclose($handle); }
        return false;
    }
    rewind($handle);
    $states = json_decode((string) stream_get_contents($handle), true);
    $states = is_array($states) ? $states : [];
    $now = time();
    foreach ($states as $storedKey => $state) {
        if (!is_array($state) || (int) ($state['started'] ?? 0) < $now - 900) {
            unset($states[$storedKey]);
        }
    }
    foreach ($keys as $key) {
        $states[$key] ??= ['started' => $now, 'failures' => 0];
    }
    foreach ($keys as $key) {
        if ($clear) {
            $states[$key] = ['started' => $now, 'failures' => 0];
        } elseif ($recordFailure) {
            $states[$key]['failures'] = min(100, (int) $states[$key]['failures'] + 1);
        }
    }
    $allowed = true;
    foreach ($keys as $key) {
        if ((int) $states[$key]['failures'] >= 8) { $allowed = false; }
    }
    if (count($states) > 8192) {
        uasort($states, static fn(array $left, array $right): int => (int) ($left['started'] ?? 0) <=> (int) ($right['started'] ?? 0));
        $states = array_slice($states, -8192, null, true);
    }
    rewind($handle);
    ftruncate($handle, 0);
    fwrite($handle, json_encode($states));
    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);
    return $allowed;
}

function admin_handle_record_action(PDO $database, string $page, string $table, string $idColumn, array $actions, array $scope = []): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST' || !isset($_POST['admin_action'])) {
        return;
    }
    if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('Jeton de sécurité invalide. Rechargez la page.');
    }
    $action = is_string($_POST['admin_action']) ? $_POST['admin_action'] : '';
    $id = filter_var($_POST['record_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($id === false || $id === null || !array_key_exists($action, $actions)) {
        http_response_code(400);
        exit('Action invalide.');
    }
    $identifiers = [$table, $idColumn];
    foreach ($scope as $column => $condition) {
        $identifiers[] = $column;
        if (!is_array($condition) || !in_array($condition[0] ?? null, ['=', '!=', '<>', '>', '<'], true)) {
            throw new LogicException('Invalid internal action scope.');
        }
    }
    foreach ($identifiers as $identifier) {
        if (!is_string($identifier) || !preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $identifier)) {
            throw new LogicException('Invalid internal SQL identifier.');
        }
    }
    $where = "`{$idColumn}` = ?";
    $values = [(int) $id];
    foreach ($scope as $column => [$operator, $value]) {
        $where .= " AND `{$column}` {$operator} ?";
        $values[] = $value;
    }
    $definition = $actions[$action];
    if ($definition === null) {
        $deleteDependencies = [
            'faculte' => [['departement', 'faculte'], ['personnel', 'faculte'], ['couverture', 'faculte'], ['annonce', 'faculte']],
            'departement' => [['optioner', 'departement'], ['personnel', 'departement'], ['agent_dep', 'departement'], ['couverture', 'departement'], ['annonce', 'departement'], ['etudiant', 'depChoix1'], ['etudiant', 'depChoix2'], ['palmaresetudiant', 'departement']],
            'optioner' => [['promotion', 'optioner'], ['etudiant', 'optioner']],
            'promotion' => [['etudiant', 'promotion'], ['communique', 'promotion']],
        ];
        $references = 0;
        foreach ($deleteDependencies[$table] ?? [] as [$referenceTable, $referenceColumn]) {
            $check = $database->prepare("SELECT COUNT(*) FROM `{$referenceTable}` WHERE `{$referenceColumn}` = ?");
            $check->execute([(int) $id]);
            $references += (int) $check->fetchColumn();
        }
        if ($references > 0) {
            $_SESSION['admin_action_notice'] = 'Suppression refusée : cet élément est encore utilisé par ' . $references . ' enregistrement(s). Modifiez ou supprimez d’abord les éléments liés.';
            header('Location: ?pages=' . rawurlencode($page));
            exit;
        }
        $statement = $database->prepare("DELETE FROM `{$table}` WHERE {$where}");
    } else {
        [$column, $value] = $definition;
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $column)) {
            throw new LogicException('Invalid internal SQL identifier.');
        }
        $statement = $database->prepare("UPDATE `{$table}` SET `{$column}` = ? WHERE {$where}");
        array_unshift($values, $value);
    }
    $statement->execute($values);
    admin_log_action($database, 'record.' . $action, $table, (string) $id, ['changed_rows' => $statement->rowCount()]);
    $_SESSION['admin_action_notice'] = $statement->rowCount() > 0 ? 'Modification enregistrée.' : 'Aucun enregistrement modifié.';
    header('Location: ?pages=' . rawurlencode($page));
    exit;
}

/** Record a sensitive administrator operation without secrets or submitted content. */
function admin_log_action(PDO $database, string $action, string $targetType, ?string $targetId = null, array $details = []): void
{
    $safeDetails = [];
    foreach (['changed_rows', 'field', 'role', 'result'] as $key) {
        if (array_key_exists($key, $details) && is_scalar($details[$key])) {
            $safeDetails[$key] = $details[$key];
        }
    }
    try {
        $statement = $database->prepare('INSERT INTO admin_action_log (actor_id, actor_name, action_name, target_type, target_id, details_json, ip_digest) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
        $statement->execute([
            (int) ($_SESSION['id_adm'] ?? 0),
            mb_substr((string) ($_SESSION['pseudo'] ?? ''), 0, 100, 'UTF-8'),
            mb_substr($action, 0, 100, 'UTF-8'),
            mb_substr($targetType, 0, 100, 'UTF-8'),
            $targetId === null ? null : mb_substr($targetId, 0, 100, 'UTF-8'),
            json_encode($safeDetails, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE),
            hash('sha256', $ip),
        ]);
    } catch (Throwable $exception) {
        // Keep legacy installations working until the corresponding migration is applied.
        error_log('ISP-GOMBE admin audit log unavailable; apply the audit-log migration.');
    }
}
function admin_store_image_upload(array $upload, string $relativeDirectory): string
{
    $maximumBytes = 15 * 1024 * 1024;
    $uploadError = (int) ($upload['error'] ?? UPLOAD_ERR_NO_FILE);
    if ($uploadError !== UPLOAD_ERR_OK) {
        if (in_array($uploadError, [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) {
            throw new RuntimeException('L’image dépasse la taille maximale autorisée de 15 Mo.');
        }
        if ($uploadError === UPLOAD_ERR_NO_FILE) {
            throw new RuntimeException('Choisissez une image puis réessayez.');
        }
        throw new RuntimeException('Le téléversement a échoué. Vérifiez le fichier puis réessayez.');
    }
    if (!isset($upload['tmp_name'], $upload['size']) || !is_uploaded_file($upload['tmp_name'])) {
        throw new RuntimeException('Le fichier reçu n’est pas une image valide.');
    }
    $actualSize = @filesize($upload['tmp_name']);
    if ($actualSize === false || $actualSize < 1 || $actualSize > $maximumBytes) {
        throw new RuntimeException('L’image doit peser au maximum 15 Mo.');
    }
    $image = @getimagesize($upload['tmp_name']);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($upload['tmp_name']);
    $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!$image || !isset($extensions[$mime]) || $image['mime'] !== $mime) {
        throw new RuntimeException('Seuls les fichiers JPG, PNG ou WebP sont acceptés.');
    }
    $projectRoot = realpath(dirname(__DIR__));
    $directory = realpath(dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativeDirectory));
    if ($projectRoot === false || $directory === false || !is_dir($directory) || !str_starts_with($directory, $projectRoot . DIRECTORY_SEPARATOR)) {
        throw new RuntimeException('Le dossier de destination des images est indisponible.');
    }
    $filename = bin2hex(random_bytes(16)) . '.' . $extensions[$mime];
    if (!move_uploaded_file($upload['tmp_name'], $directory . DIRECTORY_SEPARATOR . $filename)) {
        throw new RuntimeException('Le téléversement de l’image a échoué.');
    }
    return $filename;
}

/** Keep a small formatting whitelist for editable rich text; never render submitted HTML directly. */
function admin_sanitize_rich_text(string $html): string
{
    $html = mb_substr($html, 0, 30000, 'UTF-8');
    if (!class_exists(DOMDocument::class)) {
        $plainText = trim(strip_tags($html));
        return $plainText === '' ? '' : '<p>' . nl2br(htmlspecialchars($plainText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) . '</p>';
    }

    $previousErrorMode = libxml_use_internal_errors(true);
    $document = new DOMDocument('1.0', 'UTF-8');
    $document->loadHTML('<!doctype html><html><head><meta charset="utf-8"></head><body><div id="rich-text-root">' . $html . '</div></body></html>');
    libxml_clear_errors();
    libxml_use_internal_errors($previousErrorMode);
    $root = null;
    foreach ($document->getElementsByTagName('div') as $element) {
        if ($element->getAttribute('id') === 'rich-text-root') {
            $root = $element;
            break;
        }
    }
    if (!$root) {
        return '';
    }

    $allowedTags = ['p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'del', 'ul', 'ol', 'li', 'h2', 'h3', 'blockquote', 'a', 'div', 'span', 'pre', 'code', 'hr', 'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td'];
    $discardTags = ['script', 'style', 'iframe', 'object', 'embed', 'svg', 'math', 'template', 'form'];
    $renderChildren = static function (DOMNode $parent) use (&$renderChildren, $allowedTags, $discardTags): string {
        $output = '';
        foreach ($parent->childNodes as $child) {
            if ($child instanceof DOMText) {
                $output .= htmlspecialchars($child->nodeValue ?? '', ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8');
                continue;
            }
            if (!$child instanceof DOMElement) {
                continue;
            }
            $tag = strtolower($child->tagName);
            if (in_array($tag, $discardTags, true)) {
                continue;
            }
            $contents = $renderChildren($child);
            if (!in_array($tag, $allowedTags, true)) {
                $output .= $contents;
                continue;
            }
            if (in_array($tag, ['br', 'hr'], true)) {
                $output .= '<' . $tag . '>';
                continue;
            }
            $attributes = '';
            if (in_array($tag, ['p', 'h2', 'h3', 'blockquote'], true)) {
                $class = $child->getAttribute('class');
                if (in_array($class, ['ql-align-center', 'ql-align-right', 'ql-align-justify'], true)) {
                    $attributes = ' class="' . $class . '"';
                }
            } elseif ($tag === 'a') {
                $href = trim($child->getAttribute('href'));
                $safeLink = preg_match('/^(?:https?:\/\/|mailto:|tel:|\/(?!\/)|#)/i', $href) === 1
                    && preg_match('/[\x00-\x20]/', $href) !== 1;
                if ($safeLink) {
                    $attributes = ' href="' . htmlspecialchars($href, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '" rel="noopener noreferrer"';
                } else {
                    $output .= $contents;
                    continue;
                }
            }
            $output .= '<' . $tag . $attributes . '>' . $contents . '</' . $tag . '>';
        }
        return $output;
    };

    return trim($renderChildren($root));
}

function admin_rich_text_text_length(string $html): int
{
    return mb_strlen(html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 'UTF-8');
}

function password_matches_and_migrate(string $submitted, string $stored, string $table, string $column, int $id, PDO $database): bool
{
    $legacySha1 = preg_match('/^[a-f0-9]{40}$/i', $stored) === 1;
    $valid = $legacySha1
        ? hash_equals(strtolower($stored), sha1($submitted))
        : password_verify($submitted, $stored);
    if (!$valid) {
        return false;
    }

    if ($legacySha1 || password_needs_rehash($stored, PASSWORD_DEFAULT)) {
        $hash = password_hash($submitted, PASSWORD_DEFAULT);
        $statement = $database->prepare("UPDATE {$table} SET {$column} = ? WHERE id = ?");
        $statement->execute([$hash, $id]);
    }
    return true;
}

$localDatabaseConfig = [];
$localConfigFile = dirname(__DIR__) . '/.env.local.php';
if (in_array(strtolower((string) ($_SERVER['SERVER_NAME'] ?? '')), ['localhost', '127.0.0.1'], true) && is_file($localConfigFile)) {
    $loadedLocalConfig = require $localConfigFile;
    if (is_array($loadedLocalConfig) && isset($loadedLocalConfig['database']) && is_array($loadedLocalConfig['database'])) {
        $localDatabaseConfig = $loadedLocalConfig['database'];
    }
}
$dbhost = getenv('ISPGOMBE_DB_HOST') ?: (string) ($localDatabaseConfig['host'] ?? '');
$dbname = getenv('ISPGOMBE_DB_NAME') ?: (string) ($localDatabaseConfig['name'] ?? '');
$dbuser = getenv('ISPGOMBE_DB_USER') ?: (string) ($localDatabaseConfig['user'] ?? '');
$dbpswd = getenv('ISPGOMBE_DB_PASSWORD') !== false ? (string) getenv('ISPGOMBE_DB_PASSWORD') : (string) ($localDatabaseConfig['password'] ?? '');
$bdd = null;
if ($dbhost !== '' && $dbname !== '' && $dbuser !== '') {
    try {
        $bdd = new PDO(
            'mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8mb4',
            $dbuser,
            $dbpswd,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    } catch (PDOException $e) {
        error_log('ISP-GOMBE database connection failed.');
    }
}

