<section class="page-intro section-space results-intro"><div class="institution-container">
    <p class="eyebrow">Résultats académiques</p>
    <h1 class="page-title">Palmarès <em><?= htmlspecialchars((string) ($infoNiv ?? 'résultats'), ENT_QUOTES, 'UTF-8') ?></em></h1>
    <?php if (!empty($infoDep)): ?><p class="page-lead"><?= htmlspecialchars((string) $infoDep, ENT_QUOTES, 'UTF-8') ?> · Année <?= htmlspecialchars((string) $academicYear, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
</div></section>
<section class="academic-content section-space"><div class="institution-container results-list-wrap">
    <?php if (!empty($palmaresEtud)): ?>
        <div class="results-list-heading"><div><p class="eyebrow eyebrow-dark">Noms publiés</p><h2><?= count($palmaresEtud) ?> résultat<?= count($palmaresEtud) > 1 ? 's' : '' ?></h2></div><p><?= htmlspecialchars((string) ($infoNiv ?? ''), ENT_QUOTES, 'UTF-8') ?></p></div>
        <ol class="results-list"><?php foreach ($palmaresEtud as $name): ?><li><?= htmlspecialchars((string) $name, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ol>
    <?php else: ?>
        <p class="content-note">Aucun résultat n’a été trouvé pour cette combinaison de section, département, année, session et niveau.</p>
    <?php endif; ?>
    <p class="results-privacy">Ce palmarès reprend uniquement les noms publiés dans les données académiques. Pour demander le retrait d’un nom, contactez l’administration par la <a href="?pages=contact">page de contact</a>.</p>
    <a class="text-link" href="?pages=palmares">Retour aux années de palmarès <span aria-hidden="true">↗</span></a>
</div></section>
