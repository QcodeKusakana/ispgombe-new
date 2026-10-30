<?php
// Repair legacy text escaped twice by HTML output (for example l&#039;ISP).
ob_start(static function ($html) {
    return str_ireplace(['&amp;#039;', '&amp;#39;'], '&#039;', $html);
});
require_once __DIR__ . '/functions/main_function.php';
opaque_url_ids_canonicalize_request(['id', 'ID', 'edit', 'dep', 'fac', 'ss', 'niv']);
opaque_url_ids_normalize_query(['id', 'ID', 'edit', 'dep', 'fac', 'ss', 'niv']);
ob_start('opaque_url_ids_rewrite_html');
$pages = scandir(__DIR__ . '/pages');
$pageCandidate = $_GET['pages'] ?? null;
if (is_string($pageCandidate) && in_array($pageCandidate . '.php', $pages, true)) {
    $page = $pageCandidate;
} else {
    $page = 'home';
}
if (!in_array($page, ['login', 'register'], true) && empty($_SESSION['id_adm'])) {
    header('Location: ?pages=login');
    exit;
}
if (!in_array($page, ['login', 'register'], true) && !admin_refresh_session_identity($bdd ?? null)) {
    header('Location: ?pages=login');
    exit;
}
// Archived hospitality-template screens do not belong to the ISP-GOMBE schema/content.
if (in_array($page, ['a_service', 'a_offre', 'a_galerie'], true)) {
    http_response_code(404);
    exit('Cette ancienne fonction ne fait pas partie du site ISP-GOMBE.');
}
if ($page === 'dep') {
    http_response_code(404);
    exit('Cette ancienne page de gestion n’est plus reliée à l’administration ISP-GOMBE.');
}
if ($page === 'register') {
    http_response_code(404);
    exit('La création des comptes administrateur est réservée au super-administrateur.');
}
if ($page !== 'login') {
    $adminLevel = (int) ($_SESSION['niveau'] ?? 0);
    if (!admin_role_can_access_page($adminLevel, $page)) {
        http_response_code(403);
        exit('Vous n’êtes pas autorisé à ouvrir cette page.');
    }
}
// Retired result-entry steps now lead to the single validated palmares form.
if (in_array($page, ['fac', 'sess', 'niveau'], true)) {
    header('Location: ?pages=palmares');
    exit;
}
if (!in_array($page, ['login', 'register', 'deconnexion'], true) && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && !csrf_is_valid($_POST['csrf_token'] ?? null)) {
    http_response_code(400);
    exit('Jeton de sécurité invalide. Rechargez la page.');
}
if ($page !== 'login' && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $adminRichTextFields = [
        'description', 'resume', 'resumer', 'contenu', 'hero_description', 'about_intro', 'admissions_notice',
        'institution_history', 'institution_mission', 'institution_vision', 'institution_values',
        'institution_organization', 'institution_authorities', 'institution_administration', 'institution_budget',
        'campus_description', 'research_description',
    ];
    foreach ($adminRichTextFields as $richTextField) {
        if (isset($_POST[$richTextField]) && is_string($_POST[$richTextField])) {
            $_POST[$richTextField] = admin_sanitize_rich_text($_POST[$richTextField]);
        }
    }
}
if ($page === 'deconnexion') {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST' || !csrf_is_valid($_POST['csrf_token'] ?? null)) {
        http_response_code(405);
        exit('Requête de déconnexion invalide.');
    }
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $cookie = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires' => time() - 42000,
            'path' => $cookie['path'],
            'domain' => $cookie['domain'],
            'secure' => $cookie['secure'],
            'httponly' => $cookie['httponly'],
            'samesite' => $cookie['samesite'] ?? 'Lax',
        ]);
    }
    session_destroy();
    header('Location: ?pages=login');
    exit;
}
$pages_functions = scandir(__DIR__ . '/functions');

if (in_array($page . '.funct.php', $pages_functions, true)) {
    include __DIR__ . '/functions/' . $page . '.funct.php';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ISP GOMBE</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css?v=<?= (int) @filemtime(__DIR__ . '/assets/css/style.css') ?>" rel="stylesheet">
    <link href="assets/css/isp-admin.css?v=<?= (int) @filemtime(__DIR__ . '/assets/css/isp-admin.css') ?>" rel="stylesheet">
    <link href="assets/css/admin-theme.css?v=<?= (int) @filemtime(__DIR__ . '/assets/css/admin-theme.css') ?>" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.4.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="admin-app admin-page-<?= htmlspecialchars($page, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($page !== 'login'): ?><a class="admin-skip-link" href="#main">Passer au contenu principal</a><?php endif; ?>

<?php include_once __DIR__ . '/menu/navbar.php'; ?>
<div id="page-wrapper">
    <?php if (!empty($_SESSION['admin_action_notice'])): ?><div class="alert alert-info mx-3 mt-3" role="status"><?= htmlspecialchars((string) $_SESSION['admin_action_notice'], ENT_QUOTES, 'UTF-8') ?></div><?php unset($_SESSION['admin_action_notice']); endif; ?>
    <?php include __DIR__ . '/pages/' . $page . '.php'; ?>
</div>
<?php
$pages_js = is_dir(__DIR__ . '/js') ? scandir(__DIR__ . '/js') : [];
if (in_array($page . '.js', $pages_js, true)):
?>
    <script src="js/<?= htmlspecialchars($page, ENT_QUOTES, 'UTF-8') ?>.js"></script>
<?php endif; ?>
<?php include_once __DIR__ . '/menu/footer.php'; ?>
<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="js/rich_text.js?v=20261029-2"></script>
<script src="js/image_upload_guidance.js?v=<?= (int) @filemtime(__DIR__ . '/js/image_upload_guidance.js') ?>"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>
</html>








