<section class="page-intro section-space results-intro">
    <div class="institution-container results-hero">
        <div class="results-hero-copy">
            <p class="eyebrow"><span class="results-eyebrow-mark" aria-hidden="true"></span> Secrétariat général académique</p>
            <h1 class="page-title">Palmarès <em>académique</em></h1>
            <p class="page-lead">Consultez les résultats publiés par l’ISP-GOMBE. Sélectionnez une année pour parcourir les sections, départements et sessions disponibles.</p>
        </div>
        <div class="results-path" aria-label="Étapes de consultation">
            <p>Parcours de consultation</p>
            <ol><li><span>01</span> Année académique</li><li><span>02</span> Section et département</li><li><span>03</span> Session et niveau</li></ol>
        </div>
    </div>
</section>
<section class="academic-content section-space results-archive">
    <div class="institution-container">
        <div class="results-archive-heading">
            <div><p class="eyebrow eyebrow-dark">Archives officielles</p><h2>Résultats par <em>année</em></h2><p>Choisissez une archive pour consulter les résultats correspondants.</p></div>
            <?php if (!empty($annee)): ?><span class="results-count"><?= count($annee) ?> <?= count($annee) === 1 ? 'année disponible' : 'années disponibles' ?></span><?php endif; ?>
        </div>
        <?php if (!empty($annee)): ?>
            <div class="academic-grid academic-grid-compact results-year-grid">
                <?php foreach ($annee as $entry): ?><a class="academic-link-card results-year-card" href="?pages=faculte&amp;an=<?= rawurlencode((string) $entry['intitule']) ?>"><span>Année académique</span><strong><?= htmlspecialchars((string) $entry['intitule'], ENT_QUOTES, 'UTF-8') ?></strong><b aria-hidden="true">→</b></a><?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="results-empty">
                <span class="results-empty-icon" aria-hidden="true"><svg viewBox="0 0 48 48" focusable="false"><path d="m4 17 20-10 20 10-20 10L4 17Z"/><path d="M12 21v10c7 6 17 6 24 0V21M44 18v13"/></svg></span>
                <div><p class="results-empty-label">Archives en préparation</p><h3>Aucun palmarès publié pour le moment</h3><p>Les années apparaîtront ici dès que le Secrétariat général académique aura publié des résultats.</p></div>
            </div>
        <?php endif; ?>
        <aside class="results-note">
            <div><p class="eyebrow eyebrow-dark">Besoin d’aide ?</p><h2>Une question sur un résultat ?</h2><p>Pour toute question concernant un palmarès ou une demande liée à vos données, contactez l’administration de l’Institut.</p></div>
            <a class="results-contact-link" href="?pages=contact">Contacter l’administration <span aria-hidden="true">↗</span></a>
        </aside>
    </div>
</section>
