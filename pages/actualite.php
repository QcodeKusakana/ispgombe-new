<?php
$actualiteItems = $actualiteItems ?? [];
$featuredArticle = $actualiteItems[0] ?? null;
$otherArticles = count($actualiteItems) > 1 ? array_slice($actualiteItems, 1) : [];
$escapeNews = static fn($value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$formatNewsDate = static function ($value): string { $timestamp = strtotime((string) $value); return $timestamp ? date('d.m.Y', $timestamp) : 'Date non précisée'; };
?>
<section class="page-intro section-space publication-intro">
    <div class="institution-container publication-intro-grid">
        <div><p class="eyebrow eyebrow-dark">La vie de l’établissement</p><h1 class="page-title">Actualités <em>& publications</em></h1><p class="page-lead">Les informations, annonces et temps forts publiés par l’ISP-GOMBE.</p></div>
        <div class="publication-count"><span>ARCHIVES</span><strong><?= (int) ($total ?? 0) ?></strong><small>publication<?= (int) ($total ?? 0) === 1 ? '' : 's' ?> disponible<?= (int) ($total ?? 0) === 1 ? '' : 's' ?></small></div>
    </div>
</section>
<section class="publication-section section-space"><div class="institution-container">
    <nav class="publication-switch" aria-label="Rubriques de la vie de l’établissement"><a href="?pages=actualite" aria-current="page">Actualités <span><?= (int) ($total ?? 0) ?></span></a><a href="?pages=evenement">Événements <span aria-hidden="true">↗</span></a></nav>
    <?php if ($featuredArticle): ?>
        <article class="publication-featured">
            <?php if (!empty($featuredArticle['photo'])): ?><a class="publication-featured-image" href="?pages=detail&amp;id=<?= (int) $featuredArticle['id_act'] ?>" aria-label="Lire : <?= $escapeNews($featuredArticle['titre']) ?>"><img src="admin/media/images_activ/<?= rawurlencode(basename((string) $featuredArticle['photo'])) ?>" alt="" fetchpriority="high"></a><?php else: ?><div class="publication-featured-placeholder" aria-hidden="true"><span>ISP-GOMBE</span></div><?php endif; ?>
            <div class="publication-featured-copy"><p class="publication-kicker"><span>À LA UNE</span><time datetime="<?= $escapeNews($featuredArticle['date_pub']) ?>">Publié le <?= $escapeNews($formatNewsDate($featuredArticle['date_pub'])) ?></time></p><h2><a href="?pages=detail&amp;id=<?= (int) $featuredArticle['id_act'] ?>"><?= $escapeNews($featuredArticle['titre']) ?></a></h2><p><?= $escapeNews(mb_strimwidth(strip_tags((string) $featuredArticle['description']), 0, 300, '…', 'UTF-8')) ?></p><a class="button button-gold" href="?pages=detail&amp;id=<?= (int) $featuredArticle['id_act'] ?>">Lire la publication <span aria-hidden="true">→</span></a></div>
        </article>
        <?php if ($otherArticles): ?><div class="publication-grid-heading"><div><p class="eyebrow eyebrow-dark">Les dernières publications</p><h2>À suivre <em>à l’Institut</em></h2></div></div><div class="news-grid news-archive-grid publication-grid">
            <?php foreach ($otherArticles as $article): ?><article class="publication-card">
                <?php if (!empty($article['photo'])): ?><a class="news-image" href="?pages=detail&amp;id=<?= (int) $article['id_act'] ?>" aria-label="Lire : <?= $escapeNews($article['titre']) ?>"><img src="admin/media/images_activ/<?= rawurlencode(basename((string) $article['photo'])) ?>" alt="" loading="lazy"></a><?php else: ?><div class="publication-card-placeholder" aria-hidden="true"><span>ISP-GOMBE</span></div><?php endif; ?>
                <div class="publication-card-body"><p class="news-date"><time datetime="<?= $escapeNews($article['date_pub']) ?>">Publié le <?= $escapeNews($formatNewsDate($article['date_pub'])) ?></time></p><h3><a href="?pages=detail&amp;id=<?= (int) $article['id_act'] ?>"><?= $escapeNews($article['titre']) ?></a></h3><p><?= $escapeNews(mb_strimwidth(strip_tags((string) $article['description']), 0, 170, '…', 'UTF-8')) ?></p><a class="text-link" href="?pages=detail&amp;id=<?= (int) $article['id_act'] ?>">Lire la suite <span aria-hidden="true">↗</span></a></div>
            </article><?php endforeach; ?>
        </div><?php endif; ?>
        <?php if (!empty($nbPage) && $nbPage > 1): ?><nav class="archive-pagination" aria-label="Pagination des actualités"><?php for ($pageNumber = 1; $pageNumber <= $nbPage; $pageNumber++): ?><a href="?pages=actualite&amp;pag=<?= $pageNumber ?>"<?= (int) $current === $pageNumber ? ' aria-current="page"' : '' ?>><?= $pageNumber ?></a><?php endfor; ?></nav><?php endif; ?>
    <?php else: ?><div class="publication-empty"><span class="publication-empty-mark" aria-hidden="true">ISP</span><p class="eyebrow eyebrow-dark">Archives de l’établissement</p><h2>Aucune publication pour le moment</h2><p>Les actualités de l’ISP-GOMBE apparaîtront ici dès leur publication.</p><a class="text-link" href="?pages=evenement">Consulter les événements <span aria-hidden="true">↗</span></a></div><?php endif; ?>
</div></section>
