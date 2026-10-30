<?php
function admin_contact_message_preview_html(string $message): string
{
    $message = mb_substr($message, 0, 10000, 'UTF-8');
    $message = preg_replace_callback('/<(script|style)\b[^>]*>.*?<\/\1\s*>/is', static function (array $match): string {
        return '<pre><code>' . htmlspecialchars($match[0], ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</code></pre>';
    }, $message) ?? $message;
    if (preg_match('/<\s*\/?\s*[a-z][^>]*>/i', $message) !== 1) {
        return nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
    }
    // Render only the sanitizer's HTML allowlist; JS and CSS are shown as source code, never executed.
    return admin_sanitize_rich_text($message);
}

$contactMessages = [];
$messageCount = 0;
$messageTotalCount = 0;
$messageUnreadCount = 0;
$messageLoadError = false;
$messageSearch = isset($_GET['q']) && is_string($_GET['q']) ? trim($_GET['q']) : '';
$messageSearch = mb_substr($messageSearch, 0, 100, 'UTF-8');
$messageFilter = is_string($_GET['etat'] ?? null) && in_array($_GET['etat'], ['unread', 'read'], true) ? $_GET['etat'] : 'all';
$messagePage = min(100000, filter_var($_GET['pag'] ?? 1, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 1);
$messagePerPage = 20;
$messageOffset = 0;

if ($bdd instanceof PDO && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && in_array($_POST['admin_action'] ?? '', ['mark_read', 'mark_unread'], true)) {
    if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('Jeton de sécurité invalide. Rechargez la page.');
    }
    $targetId = filter_var($_POST['record_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$targetId) {
        http_response_code(400);
        exit('Message invalide.');
    }
    $readValue = $_POST['admin_action'] === 'mark_read' ? 1 : 0;
    $update = $bdd->prepare('UPDATE contact SET is_read = ? WHERE id = ?');
    $update->execute([$readValue, (int) $targetId]);
    admin_log_action($bdd, $readValue === 1 ? 'message.mark_read' : 'message.mark_unread', 'contact', (string) $targetId);
    $_SESSION['admin_action_notice'] = $readValue === 1 ? 'Message marqué comme lu.' : 'Message marqué comme non lu.';
    $returnSearch = is_string($_POST['return_q'] ?? null) ? mb_substr(trim($_POST['return_q']), 0, 100, 'UTF-8') : '';
    $returnFilter = is_string($_POST['return_etat'] ?? null) && in_array($_POST['return_etat'], ['all', 'unread', 'read'], true) ? $_POST['return_etat'] : 'all';
    $redirect = ['pages' => 'messagerie'];
    if ($returnSearch !== '') { $redirect['q'] = $returnSearch; }
    if ($returnFilter !== 'all') { $redirect['etat'] = $returnFilter; }
    header('Location: ?' . http_build_query($redirect));
    exit;
}

if ($bdd instanceof PDO) {
    admin_handle_record_action($bdd, 'messagerie', 'contact', 'id', ['delete' => null]);
    try {
        $messageTotalCount = (int) $bdd->query('SELECT COUNT(*) FROM contact')->fetchColumn();
        $messageUnreadCount = (int) $bdd->query('SELECT COUNT(*) FROM contact WHERE is_read = 0')->fetchColumn();
        $where = [];
        $bindings = [];
        if ($messageFilter === 'unread') { $where[] = 'is_read = 0'; }
        if ($messageFilter === 'read') { $where[] = 'is_read = 1'; }
        if ($messageSearch !== '') {
            $where[] = '(name LIKE ? OR email LIKE ? OR subject LIKE ? OR message LIKE ?)';
            $match = '%' . $messageSearch . '%';
            array_push($bindings, $match, $match, $match, $match);
        }
        $whereSql = $where ? ' WHERE ' . implode(' AND ', $where) : '';
        $count = $bdd->prepare('SELECT COUNT(*) FROM contact' . $whereSql);
        $count->execute($bindings);
        $messageCount = (int) $count->fetchColumn();
        $messagePages = max(1, (int) ceil($messageCount / $messagePerPage));
        $messagePage = min($messagePage, $messagePages);
        $messageOffset = ($messagePage - 1) * $messagePerPage;
        $statement = $bdd->prepare('SELECT id, name, email, subject, message, is_read FROM contact' . $whereSql . ' ORDER BY is_read ASC, id DESC LIMIT ? OFFSET ?');
        foreach ($bindings as $index => $binding) {
            $statement->bindValue($index + 1, $binding, PDO::PARAM_STR);
        }
        $statement->bindValue(count($bindings) + 1, $messagePerPage, PDO::PARAM_INT);
        $statement->bindValue(count($bindings) + 2, $messageOffset, PDO::PARAM_INT);
        $statement->execute();
        $contactMessages = $statement->fetchAll();
    } catch (PDOException $e) {
        error_log('ISP-GOMBE contact inbox could not be loaded. Apply migration 20261029_03_add_contact_read_state.sql.');
        $messageLoadError = true;
    }
}
$messagePages = max(1, (int) ceil($messageCount / $messagePerPage));
$messageWindowStart = max(1, $messagePage - 2);
$messageWindowEnd = min($messagePages, $messagePage + 2);
?>

