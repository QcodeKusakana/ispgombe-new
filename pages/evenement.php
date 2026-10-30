<?php
$activiteItems = $activiteItems ?? [];
$escapeActivity = static fn($value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$formatActivityDate = static function ($value): string { $timestamp = strtotime((string) $value); return $timestamp ? date('d.m.Y', $timestamp) : 'Date non précisée'; };
?>
<section class="page-intro section-space publication-intro event-intro"><div class="institution-container publication-intro-grid">
    <div><p class="eyebrow eyebrow-dark">Agenda de l’établissement</p><h1 class="page-title">Événements <em>& activités</em></h1><p class="page-lead">Les activités et moments de la vie institutionnelle partagés par l’ISP-GOMBE.</p></div>
    <div class="publication-count event-count"><span>ACTIVITÉS PUBLIÉES</span><strong><?= (int) ($total ?? 0) ?></strong><small>dans les archives de l’Institut</small></div>
</div></section>
<section class="event-archive section-space"><div class="institution-container">
    <nav class="publication-switch" aria-label="Rubriques de la vie de l’établissement"><a href="?pages=actualite">Actualités <span aria-hidden="true">↗</span></a><a href="?pages=evenement" aria-current="page">Événements <span><?= (int) ($total ?? 0) ?></span></a></nav>
    <?php if ($activiteItems): ?><div class="event-stream" aria-label="Activités publiées">
        <?php foreach ($activiteItems as $activity): $timestamp = strtotime((string) $activity['date_pub']); ?>
            <article class="event-card">
                <div class="event-date-block"><span><?= $timestamp ? date('d', $timestamp) : '—' ?></span><small><?= $timestamp ? date('m.Y', $timestamp) : '—' ?></small><b>PUBLICATION</b></div>
                <?php if (!empty($activity['photo'])): ?><a class="event-card-image" href="?pages=detail&amp;id=<?= (int) $activity['id_act'] ?>&amp;source=evenement" aria-label="Lire l’activité : <?= $escapeActivity($activity['titre']) ?>"><img src="admin/media/images_activ/<?= rawurlencode(basename((string) $activity['photo'])) ?>" alt="" loading="lazy"></a><?php else: ?><div class="event-card-image event-card-placeholder" aria-hidden="true"><span>ISP<br>GOMBE</span></div><?php endif; ?>
                <div class="event-card-copy"><p class="event-card-overline">Vie institutionnelle <span aria-hidden="true">·</span> Publié le <?= $escapeActivity($formatActivityDate($activity['date_pub'])) ?></p><h2><a href="?pages=detail&amp;id=<?= (int) $activity['id_act'] ?>&amp;source=evenement"><?= $escapeActivity($activity['titre']) ?></a></h2><p><?= $escapeActivity(mb_strimwidth(strip_tags((string) $activity['description']), 0, 230, '…', 'UTF-8')) ?></p><a class="event-read-link" href="?pages=detail&amp;id=<?= (int) $activity['id_act'] ?>&amp;source=evenement">Découvrir l’activité <span aria-hidden="true">→</span></a></div>
            </article>
        <?php endforeach; ?>
    </div>
    <?php if (!empty($nbPage) && $nbPage > 1): ?><nav class="archive-pagination" aria-label="Pagination des événements"><?php for ($pageNumber = 1; $pageNumber <= $nbPage; $pageNumber++): ?><a href="?pages=evenement&amp;pag=<?= $pageNumber ?>"<?= (int) $current === $pageNumber ? ' aria-current="page"' : '' ?>><?= $pageNumber ?></a><?php endfor; ?></nav><?php endif; ?>
    <?php else: ?><div class="publication-empty"><span class="publication-empty-mark" aria-hidden="true">ISP</span><p class="eyebrow eyebrow-dark">Agenda institutionnel</p><h2>Aucune activité publiée</h2><p>Les événements et activités de l’ISP-GOMBE apparaîtront ici dès leur publication.</p><a class="text-link" href="?pages=actualite">Voir les actualités <span aria-hidden="true">↗</span></a></div><?php endif; ?>
</div></section>
