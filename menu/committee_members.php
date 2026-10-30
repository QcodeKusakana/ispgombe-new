<?php if (!empty($comiteGestionAccueil)): ?>
    <div class="governance-grid">
        <?php foreach ($comiteGestionAccueil as $index => $member): $portraitUrl = 'admin/media/membre/' . rawurlencode(basename((string) $member['photo'])); $portraitAlt = 'Portrait de ' . (string) $member['nom']; ?>
            <article class="governance-card<?= $index === 0 ? ' governance-card-lead' : '' ?>">
                <div class="governance-card-top">
                    <span class="governance-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <button class="governance-photo-trigger" type="button" data-governance-photo data-photo-src="<?= htmlspecialchars($portraitUrl, ENT_QUOTES, 'UTF-8') ?>" data-photo-alt="<?= htmlspecialchars($portraitAlt, ENT_QUOTES, 'UTF-8') ?>" aria-label="Agrandir le portrait de <?= htmlspecialchars((string) $member['nom'], ENT_QUOTES, 'UTF-8') ?>">
                        <img class="governance-photo" src="<?= htmlspecialchars($portraitUrl, ENT_QUOTES, 'UTF-8') ?>" alt="" loading="lazy">
                        <span class="governance-zoom-icon" aria-hidden="true"><i class="bi bi-zoom-in"></i></span>
                    </button>
                </div>
                <p class="governance-role"><?= htmlspecialchars((string) $member['fonction'], ENT_QUOTES, 'UTF-8') ?></p>
                <h3><?= htmlspecialchars((string) $member['nom'], ENT_QUOTES, 'UTF-8') ?></h3>
                <a class="governance-member-link" href="?pages=comite_gestion#committee-member-<?= (int) $index + 1 ?>" aria-label="Lire le profil complet de <?= htmlspecialchars((string) $member['nom'], ENT_QUOTES, 'UTF-8') ?>">
                    Lire le profil <span aria-hidden="true">→</span>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="governance-empty">La composition du Comité de gestion sera publiée prochainement.</p>
<?php endif; ?>
<dialog class="governance-lightbox" data-governance-lightbox aria-label="Portrait du Comité de gestion">
    <button class="governance-lightbox-close" type="button" data-governance-close aria-label="Fermer le portrait"><i class="bi bi-x-lg" aria-hidden="true"></i></button>
    <img src="" alt="" data-governance-lightbox-image>
    <p data-governance-lightbox-caption></p>
</dialog>
