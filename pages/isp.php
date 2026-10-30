<?php
$institutionViews = [
    'mission' => ['key' => 'institution_mission', 'title' => 'Mission et création'],
    'history' => ['key' => 'institution_history', 'title' => 'Historique'],
    'vision' => ['key' => 'institution_vision', 'title' => 'Vision'],
    'values' => ['key' => 'institution_values', 'title' => 'Valeurs'],
    'direction' => ['key' => 'institution_authorities', 'title' => 'Autorités et organes de gestion'],
    'academique' => ['key' => 'institution_organization', 'title' => 'Organisation académique'],
    'recherche' => ['key' => 'research_description', 'title' => 'Bibliothèque et recherche'],
    'administratif' => ['key' => 'institution_administration', 'title' => 'Services administratifs'],
    'budget' => ['key' => 'institution_budget', 'title' => 'Administration du budget'],
    'gestion' => ['key' => 'institution_authorities', 'title' => 'Comité de gestion'],
    'campus' => ['key' => 'campus_description', 'title' => 'Campus et infrastructures'],
];
$viewKey = '';
foreach (array_keys($institutionViews) as $candidate) {
    if (isset($_GET[$candidate])) {
        $viewKey = $candidate;
        break;
    }
}
if ($viewKey === '') {
    $viewKey = 'history';
}
$institutionView = $institutionViews[$viewKey];
$institutionText = trim((string) ($siteSettings[$institutionView['key']] ?? ''));
$committeePageMembers = [];
if ($viewKey === 'gestion' && $bdd instanceof PDO) {
    try {
        $committeePageMembers = $bdd->query('SELECT id, nom, fonction, photo FROM committee_member WHERE is_active = 1 ORDER BY sort_order ASC, id ASC')->fetchAll();
    } catch (PDOException $exception) {
        error_log('ISP-GOMBE institution committee could not be loaded.');
    }
}
?>
<section class="section-space institution-page">
    <div class="institution-container institution-page-grid">
        <aside class="institution-page-nav" aria-label="À propos de l’institut">
            <div class="institution-page-nav-heading"><p class="eyebrow eyebrow-dark">L’ISP-GOMBE</p><span>Explorer l’Institut</span></div>
            <nav aria-label="Rubriques institutionnelles">
                <?php foreach ($institutionViews as $key => $view): ?><a href="?pages=isp&amp;<?= rawurlencode($key) ?>"<?= $viewKey === $key ? ' aria-current="page"' : '' ?>><span><?= htmlspecialchars($view['title'], ENT_QUOTES, 'UTF-8') ?></span><span class="institution-nav-arrow" aria-hidden="true">→</span></a><?php endforeach; ?>
            </nav>
        </aside>
        <article class="institution-page-content">
            <div class="institution-page-heading"><p class="institution-breadcrumb"><a href="?pages=home">Accueil</a><span aria-hidden="true"> / </span>L’Institut</p><p class="eyebrow eyebrow-dark">Présentation institutionnelle</p><h1 class="page-title"><?= htmlspecialchars($institutionView['title'], ENT_QUOTES, 'UTF-8') ?></h1><span class="institution-heading-rule" aria-hidden="true"></span></div>
            <div class="institution-page-copy">
                <?php if ($institutionText !== ''): ?>
                    <div class="institution-prose"><?= admin_sanitize_rich_text($institutionText) ?></div>
                <?php elseif ($viewKey === 'gestion'): ?>
                    <p class="institution-prose">Les autorités qui assurent la direction académique, administrative et financière de l’ISP-GOMBE.</p>
                <?php else: ?>
                    <p class="content-note">Cette information sera publiée après validation par l’administration de l’établissement.</p>
                <?php endif; ?>
            </div>
            <?php if ($viewKey === 'gestion'): $comiteGestionAccueil = $committeePageMembers; include __DIR__ . '/../menu/committee_members.php'; ?><a class="button button-gold governance-more-link" href="?pages=comite_gestion">Lire les fiches du Comité de gestion <span aria-hidden="true">→</span></a><?php endif; ?>
        </article>
    </div>
</section>
