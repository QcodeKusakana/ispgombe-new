<?php
$detailSource = is_string($_GET['source'] ?? null) && $_GET['source'] === 'evenement' ? 'evenement' : 'actualite';
$detailSourceLabel = $detailSource === 'evenement' ? 'Événements' : 'Actualités';
$detailSourceType = $detailSource === 'evenement' ? 'Activité de l’établissement' : 'Publication institutionnelle';
?>
<?php if (!empty($article)): ?>
<section class="article-heading">
    <div class="institution-container">
        <p class="institution-breadcrumb"><a href="?pages=home">Accueil</a><span aria-hidden="true"> / </span><a href="?pages=<?= $detailSource ?>"><?= htmlspecialchars($detailSourceLabel, ENT_QUOTES, 'UTF-8') ?></a></p>
        <p class="eyebrow"><?= htmlspecialchars($detailSourceType, ENT_QUOTES, 'UTF-8') ?></p>
        <h1 class="article-title"><?= htmlspecialchars((string) $article['titre'], ENT_QUOTES, 'UTF-8') ?></h1>
        <time datetime="<?= htmlspecialchars((string) $article['date_pub'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(date('d.m.Y', strtotime((string) $article['date_pub'])), ENT_QUOTES, 'UTF-8') ?></time>
    </div>
</section>
<section class="article-layout section-space"><div class="institution-container article-grid">
    <article class="article-body">
        <?php if (!empty($article['photo'])): ?><img class="article-cover" src="admin/media/images_activ/<?= rawurlencode(basename((string) $article['photo'])) ?>" alt="<?= htmlspecialchars((string) $article['titre'], ENT_QUOTES, 'UTF-8') ?>" fetchpriority="high"><?php endif; ?>
        <div class="article-copy"><?= admin_sanitize_rich_text((string) $article['description']) ?></div>
        <a class="text-link" href="?pages=<?= $detailSource ?>"><?= $detailSource === 'evenement' ? 'Tous les événements' : 'Toutes les actualités' ?> <span aria-hidden="true">↗</span></a>
    </article>
    <?php if (!empty($recentArticles)): ?><aside class="article-related"><p class="eyebrow eyebrow-dark">À lire également</p>
        <?php foreach ($recentArticles as $related): if ((int) $related['id_act'] === (int) $article['id_act']) { continue; } ?>
            <a class="related-item" href="?pages=detail&amp;id=<?= (int) $related['id_act'] ?>">
                <?php if (!empty($related['photo'])): ?><img src="admin/media/images_activ/<?= rawurlencode(basename((string) $related['photo'])) ?>" alt="" loading="lazy"><?php endif; ?>
                <span><small><?= htmlspecialchars(date('d.m.Y', strtotime((string) $related['date_pub'])), ENT_QUOTES, 'UTF-8') ?></small><strong><?= htmlspecialchars((string) $related['titre'], ENT_QUOTES, 'UTF-8') ?></strong></span>
            </a>
        <?php endforeach; ?>
    </aside><?php endif; ?>
</div></section>
<?php else: ?>
<section class="page-intro section-space"><div class="institution-container"><p class="eyebrow eyebrow-dark"><?= htmlspecialchars($detailSourceLabel, ENT_QUOTES, 'UTF-8') ?></p><h1 class="page-title">Publication <em>indisponible</em></h1><p class="page-lead">Cette publication n’existe pas ou n’est plus accessible.</p><a class="button button-gold" href="?pages=<?= $detailSource ?>">Retour aux <?= $detailSource === 'evenement' ? 'événements' : 'actualités' ?> <span aria-hidden="true">→</span></a></div></section>
<?php endif; ?>
