<section class="home-carousel" data-home-carousel aria-label="Présentation de l’ISP-GOMBE">
    <div class="institution-container home-slide-inner">
        <div class="hero-copy"><p class="eyebrow">Institut Supérieur Pédagogique de la Gombe · Kinshasa</p>
            <h1><?= htmlspecialchars($siteSettings['hero_title'] ?? "Former aujourd’hui", ENT_QUOTES, "UTF-8") ?><br><em><?= htmlspecialchars($siteSettings['hero_highlight'] ?? "les éducateurs de demain.", ENT_QUOTES, "UTF-8") ?></em></h1>
            <div class="hero-intro"><?= admin_sanitize_rich_text($siteSettings['hero_description'] ?? "Un établissement d’enseignement supérieur dédié à la formation intellectuelle et professionnelle, au cœur de Kinshasa.") ?></div>
            <div class="hero-actions"><a class="button button-gold" href="?pages=faculte">Explorer les formations <span aria-hidden="true">→</span></a><a class="button button-outline" href="?pages=isp">Découvrir l’institut</a></div>
            <p class="hero-location"><span aria-hidden="true">⌖</span> Commune de la Gombe · Kinshasa, RDC</p>
        </div>
        <div class="hero-gallery" data-image-carousel aria-label="Images de l’établissement">
            <div class="hero-gallery-frames" aria-live="off">
                <?php foreach ($imagesAccueil as $position => $imageAccueil): ?>
                    <figure class="gallery-slide<?= $position === 0 ? ' is-active' : '' ?>" data-image-slide role="group" aria-roledescription="image" aria-label="<?= (int) ($position + 1) ?> sur <?= count($imagesAccueil) ?>"<?= $position === 0 ? '' : ' hidden' ?>>
                        <img src="<?= htmlspecialchars((string) $imageAccueil['image_path'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string) $imageAccueil['image_alt'], ENT_QUOTES, 'UTF-8') ?>"<?= $position === 0 ? ' fetchpriority="high"' : ' loading="lazy"' ?>>
                        <figcaption><span class="gallery-kicker"><?= htmlspecialchars((string) $imageAccueil['kicker'], ENT_QUOTES, 'UTF-8') ?></span><strong><?= htmlspecialchars((string) $imageAccueil['title'], ENT_QUOTES, 'UTF-8') ?></strong></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
            <?php if (count($imagesAccueil) > 1): ?><div class="gallery-controls"><div class="carousel-dots" role="group" aria-label="Choisir une image"><?php foreach ($imagesAccueil as $position => $_imageAccueil): ?><button type="button" data-image-slide-to="<?= (int) $position ?>" aria-label="Afficher l’image <?= (int) ($position + 1) ?>"<?= $position === 0 ? ' aria-current="true"' : '' ?>></button><?php endforeach; ?></div><div class="carousel-arrows"><button type="button" data-image-prev aria-label="Image précédente">←</button><button type="button" data-image-next aria-label="Image suivante">→</button><button type="button" data-image-toggle aria-pressed="false" aria-label="Mettre le défilement en pause">Ⅱ</button></div></div><?php endif; ?>
            <span class="gallery-mark" aria-hidden="true"><img src="images/isp-gombe-logo.jpg" alt=""></span>
        </div>
    </div>
</section>

<section class="intro-section section-space">
    <div class="institution-container intro-grid">
        <div class="section-kicker"><span>01</span><span>L’ISP-GOMBE</span></div>
        <div class="intro-copy">
            <h2><?= htmlspecialchars($siteSettings['about_title'] ?? "Un cadre de formation", ENT_QUOTES, "UTF-8") ?><br><em><?= htmlspecialchars($siteSettings['about_highlight'] ?? "au service du savoir.", ENT_QUOTES, "UTF-8") ?></em></h2>
            <div><?= admin_sanitize_rich_text($siteSettings['about_intro'] ?? "L’ISP-GOMBE accompagne ses étudiants dans une formation exigeante, portée par l’apprentissage, la pratique et la vie de campus. Découvrez l’institution, ses formations et les informations utiles pour préparer votre parcours.") ?></div>
            <a class="text-link" href="?pages=isp">En savoir plus sur l’institut <span aria-hidden="true">↗</span></a>
        </div>
        <aside class="institution-facts">
            <p class="eyebrow eyebrow-dark">Découvrir l’établissement</p>
            <a href="?pages=isp&amp;history">Histoire de l’institut <span aria-hidden="true">↗</span></a>
            <a href="?pages=isp&amp;mission">Mission et création <span aria-hidden="true">↗</span></a>
            <a href="?pages=isp&amp;academique">Organisation académique <span aria-hidden="true">↗</span></a>
            <a href="?pages=isp&amp;recherche">Bibliothèque et recherche <span aria-hidden="true">↗</span></a>
            <a href="?pages=campus">Campus et vie étudiante <span aria-hidden="true">↗</span></a>
        </aside>
    </div>
</section>

<section class="governance-section section-space" aria-labelledby="governance-title">
    <div class="institution-container">
        <div class="section-heading governance-heading">
            <div><p class="eyebrow eyebrow-dark">Gouvernance de l’Institut</p><h2 id="governance-title">Le Comité <em>de gestion</em></h2><p>Les autorités qui assurent la direction académique, administrative et financière de l’ISP-GOMBE.</p></div>
            <a class="text-link" href="?pages=comite_gestion">Découvrir les organes de gestion <span aria-hidden="true">↗</span></a>
        </div>
        <?php include __DIR__ . '/../menu/committee_members.php'; ?>
    </div>
</section>

<section class="presentation-video section-space" aria-labelledby="video-heading">
    <div class="institution-container video-grid">
        <div class="video-copy"><p class="eyebrow eyebrow-dark">Présentation de l’établissement</p><h2 id="video-heading">L’ISP-GOMBE<br><em>en quelques images.</em></h2><p>Découvrez l’établissement à travers sa vidéo de présentation.</p><a class="text-link" href="?pages=isp">En savoir plus sur l’institut <span aria-hidden="true">↗</span></a></div>
        <div class="video-frame"><video controls preload="none" playsinline poster="images/isp-gombe-video-poster.svg" aria-label="Vidéo de présentation de l’ISP-GOMBE"><source src="pages/vid/vd.mp4" type="video/mp4">Votre navigateur ne peut pas lire cette vidéo. Vous pouvez consulter <a href="pages/vid/vd.mp4">la vidéo de présentation</a>.</video><p class="video-caption"><span aria-hidden="true">▶</span> Présentation de l’ISP-GOMBE</p></div>
    </div>
</section>

<section class="program-section section-space" id="section" aria-labelledby="formations-title">
    <div class="institution-container">
        <div class="section-heading">
            <div><p class="eyebrow eyebrow-dark">Parcours académiques</p><h2 id="formations-title">Explorer nos <em>formations</em></h2></div>
            <a class="text-link" href="?pages=faculte">Toutes les formations <span aria-hidden="true">→</span></a>
        </div>
        <div class="program-intro"><p>Choisissez une section pour découvrir ses départements et les parcours proposés.</p><span class="program-total"><strong><?= number_format(count($facultesAccueil), 0, ',', ' ') ?></strong> section<?= count($facultesAccueil) === 1 ? '' : 's' ?></span></div>
        <?php if ($facultesAccueil): ?>
            <div class="program-list">
                <?php foreach ($facultesAccueil as $i => $faculte): ?>
                    <article class="program-card">
                        <div class="program-card-top"><span class="program-number"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span><span class="program-card-mark" aria-hidden="true">↗</span></div>
                        <p class="program-card-label">Section de formation</p>
                        <h3 class="program-title"><?= htmlspecialchars((string) $faculte['titre'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <div class="program-card-bottom"><span><?= number_format((int) $faculte['department_count'], 0, ',', ' ') ?> département<?= (int) $faculte['department_count'] === 1 ? '' : 's' ?></span><a href="?pages=detail_section&amp;info=<?= (int) $faculte['id'] ?>">Découvrir la section <span aria-hidden="true">→</span></a></div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="content-note">Les informations sur les sections seront affichées dès que la base de données de l’établissement sera configurée.</p>
        <?php endif; ?>
    </div>
</section>

<section class="news-section section-space">
    <div class="institution-container">
        <div class="section-heading">
            <div><p class="eyebrow">Vie de l’établissement</p><h2>Actualités & <em>annonces</em></h2></div>
            <a class="text-link" href="?pages=actualite">Voir toutes les actualités <span aria-hidden="true">→</span></a>
        </div>
        <?php if ($actualitesAccueil): ?>
            <div class="news-grid">
                <?php foreach ($actualitesAccueil as $actualite): ?>
                    <article class="news-item">
                        <?php if (!empty($actualite['photo'])): ?><a class="news-image" href="?pages=detail&amp;id=<?= (int) $actualite['id_act'] ?>" aria-label="Lire : <?= htmlspecialchars((string) $actualite['titre'], ENT_QUOTES, 'UTF-8') ?>"><img src="admin/media/images_activ/<?= rawurlencode(basename((string) $actualite['photo'])) ?>" alt="" loading="lazy"></a><?php endif; ?>
                        <p class="news-date"><time datetime="<?= htmlspecialchars((string) $actualite['date_pub'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(date('d.m.Y', strtotime((string) $actualite['date_pub'])), ENT_QUOTES, 'UTF-8') ?></time></p>
                        <h3><a href="?pages=detail&amp;id=<?= (int) $actualite['id_act'] ?>"><?= htmlspecialchars((string) $actualite['titre'], ENT_QUOTES, 'UTF-8') ?></a></h3>
                        <p><?= htmlspecialchars(mb_strimwidth(strip_tags((string) $actualite['description']), 0, 150, '…', 'UTF-8'), ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="news-empty"><span aria-hidden="true">✳</span><p>Les prochaines informations de l’établissement seront publiées ici.</p></div>
        <?php endif; ?>
    </div>
</section>

<section class="quick-access section-space">
    <div class="institution-container">
        <div class="section-heading"><div><p class="eyebrow eyebrow-dark">Services et informations</p><h2>Préparer son <em>parcours</em></h2></div></div>
        <div class="quick-access-grid">
            <a href="?pages=inscription"><span>01</span><strong>Admissions</strong><small>Conditions et renseignements</small><b aria-hidden="true">↗</b></a>
            <a href="?pages=loginEtud"><span>02</span><strong>Espace étudiant</strong><small>Connexion et informations personnelles</small><b aria-hidden="true">↗</b></a>
            <a href="?pages=palmares"><span>03</span><strong>Palmarès</strong><small>Consulter les résultats publiés</small><b aria-hidden="true">↗</b></a>
            <a href="?pages=contact"><span>04</span><strong>Nous contacter</strong><small>Écrire à l’administration</small><b aria-hidden="true">↗</b></a>
        </div>
    </div>
</section>

<section class="cta-strip">
    <div class="institution-container cta-inner">
        <div><p class="eyebrow">Votre parcours commence ici</p><h2>Besoin d’informations<br><em>sur les admissions ?</em></h2></div>
        <a class="button button-gold" href="?pages=inscription">Préparer mon inscription <span aria-hidden="true">→</span></a>
    </div>
</section>



