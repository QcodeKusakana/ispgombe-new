<?php
$siteContentGroups = [
    ['title' => 'Bandeau d’accueil', 'description' => 'Les textes principaux visibles dès l’arrivée sur le site.', 'fields' => ['hero_title', 'hero_highlight', 'hero_description']],
    ['title' => 'Présentation de l’Institut', 'description' => 'Le message institutionnel affiché sur la page d’accueil.', 'fields' => ['about_title', 'about_highlight', 'about_intro']],
    ['title' => 'Admissions et coordonnées', 'description' => 'Les renseignements destinés aux futurs étudiants et aux visiteurs.', 'fields' => ['admissions_notice', 'contact_email', 'contact_phone', 'contact_address']],
    ['title' => 'Pages institutionnelles', 'description' => 'Les textes des rubriques de présentation, de recherche et de vie du campus.', 'fields' => ['institution_history', 'institution_mission', 'institution_vision', 'institution_values', 'institution_organization', 'institution_authorities', 'institution_administration', 'institution_budget', 'campus_description', 'research_description']],
];
?>
<main id="main" class="main">
    <div class="pagetitle"><p class="admin-eyebrow">Édition du site public</p><h1>Contenu institutionnel</h1><p>Modifiez les textes affichés sur l’accueil et les pages de l’Institut.</p></div>
    <section class="section">
        <?php if ($siteContentMessage): ?><div class="alert alert-<?= htmlspecialchars($siteContentMessage['type'], ENT_QUOTES, 'UTF-8') ?>" role="status"><?= htmlspecialchars($siteContentMessage['text'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
        <form method="post" class="admin-content-edit-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
            <div class="admin-content-actions d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3"><p class="text-muted mb-0">Les champs restent visibles. Cliquez sur Modifier pour les déverrouiller.</p><div class="d-flex flex-wrap gap-2"><button class="btn btn-outline-primary" type="button" data-edit-content aria-pressed="false"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier</button><button class="btn btn-primary" type="submit" name="save_site_content"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button></div></div>
            <?php foreach ($siteContentGroups as $group): ?><section class="card mb-3"><div class="card-body">
                <div class="mb-3"><h2 class="card-title mb-1"><?= htmlspecialchars($group['title'], ENT_QUOTES, 'UTF-8') ?></h2><p class="text-muted mb-0"><?= htmlspecialchars($group['description'], ENT_QUOTES, 'UTF-8') ?></p></div>
                <div class="row g-3">
                    <?php foreach ($group['fields'] as $key): if (!isset($siteContentFields[$key])) { continue; } $field = $siteContentFields[$key]; $value = $siteContentValues[$key] ?? ''; $inputType = $key === 'contact_email' ? 'email' : ($key === 'contact_phone' ? 'tel' : 'text'); ?>
                        <div class="col-12 <?= in_array($key, ['hero_title', 'hero_highlight', 'about_title', 'about_highlight', 'contact_email', 'contact_phone'], true) ? 'col-lg-6' : '' ?>">
                            <label class="form-label" for="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($field['label'], ENT_QUOTES, 'UTF-8') ?></label>
                            <?php if (in_array($key, ['hero_title', 'hero_highlight', 'about_title', 'about_highlight', 'contact_email', 'contact_phone'], true)): ?>
                                <input class="form-control" id="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>" name="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>" value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" maxlength="<?= (int) $field['max'] ?>" type="<?= $inputType ?>" readonly>
                            <?php else: ?>
                            <textarea class="form-control" id="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>" name="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>" rows="<?= in_array($key, ['hero_description', 'about_intro', 'contact_address'], true) ? 3 : 5 ?>" maxlength="<?= (int) $field['max'] ?>" readonly<?= in_array($key, ['hero_description', 'about_intro', 'admissions_notice', 'institution_history', 'institution_mission', 'institution_vision', 'institution_values', 'institution_organization', 'institution_authorities', 'institution_administration', 'institution_budget', 'campus_description', 'research_description'], true) ? ' data-rich-text' : '' ?>><?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?></textarea>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div></section><?php endforeach; ?>
            <button class="btn btn-primary" type="submit" name="save_site_content"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer les modifications</button>
        </form>
    </section>
</main>





