<?php
$campusExcerpt = static function (string $description, int $limit): string {
    $withSpacing = preg_replace('/<\s*\/?\s*(?:p|br|div|li|ul|ol|h[1-6]|blockquote)\b[^>]*>/iu', ' ', $description) ?? $description;
    $plainText = html_entity_decode(strip_tags($withSpacing), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $plainText = preg_replace('/[\s\x{00a0}]+/u', ' ', $plainText) ?? $plainText;
    return htmlspecialchars(mb_strimwidth(trim($plainText), 0, $limit, '…', 'UTF-8'), ENT_QUOTES, 'UTF-8');
};
?>
<section class="campus-intro section-space">
    <div class="institution-container campus-intro-grid">
        <div class="campus-intro-copy">
            <p class="eyebrow">L’Institut au quotidien</p>
            <h1 class="page-title">La vie du <em>campus</em></h1>
            <p class="page-lead">Activités, informations et publications qui racontent la vie de la communauté de l’ISP-GOMBE.</p>
            <a class="campus-explore-link" href="#publications">Explorer les publications <span aria-hidden="true">↓</span></a>
        </div>
        <div class="campus-intro-count" aria-label="<?= number_format((int) ($total ?? 0), 0, ',', ' ') ?> publications disponibles">
            <span>À découvrir</span><strong><?= number_format((int) ($total ?? 0), 0, ',', ' ') ?></strong><small>publication<?= (int) ($total ?? 0) === 1 ? '' : 's' ?> disponible<?= (int) ($total ?? 0) === 1 ? '' : 's' ?></small>
            <i class="campus-count-seal" aria-hidden="true">ISP<br>GOMBE</i>
        </div>
    </div>
</section>
<section class="campus-archive section-space" id="publications">
    <div class="institution-container">
        <div class="campus-archive-heading"><div><p class="eyebrow eyebrow-dark">Actualités de l’établissement</p><h2>Au cœur de <em>notre campus</em></h2></div><span><?= number_format((int) ($total ?? 0), 0, ',', ' ') ?> publication<?= (int) ($total ?? 0) === 1 ? '' : 's' ?></span></div>
        <?php if (!empty($reqArticle)): ?>
            <?php $featuredCampusItem = $reqArticle[0]; $otherCampusItems = array_slice($reqArticle, 1); ?>
            <article class="campus-featured-story">
                <?php if (!empty($featuredCampusItem['photo'])): ?><div class="campus-featured-image"><img src="admin/media/images_activ/<?= rawurlencode(basename((string) $featuredCampusItem['photo'])) ?>" alt="<?= htmlspecialchars((string) $featuredCampusItem['titre'], ENT_QUOTES, 'UTF-8') ?>" fetchpriority="high"></div><?php else: ?><div class="campus-featured-placeholder" aria-hidden="true"><span>ISP-GOMBE <i>·</i> VIE DE CAMPUS</span></div><?php endif; ?>
                <div class="campus-featured-copy">
                    <p class="campus-story-kicker"><span>Publication récente</span><time datetime="<?= htmlspecialchars((string) $featuredCampusItem['date_pub'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(date('d.m.Y', strtotime((string) $featuredCampusItem['date_pub'])), ENT_QUOTES, 'UTF-8') ?></time></p>
                    <h3><?= htmlspecialchars((string) $featuredCampusItem['titre'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p class="campus-story-excerpt"><?= $campusExcerpt((string) $featuredCampusItem['description'], 300) ?></p>
                    <details class="campus-read-more"><summary>Lire le texte complet <span aria-hidden="true">＋</span></summary><div class="campus-full-description"><?= admin_sanitize_rich_text((string) $featuredCampusItem['description']) ?></div></details>
                </div>
            </article>
            <?php if ($otherCampusItems): ?><div class="campus-story-grid">
                <?php foreach ($otherCampusItems as $index => $item): ?>
                    <article class="campus-story-card">
                        <?php if (!empty($item['photo'])): ?><div class="campus-story-image"><img src="admin/media/images_activ/<?= rawurlencode(basename((string) $item['photo'])) ?>" alt="<?= htmlspecialchars((string) $item['titre'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy"></div><?php else: ?><div class="campus-story-placeholder" aria-hidden="true"><span><?= str_pad((string) ($index + 2), 2, '0', STR_PAD_LEFT) ?></span><small>ISP-GOMBE</small></div><?php endif; ?>
                        <div class="campus-story-card-copy"><p class="campus-story-date"><time datetime="<?= htmlspecialchars((string) $item['date_pub'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(date('d.m.Y', strtotime((string) $item['date_pub'])), ENT_QUOTES, 'UTF-8') ?></time></p><h3><?= htmlspecialchars((string) $item['titre'], ENT_QUOTES, 'UTF-8') ?></h3><p class="campus-story-excerpt"><?= $campusExcerpt((string) $item['description'], 185) ?></p><details class="campus-read-more"><summary>Lire le texte complet <span aria-hidden="true">＋</span></summary><div class="campus-full-description"><?= admin_sanitize_rich_text((string) $item['description']) ?></div></details></div>
                    </article>
                <?php endforeach; ?>
            </div><?php endif; ?>
            <?php if (!empty($nbPage) && $nbPage > 1): ?><nav class="archive-pagination campus-pagination" aria-label="Pagination des publications du campus">
                <?php for ($pageNumber = 1; $pageNumber <= $nbPage; $pageNumber++): ?><a href="?pages=campus&amp;pag=<?= $pageNumber ?>"<?= (int) $current === $pageNumber ? ' aria-current="page"' : '' ?>><?= $pageNumber ?></a><?php endfor; ?>
            </nav><?php endif; ?>
        <?php else: ?><div class="campus-empty"><span aria-hidden="true">ISP</span><h2>La vie du campus, bientôt en images</h2><p>Les prochaines activités et informations de l’établissement seront publiées ici.</p></div><?php endif; ?>
    </div>
</section>
