<section class="page-intro section-space academic-intro"><div class="institution-container">
    <p class="eyebrow eyebrow-dark">Palmarès et résultats</p><h1 class="page-title">Choisir un <em>niveau</em></h1>
    <p class="page-lead"><?php if (!empty($selectedDepartment)): ?>Département : <?= htmlspecialchars((string) $selectedDepartment, ENT_QUOTES, 'UTF-8') ?> · <?php endif; ?><?php if (!empty($selectedSession)): ?>Session : <?= htmlspecialchars((string) $selectedSession, ENT_QUOTES, 'UTF-8') ?><?php else: ?>Sélectionnez un niveau pour poursuivre.<?php endif; ?></p>
    <?php if (!empty($academicYear)): ?><p class="academic-context">Année académique <?= htmlspecialchars((string) $academicYear, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
</div></section>
<section class="academic-content section-space"><div class="institution-container">
    <?php if (!empty($niveau)): ?>
        <div class="academic-grid academic-grid-compact">
            <?php foreach ($niveau as $item): ?><a class="academic-link-card" href="?pages=palmaresEtud&amp;dep=<?= (int) $departmentId ?>&amp;an=<?= rawurlencode((string) $academicYear) ?>&amp;ss=<?= (int) $sessionId ?>&amp;niv=<?= (int) $item['id'] ?>"><span>Niveau d’études</span><strong><?= htmlspecialchars((string) $item['titre'], ENT_QUOTES, 'UTF-8') ?></strong><b aria-hidden="true">↗</b></a><?php endforeach; ?>
        </div>
    <?php else: ?><p class="content-note">Sélectionnez d’abord une année, un département et une session pour accéder aux niveaux disponibles.</p><?php endif; ?>
</div></section>
