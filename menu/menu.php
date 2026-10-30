<header class="site-header">
    <div class="utility-bar">
        <div class="institution-container utility-inner">
            <span>Institut Supérieur Pédagogique de la Gombe <span aria-hidden="true">·</span> Kinshasa</span>
            <div class="utility-links">
                <a href="mailto:<?= rawurlencode($siteSettings['contact_email'] ?? 'contact@ispgombe.ac.cd') ?>"><?= htmlspecialchars($siteSettings['contact_email'] ?? 'contact@ispgombe.ac.cd', ENT_QUOTES, 'UTF-8') ?></a>
                <a href="?pages=loginEtud">Espace étudiant <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </div>
    <div class="institution-container nav-wrap">
        <a class="brand" href="?pages=home" aria-label="ISP-GOMBE, accueil">
            <img class="brand-logo" src="images/isp-gombe-logo.jpg" width="58" height="58" alt="">
            <span><strong>ISP-GOMBE</strong><small>Institut Supérieur Pédagogique de la Gombe</small></span>
        </a>
        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" aria-label="Ouvrir le menu">
            <span></span><span></span><span></span>
        </button>
        <nav id="site-navigation" class="site-navigation" aria-label="Navigation principale">
            <a href="?pages=home"<?= $page === 'home' ? ' aria-current="page"' : '' ?>>Accueil</a>
            <a href="?pages=isp"<?= $page === 'isp' ? ' aria-current="page"' : '' ?>>L’Institut</a>
            <a href="?pages=comite_gestion"<?= $page === 'comite_gestion' ? ' aria-current="page"' : '' ?>>Gouvernance</a>
            <details class="nav-group">
                <summary<?= in_array($page, ['faculte', 'departement', 'detail_section', 'detail_departement', 'session', 'niveau'], true) ? ' aria-current="page"' : '' ?>>Formations <span aria-hidden="true">⌄</span></summary>
                <div class="nav-dropdown" aria-label="Rubriques des formations">
                    <a href="?pages=faculte">Sections organisées</a>
                    <a href="?pages=departement">Départements</a>
                </div>
            </details>
            <a href="?pages=campus"<?= $page === 'campus' ? ' aria-current="page"' : '' ?>>Vie de campus</a>
            <details class="nav-group">
                <summary<?= in_array($page, ['actualite', 'detail', 'evenement'], true) ? ' aria-current="page"' : '' ?>>Actualités <span aria-hidden="true">⌄</span></summary>
                <div class="nav-dropdown" aria-label="Publications de l’établissement">
                    <a href="?pages=actualite">Actualités et publications</a>
                    <a href="?pages=evenement">Événements et activités</a>
                </div>
            </details>
            <a href="?pages=palmares"<?= in_array($page, ['palmares', 'palmaresEtud'], true) ? ' aria-current="page"' : '' ?>>Palmarès</a>
            <a href="?pages=contact"<?= $page === 'contact' ? ' aria-current="page"' : '' ?>>Contact</a>
            <a class="nav-contact" href="?pages=inscription"<?= $page === 'inscription' ? ' aria-current="page"' : '' ?>>Préinscription</a>
        </nav>
    </div>
</header>
<script src="js/institutional.js" defer></script>

