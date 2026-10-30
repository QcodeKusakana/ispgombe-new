<?php $academicYear = is_string($_GET['an'] ?? null) && preg_match('/^\d{4}(?:-\d{4})?$/', $_GET['an']) ? $_GET['an'] : null; ?>
<section class="page-intro section-space academic-intro">
    <div class="institution-container">
        <p class="eyebrow eyebrow-dark">Organisation académique</p>
        <h1 class="page-title">Nos <em>sections</em></h1>
        <p class="page-lead">Parcourez les sections de l’ISP-GOMBE, puis consultez leurs départements et les informations disponibles.</p>
        <?php if ($academicYear): ?><p class="academic-context">Parcours consulté dans le cadre de l’année académique <?= htmlspecialchars($academicYear, ENT_QUOTES, 'UTF-8') ?>.</p><?php endif; ?>
    </div>
</section>
<section class="academic-content section-space">
    <div class="institution-container">
        <?php if (!empty($faculte)): ?>
            <div class="academic-grid">
                <?php foreach ($faculte as $index => $section): ?>
                    <article class="academic-card">
                        <div class="academic-card-top"><span class="academic-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span><span class="academic-card-mark" aria-hidden="true">↗</span></div>
                        <p class="academic-card-label">Section de formation</p>
                        <h2><?= htmlspecialchars((string) $section['titre'], ENT_QUOTES, 'UTF-8') ?></h2>
                        <span class="academic-card-count"><?= number_format((int) $section['department_count'], 0, ',', ' ') ?> département<?= (int) $section['department_count'] === 1 ? '' : 's' ?></span>
                        <?php $sectionUrl = $academicYear ? '?pages=departement&amp;fac=' . (int) $section['id'] . '&amp;an=' . rawurlencode($academicYear) : '?pages=detail_section&amp;info=' . (int) $section['id']; ?>
                        <a class="text-link" href="<?= $sectionUrl ?>"><?= $academicYear ? 'Choisir un département' : 'Découvrir la section' ?> <span aria-hidden="true">→</span></a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="content-note">La liste des sections apparaîtra ici lorsque la base de données sera reliée au site.</p>
        <?php endif; ?>
    </div>
</section>
