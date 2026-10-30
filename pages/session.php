<section class="page-intro section-space academic-intro"><div class="institution-container">
    <p class="eyebrow eyebrow-dark">Parcours académique</p><h1 class="page-title">Sessions <em>d’examen</em></h1>
    <p class="page-lead"><?= !empty($selectedDepartment) ? 'Département : ' . htmlspecialchars((string) $selectedDepartment, ENT_QUOTES, 'UTF-8') . ' · ' : '' ?>Choisissez une session pour consulter les niveaux et les palmarès publiés.</p>
    <?php if (!empty($academicYear)): ?><p class="academic-context">Année académique <?= htmlspecialchars((string) $academicYear, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
</div></section>
<section class="academic-content section-space"><div class="institution-container">
    <?php if (!empty($departmentId) && !empty($academicYear) && !empty($selectedDepartment) && !empty($session)): ?>
        <div class="academic-grid academic-grid-compact">
            <?php foreach ($session as $item): ?><a class="academic-link-card" href="?pages=niveau&amp;dep=<?= (int) $departmentId ?>&amp;an=<?= rawurlencode((string) $academicYear) ?>&amp;ss=<?= (int) $item['id'] ?>"><span>Session</span><strong><?= htmlspecialchars((string) $item['nom_s'], ENT_QUOTES, 'UTF-8') ?></strong><b aria-hidden="true">↗</b></a><?php endforeach; ?>
        </div>
    <?php else: ?><p class="content-note">Sélectionnez d’abord une section et un département pour afficher les sessions correspondantes.</p><?php endif; ?>
</div></section>
