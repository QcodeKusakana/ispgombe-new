<?php $academicYear = is_string($_GET['an'] ?? null) && preg_match('/^\d{4}(?:-\d{4})?$/', $_GET['an']) ? $_GET['an'] : null; ?>
<section class="page-intro section-space academic-intro">
    <div class="institution-container">
        <p class="eyebrow eyebrow-dark">Formations et parcours</p>
        <h1 class="page-title">Départements<?= !empty($activeFaculty) ? ' · ' . htmlspecialchars((string) $activeFaculty, ENT_QUOTES, 'UTF-8') : '' ?></h1>
        <p class="page-lead">Consultez les départements rattachés aux sections de l’Institut et poursuivez vers les informations de formation disponibles.</p>
        <?php if ($academicYear): ?><p class="academic-context">Parcours consulté dans le cadre de l’année académique <?= htmlspecialchars($academicYear, ENT_QUOTES, 'UTF-8') ?>.</p><?php endif; ?>
    </div>
</section>
<section class="academic-content section-space"><div class="institution-container">
    <div class="department-overview"><p>Choisissez un département pour consulter sa présentation, ses filières et les informations académiques disponibles.</p><span><strong><?= number_format(count($departements), 0, ',', ' ') ?></strong> département<?= count($departements) === 1 ? '' : 's' ?></span><?php if (!$academicYear): ?><a href="?pages=faculte">Toutes les sections <span aria-hidden="true">→</span></a><?php endif; ?></div>
    <?php if (!empty($departements)): ?>
        <div class="academic-grid">
            <?php foreach ($departements as $index => $department): ?>
                <article class="academic-card">
                    <div class="academic-card-top"><span class="academic-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span><span class="academic-card-mark" aria-hidden="true">↗</span></div>
                    <p class="academic-card-label"><?= !empty($department['section_titre']) ? htmlspecialchars((string) $department['section_titre'], ENT_QUOTES, 'UTF-8') : 'Département' ?></p>
                    <h2><?= htmlspecialchars((string) $department['titre'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <?php $departmentUrl = $academicYear ? '?pages=session&amp;dep=' . (int) $department['id'] . '&amp;an=' . rawurlencode($academicYear) : '?pages=detail_departement&amp;dep=' . (int) $department['id']; ?>
                    <?php if ($academicYear): ?><span class="academic-card-count">Parcours de l’année <?= htmlspecialchars($academicYear, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
                    <a class="text-link" href="<?= $departmentUrl ?>"><?= $academicYear ? 'Choisir une session' : 'Découvrir le département' ?> <span aria-hidden="true">→</span></a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?><p class="content-note">Aucun département n’est disponible pour cette section, ou la base de données n’est pas encore reliée au site.</p><?php endif; ?>
</div></section>
