<?php
// When this file is used as PHP's built-in-server router, pass real assets
// through to the server instead of rendering the homepage for every URL.
if (PHP_SAPI === 'cli-server') {
    $requestPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
    $requestPath = is_string($requestPath) ? rawurldecode($requestPath) : '/';
    if ($requestPath === '/admin' || $requestPath === '/admin/') {
        require __DIR__ . '/admin/index.php';
        exit;
    }
    $rootPath = realpath(__DIR__);
    $assetPath = $rootPath === false ? false : realpath($rootPath . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, ltrim($requestPath, '/\\')));
    $isInsideRoot = is_string($assetPath) && is_string($rootPath) && str_starts_with(strtolower($assetPath), strtolower($rootPath . DIRECTORY_SEPARATOR));
    if ($isInsideRoot && is_file($assetPath) && preg_match('/\.(?:css|js|mjs|png|jpe?g|gif|svg|webp|ico|woff2?|ttf|eot|map)$/i', $assetPath)) {
        return false;
    }
    $scriptRoutes = [
        '/admin/index.php' => __DIR__ . '/admin/index.php',
        '/admin/download.php' => __DIR__ . '/admin/download.php',
        '/student_download.php' => __DIR__ . '/student_download.php',
        '/sitemap.php' => __DIR__ . '/sitemap.php',
    ];
    if (isset($scriptRoutes[$requestPath])) {
        require $scriptRoutes[$requestPath];
        exit;
    }
}
// Public entry point. Legacy pages are kept behind an explicit allowlist.
// Older imported records contain HTML entities as literal text (for example &#039;).
// Undo only the extra escaping layer so they render as normal punctuation.
ob_start(static function ($html) {
    return str_ireplace(['&amp;#039;', '&amp;#39;'], '&#039;', $html);
});
require_once __DIR__ . '/php/main_function.php';
opaque_url_ids_canonicalize_request(['id', 'ID', 'dep', 'info', 'fac', 'ss', 'niv']);
opaque_url_ids_normalize_query(['id', 'ID', 'dep', 'info', 'fac', 'ss', 'niv']);
ob_start('opaque_url_ids_rewrite_html');

$availablePages = [
    'home', 'isp', 'actualite', 'campus', 'faculte', 'departement',
    'detail', 'detail_section', 'detail_departement', 'evenement',
    'palmares', 'palmaresEtud', 'session', 'niveau', 'contact', 'confidentialite',
    'inscription', 'comite_gestion', 'loginEtud', 'espaceEtudiant', 'deconnexion',
];
$page = isset($_GET['pages']) && is_string($_GET['pages']) ? $_GET['pages'] : 'home';
if (!in_array($page, $availablePages, true) || !is_file(__DIR__ . '/pages/' . $page . '.php')) {
    http_response_code(404);
    $page = 'home';
}

if ($page === 'deconnexion') {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST' || !csrf_is_valid($_POST['csrf_token'] ?? null)) {
        http_response_code(405);
        exit('Requête de déconnexion invalide.');
    }
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $cookie = session_get_cookie_params();
        setcookie(session_name(), '', ['expires' => time() - 42000, 'path' => $cookie['path'], 'domain' => $cookie['domain'], 'secure' => $cookie['secure'], 'httponly' => $cookie['httponly'], 'samesite' => $cookie['samesite'] ?? 'Lax']);
    }
    session_destroy();
    header('Location: ?pages=loginEtud');
    exit;
}
if ($page === 'espaceEtudiant') {
    if (empty($_SESSION['id'])) {
        header('Location:?pages=loginEtud');
        exit;
    }
    if (!$bdd instanceof PDO) {
        http_response_code(503);
        exit('Service étudiant temporairement indisponible.');
    }
}
$siteSettings = [];
if ($bdd instanceof PDO) {
    try {
        $siteSettings = $bdd->query('SELECT setting_key, setting_value FROM site_setting')->fetchAll(PDO::FETCH_KEY_PAIR);
    } catch (PDOException $e) {
        // The optional site settings migration may not be installed yet.
    }
}
$controller = __DIR__ . '/php/' . $page . '.php';
if (is_file($controller) && ($bdd instanceof PDO || $page === 'contact')) {
    require_once $controller;
}
$pageTitles = [
    'home' => 'Accueil', 'isp' => 'L’Institut', 'actualite' => 'Actualités', 'campus' => 'Vie de campus',
    'faculte' => 'Formations', 'departement' => 'Départements', 'detail' => 'Actualité',
    'detail_section' => 'Section', 'detail_departement' => 'Département', 'evenement' => 'Événements',
    'palmares' => 'Palmarès', 'palmaresEtud' => 'Résultats', 'comite_gestion' => 'Comité de gestion', 'session' => 'Sessions académiques',
    'niveau' => 'Niveaux d’études', 'contact' => 'Contact', 'inscription' => 'Admissions',
    'loginEtud' => 'Connexion étudiant', 'espaceEtudiant' => 'Espace étudiant',
    'confidentialite' => 'Confidentialité',
];
$pageTitle = ($pageTitles[$page] ?? 'Institut Supérieur Pédagogique de la Gombe') . ' | ISP-GOMBE';
$pageDescription = $page === 'home'
    ? ($siteSettings['hero_description'] ?? 'Institut Supérieur Pédagogique de la Gombe — Kinshasa, République démocratique du Congo.')
    : (($pageTitles[$page] ?? 'Informations institutionnelles') . ' — Institut Supérieur Pédagogique de la Gombe, Kinshasa.');
if ($page === 'detail' && !empty($article)) {
    $pageTitle = (string) $article['titre'] . ' | ISP-GOMBE';
    $pageDescription = mb_strimwidth(strip_tags((string) $article['description']), 0, 180, '…', 'UTF-8');
}
if ($page === 'detail_section' && !empty($section)) {
    $pageTitle = (string) $section['titre'] . ' | ISP-GOMBE';
    $pageDescription = mb_strimwidth(strip_tags((string) ($section['resume'] ?? 'Section de formation de l’ISP-GOMBE.')), 0, 180, '…', 'UTF-8');
}
if ($page === 'detail_departement' && !empty($department)) {
    $pageTitle = (string) $department['titre'] . ' | ISP-GOMBE';
    $pageDescription = mb_strimwidth(strip_tags((string) ($department['resume'] ?? 'Département de formation de l’ISP-GOMBE.')), 0, 180, '…', 'UTF-8');
}
if (in_array($page, ['espaceEtudiant', 'loginEtud', 'deconnexion'], true)) {
    header('X-Robots-Tag: noindex, nofollow, noarchive');
}
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="theme-color" content="#102b4e">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ISP-GOMBE">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta property="og:image" content="https://ispgombe.ac.cd/images/isp-gombe-logo.jpg">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="https://ispgombe.ac.cd/images/isp-gombe-logo.jpg">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" type="image/jpeg" href="images/isp-gombe-logo.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css?v=<?= (int) @filemtime(__DIR__ . '/style.css') ?>">
    <link rel="stylesheet" href="css/responsive.css?v=<?= (int) @filemtime(__DIR__ . '/css/responsive.css') ?>">
    <link rel="stylesheet" href="css/institutional.css?v=<?= (int) @filemtime(__DIR__ . '/css/institutional.css') ?>">
</head>
<body class="page-view page-view-<?= htmlspecialchars($page, ENT_QUOTES, 'UTF-8') ?>">
    <a class="skip-link" href="#contenu">Aller au contenu principal</a>
    <?php include __DIR__ . '/menu/menu.php'; ?>
    <main id="contenu">
        <?php
        $viewFile = in_array($page, ['detail_section', 'detail_departement'], true)
            ? __DIR__ . '/pages/views/' . $page . '.php'
            : __DIR__ . '/pages/' . $page . '.php';
        include $viewFile;
        ?>
    </main>
    <?php include __DIR__ . '/menu/footer.php'; ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>







