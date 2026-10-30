<?php $escape = static fn($value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); ?>
<?php if ($section): ?>
    <section class="detail-hero section-space">
        <div class="institution-container">
            <p class="institution-breadcrumb"><a href="?pages=home">Accueil</a><span aria-hidden="true"> / </span><a href="?pages=faculte">Formations</a></p>
            <p class="eyebrow">Section organisée</p>
            <h1 class="page-title"><?= $escape($section['titre']) ?></h1>
            <p class="page-lead">Découvrez la section, ses départements et les informations académiques disponibles à l’ISP-GOMBE.</p>
            <a class="button button-gold" href="?pages=departement&amp;fac=<?= (int) $section['id'] ?>">Voir les départements <span aria-hidden="true">→</span></a>
        </div>
    </section>
    <section class="detail-content section-space"><div class="institution-container detail-content-grid">
        <article class="detail-prose-card"><p class="eyebrow eyebrow-dark">Présentation</p><h2>À propos de la section</h2>
            <?php if (trim((string) ($section['resume'] ?? '')) !== ''): ?><div class="detail-rich-copy"><?= admin_sanitize_rich_text((string) $section['resume']) ?></div><?php else: ?><p class="content-note">La présentation détaillée de cette section sera publiée après validation par l’administration.</p><?php endif; ?>
        </article>
        <aside class="detail-aside-card"><span class="detail-index">ISP-GOMBE</span><strong><?= count($sectionDepartments) ?></strong><span>département<?= count($sectionDepartments) === 1 ? '' : 's' ?> organisé<?= count($sectionDepartments) === 1 ? '' : 's' ?></span></aside>
    </div></section>
    <?php if ($sectionCovers): ?><section class="detail-gallery-section section-space"><div class="institution-container"><div class="section-heading"><div><p class="eyebrow eyebrow-dark">En images</p><h2>La section <em>en pratique</em></h2></div></div><div class="detail-gallery-grid">
        <?php foreach ($sectionCovers as $cover): $photo = basename((string) ($cover['photo_cv'] ?? '')); if ($photo === '') { continue; } ?><figure class="detail-gallery-item"><img src="admin/media/couverture/<?= rawurlencode($photo) ?>" alt="Activité ou infrastructure de la section <?= $escape($section['titre']) ?>" loading="lazy"></figure><?php endforeach; ?>
    </div></div></section><?php endif; ?>
    <section class="academic-content section-space"><div class="institution-container"><div class="section-heading"><div><p class="eyebrow eyebrow-dark">Parcours académiques</p><h2>Départements <em>de la section</em></h2></div></div>
        <?php if ($sectionDepartments): ?><div class="academic-grid"><?php foreach ($sectionDepartments as $index => $department): ?><article class="academic-card"><span class="academic-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= $escape($department['titre']) ?></h3><?php if (!empty($department['resume'])): ?><p><?= $escape($department['resume']) ?></p><?php endif; ?><a class="text-link" href="?pages=detail_departement&amp;dep=<?= (int) $department['id'] ?>">Découvrir le département <span aria-hidden="true">↗</span></a></article><?php endforeach; ?></div>
        <?php else: ?><p class="content-note">Aucun département n’est actuellement associé à cette section.</p><?php endif; ?>
    </div></section>
    <?php if ($sectionStaff || $sectionAnnouncements): ?><section class="detail-extra-section section-space"><div class="institution-container detail-extra-grid">
        <?php if ($sectionStaff): ?><div><div class="section-heading"><div><p class="eyebrow eyebrow-dark">Équipe</p><h2>Personnel <em>académique</em></h2></div></div><div class="profile-grid"><?php foreach ($sectionStaff as $person): $photo = basename((string) ($person['photo'] ?? '')); ?><article class="profile-card"><?php if ($photo !== ''): ?><img src="admin/media/membre/<?= rawurlencode($photo) ?>" alt="" loading="lazy"><?php endif; ?><h3><?= $escape($person['noms']) ?></h3><p><?= $escape($person['fonction']) ?></p></article><?php endforeach; ?></div></div><?php endif; ?>
        <?php if ($sectionAnnouncements): ?><aside class="detail-announcements"><p class="eyebrow eyebrow-dark">Informations</p><h2>Annonces</h2><?php foreach ($sectionAnnouncements as $announcement): ?><div class="detail-rich-copy"><?= admin_sanitize_rich_text((string) $announcement['resumer']) ?></div><?php endforeach; ?></aside><?php endif; ?>
    </div></section><?php endif; ?>
<?php else: ?>
    <section class="page-intro section-space"><div class="institution-container"><p class="eyebrow eyebrow-dark">Formations</p><h1 class="page-title">Section <em>indisponible</em></h1><p class="page-lead">Cette section n’existe pas ou n’est plus publiée.</p><a class="button button-gold" href="?pages=faculte">Retour aux sections <span aria-hidden="true">→</span></a></div></section>
<?php endif; ?>
