<?php if (!empty($_SESSION['id_adm'])): ?>
<?php
$adminNavActive = static fn(array $routes): string => in_array($page, $routes, true) ? ' active' : '';
$adminNavCurrent = static fn(array $routes): string => in_array($page, $routes, true) ? ' aria-current="page"' : '';
?>
<header id="header" class="header fixed-top d-flex align-items-center admin-header">
    <div class="d-flex align-items-center justify-content-between admin-brand-wrap">
        <a href="?pages=home" class="logo d-flex align-items-center">
            <img class="admin-brand-logo" src="../images/isp-gombe-logo.jpg" alt="">
            <span class="d-none d-lg-block">ISP-GOMBE <small>Administration</small></span>
        </a>
        <button class="toggle-sidebar-btn" type="button" aria-label="Basculer le menu" aria-controls="sidebar" aria-expanded="false"><i class="bi bi-list" aria-hidden="true"></i></button>
    </div>
    <div class="admin-header-right">
        <span class="admin-user"><i class="bi bi-person-circle" aria-hidden="true"></i><span class="admin-user-name"><?= htmlspecialchars((string) $_SESSION['pseudo'], ENT_QUOTES, 'UTF-8') ?></span><span class="badge text-bg-warning"><?= htmlspecialchars(admin_role_name((int) $_SESSION['niveau']), ENT_QUOTES, 'UTF-8') ?></span></span>
        <form method="post" action="?pages=deconnexion" class="admin-logout-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit" class="btn btn-sm btn-outline-light"><i class="bi bi-box-arrow-right" aria-hidden="true"></i> Déconnexion</button>
        </form>
    </div>
</header>
<aside id="sidebar" class="sidebar admin-sidebar">
    <nav aria-label="Navigation de l’administration">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Vue d’ensemble</li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['home']) ?>" href="?pages=home"<?= $adminNavCurrent(['home']) ?>><i class="bi bi-grid-1x2" aria-hidden="true"></i><span>Tableau de bord</span></a></li>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'site_content') || admin_role_can_access_page((int) $_SESSION['niveau'], 'activite')): ?>
            <li class="nav-heading">Site public</li>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'site_content')): ?><li class="nav-item"><a class="nav-link<?= $adminNavActive(['site_content']) ?>" href="?pages=site_content"<?= $adminNavCurrent(['site_content']) ?>><i class="bi bi-window-stack" aria-hidden="true"></i><span>Accueil et coordonnées</span></a></li><?php endif; ?>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'comite_gestion')): ?><li class="nav-item"><a class="nav-link<?= $adminNavActive(['comite_gestion']) ?>" href="?pages=comite_gestion"<?= $adminNavCurrent(['comite_gestion']) ?>><i class="bi bi-people-fill" aria-hidden="true"></i><span>Comité de gestion</span></a></li><?php endif; ?>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'home_slides')): ?><li class="nav-item"><a class="nav-link<?= $adminNavActive(['home_slides']) ?>" href="?pages=home_slides"<?= $adminNavCurrent(['home_slides']) ?>><i class="bi bi-images" aria-hidden="true"></i><span>Images du bandeau</span></a></li><?php endif; ?>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'activite')): ?>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['activite', 'modif_article']) ?>" href="?pages=activite"<?= $adminNavCurrent(['activite', 'modif_article']) ?>><i class="bi bi-newspaper" aria-hidden="true"></i><span>Actualités</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['campus']) ?>" href="?pages=campus"<?= $adminNavCurrent(['campus']) ?>><i class="bi bi-building" aria-hidden="true"></i><span>Vie de campus</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['a_la_une']) ?>" href="?pages=a_la_une"<?= $adminNavCurrent(['a_la_une']) ?>><i class="bi bi-images" aria-hidden="true"></i><span>Galerie des sections</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['a_la_uneDep']) ?>" href="?pages=a_la_uneDep"<?= $adminNavCurrent(['a_la_uneDep']) ?>><i class="bi bi-images" aria-hidden="true"></i><span>Galerie des départements</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['annonce_s']) ?>" href="?pages=annonce_s"<?= $adminNavCurrent(['annonce_s']) ?>><i class="bi bi-megaphone" aria-hidden="true"></i><span>Annonces des sections</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['annonce_d']) ?>" href="?pages=annonce_d"<?= $adminNavCurrent(['annonce_d']) ?>><i class="bi bi-megaphone" aria-hidden="true"></i><span>Annonces des départements</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['communiques']) ?>" href="?pages=communiques"<?= $adminNavCurrent(['communiques']) ?>><i class="bi bi-chat-square-text" aria-hidden="true"></i><span>Communiqués étudiants</span></a></li>
            <?php endif; endif; ?>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'section')): ?>
            <li class="nav-heading">Organisation académique</li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['section', 'fac']) ?>" href="?pages=section"<?= $adminNavCurrent(['section', 'fac']) ?>><i class="bi bi-mortarboard" aria-hidden="true"></i><span>Sections</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['departement', 'dep']) ?>" href="?pages=departement"<?= $adminNavCurrent(['departement', 'dep']) ?>><i class="bi bi-diagram-3" aria-hidden="true"></i><span>Départements</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['option']) ?>" href="?pages=option"<?= $adminNavCurrent(['option']) ?>><i class="bi bi-list-check" aria-hidden="true"></i><span>Options</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['promotion']) ?>" href="?pages=promotion"<?= $adminNavCurrent(['promotion']) ?>><i class="bi bi-people" aria-hidden="true"></i><span>Promotions</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['palmares', 'fac', 'sess', 'niveau']) ?>" href="?pages=palmares"<?= $adminNavCurrent(['palmares', 'fac', 'sess', 'niveau']) ?>><i class="bi bi-journal-check" aria-hidden="true"></i><span>Palmarès</span></a></li>
            <?php endif; ?>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'candidatures')): ?>
            <li class="nav-heading">Admissions</li><li class="nav-item"><a class="nav-link<?= $adminNavActive(['candidatures']) ?>" href="?pages=candidatures"<?= $adminNavCurrent(['candidatures']) ?>><i class="bi bi-person-vcard" aria-hidden="true"></i><span>Dossiers étudiants</span></a></li>
            <?php endif; ?>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'a_membre')): ?>
            <li class="nav-heading">Personnel et communication</li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['a_membre', 'a_membre_update']) ?>" href="?pages=a_membre"<?= $adminNavCurrent(['a_membre', 'a_membre_update']) ?>><i class="bi bi-person-badge" aria-hidden="true"></i><span>Personnel des sections</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['a_membre_dep', 'a_membre_dep_update']) ?>" href="?pages=a_membre_dep"<?= $adminNavCurrent(['a_membre_dep', 'a_membre_dep_update']) ?>><i class="bi bi-person-badge" aria-hidden="true"></i><span>Personnel des départements</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['agent_dep', 'agent_dep_update']) ?>" href="?pages=agent_dep"<?= $adminNavCurrent(['agent_dep', 'agent_dep_update']) ?>><i class="bi bi-person-workspace" aria-hidden="true"></i><span>Agents des départements</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['messagerie']) ?>" href="?pages=messagerie"<?= $adminNavCurrent(['messagerie']) ?>><i class="bi bi-envelope" aria-hidden="true"></i><span>Messages reçus</span></a></li>
            <?php endif; ?>
            <?php if (admin_role_can_access_page((int) $_SESSION['niveau'], 'valider_adm')): ?>
            <li class="nav-heading">Accès</li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['valider_adm']) ?>" href="?pages=valider_adm"<?= $adminNavCurrent(['valider_adm']) ?>><i class="bi bi-shield-lock" aria-hidden="true"></i><span>Comptes administrateur</span></a></li>
            <li class="nav-item"><a class="nav-link<?= $adminNavActive(['action_log']) ?>" href="?pages=action_log"<?= $adminNavCurrent(['action_log']) ?>><i class="bi bi-journal-text" aria-hidden="true"></i><span>Journal des actions</span></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>
<?php endif; ?>


