<?php $committeeMembers = is_array($committeeMembers ?? null) ? $committeeMembers : []; ?>
<main class="governance-reading-page">
    <section class="page-intro section-space"><div class="institution-container">
        <p class="eyebrow eyebrow-dark">Gouvernance de l’Institut</p>
        <h1 class="page-title">Le Comité <em>de gestion</em></h1>
        <p class="page-lead">Les autorités qui assurent la direction académique, administrative et financière de l’ISP-GOMBE.</p>
        <a class="text-link" href="?pages=isp&amp;gestion">Présentation des organes de gestion <span aria-hidden="true">↗</span></a>
    </div></section>
    <section class="section-space governance-reading-section" aria-label="Membres du Comité de gestion"><div class="institution-container">
        <?php if ($committeeMembers): ?><div class="governance-reading-list">
            <?php foreach ($committeeMembers as $index => $member): $portraitUrl = 'admin/media/membre/' . rawurlencode(basename((string) $member['photo'])); $portraitAlt = 'Portrait de ' . (string) $member['nom']; ?>
                <article class="governance-reading-card" id="committee-member-<?= (int) $index + 1 ?>">
                    <div class="governance-reading-portrait"><button class="governance-photo-trigger" type="button" data-governance-photo data-photo-src="<?= htmlspecialchars($portraitUrl, ENT_QUOTES, 'UTF-8') ?>" data-photo-alt="<?= htmlspecialchars($portraitAlt, ENT_QUOTES, 'UTF-8') ?>" aria-label="Agrandir le portrait de <?= htmlspecialchars((string) $member['nom'], ENT_QUOTES, 'UTF-8') ?>"><img class="governance-photo" src="<?= htmlspecialchars($portraitUrl, ENT_QUOTES, 'UTF-8') ?>" alt="" loading="lazy"><span class="governance-zoom-icon" aria-hidden="true"><i class="bi bi-zoom-in"></i></span></button></div>
                    <div class="governance-reading-copy"><span class="governance-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span><p class="governance-role"><?= htmlspecialchars((string) $member['fonction'], ENT_QUOTES, 'UTF-8') ?></p><h2><?= htmlspecialchars((string) $member['nom'], ENT_QUOTES, 'UTF-8') ?></h2>
                        <?php if (trim((string) $member['description']) !== ''): ?><div class="governance-description"><?= admin_sanitize_rich_text((string) $member['description']) ?></div><?php else: ?><p class="content-note">La présentation de cette autorité sera publiée prochainement.</p><?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div><?php else: ?><p class="governance-empty">La composition du Comité de gestion sera publiée prochainement.</p><?php endif; ?>
        <dialog class="governance-lightbox" data-governance-lightbox aria-label="Portrait du Comité de gestion"><button class="governance-lightbox-close" type="button" data-governance-close aria-label="Fermer le portrait"><i class="bi bi-x-lg" aria-hidden="true"></i></button><img src="" alt="" data-governance-lightbox-image><p data-governance-lightbox-caption></p></dialog>
    </div></section>
</main>
