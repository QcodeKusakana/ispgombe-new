<main id="main" class="main">
    <div class="pagetitle">
        <p class="admin-eyebrow">Résultats académiques</p>
        <h1>Ajouter au palmarès</h1>
        <p>Choisissez le département, la session et le niveau, puis renseignez le diplômé et l’année académique.</p>
    </div>
    <section class="section">
        <?php if (!empty($_SESSION['admin_action_notice'])): ?><div class="alert alert-success" role="status"><?= htmlspecialchars((string) $_SESSION['admin_action_notice'], ENT_QUOTES, 'UTF-8') ?></div><?php unset($_SESSION['admin_action_notice']); endif; ?>
        <?php if ($palmaresMessage): ?><div class="alert alert-<?= htmlspecialchars($palmaresMessage['type'], ENT_QUOTES, 'UTF-8') ?>" role="alert"><?= htmlspecialchars($palmaresMessage['text'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
        <div class="row g-3 mb-4">
            <?php foreach ([['Sessions', 'session', $palmaresSessions, 'nom_s'], ['Niveaux d’études', 'level', $palmaresLevels, 'titre']] as [$heading, $kind, $records, $field]): ?>
                <div class="col-12 col-xl-6"><div class="card h-100"><div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h2>
                    <form method="post" class="d-flex gap-2 mb-3">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" name="admin_action" value="save_<?= $kind ?>">
                        <label class="visually-hidden" for="new-<?= $kind ?>">Nom</label>
                        <input class="form-control" id="new-<?= $kind ?>" name="name" maxlength="50" required placeholder="Ajouter <?= $kind === 'level' ? 'un niveau' : 'une session' ?>">
                        <button class="btn btn-primary text-nowrap" type="submit"><i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Ajouter</button>
                    </form>
                    <?php if (!$records): ?><p class="admin-empty-state mb-0">Aucun élément configuré.</p><?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($records as $record): ?>
                                <li class="list-group-item px-0 d-flex flex-wrap align-items-center gap-2">
                                    <form method="post" class="d-flex flex-grow-1 gap-2">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                        <input type="hidden" name="admin_action" value="save_<?= $kind ?>">
                                        <input type="hidden" name="record_id" value="<?= (int) $record['id'] ?>">
                                        <label class="visually-hidden" for="<?= $kind ?>-<?= (int) $record['id'] ?>">Nom</label>
                                        <input class="form-control" id="<?= $kind ?>-<?= (int) $record['id'] ?>" name="name" maxlength="50" required value="<?= htmlspecialchars((string) $record[$field], ENT_QUOTES, 'UTF-8') ?>">
                                        <button class="btn btn-outline-primary text-nowrap" type="submit"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button>
                                    </form>
                                    <form method="post" onsubmit="return confirm('Supprimer cet élément ?');">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                        <input type="hidden" name="admin_action" value="delete_<?= $kind ?>">
                                        <input type="hidden" name="record_id" value="<?= (int) $record['id'] ?>">
                                        <button class="btn btn-outline-danger" type="submit" aria-label="Supprimer <?= htmlspecialchars((string) $record[$field], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-trash" aria-hidden="true"></i></button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div></div></div>
            <?php endforeach; ?>
        </div>
        <?php if (!$palmaresDepartments || !$palmaresSessions || !$palmaresLevels): ?>
            <div class="alert alert-warning" role="status">Pour publier un résultat, configurez au moins un département, une session et un niveau d’études. Les sessions et niveaux se gèrent ci-dessus ; les départements se gèrent dans Organisation académique → Départements.</div>
        <?php else: ?>
            <div class="card"><div class="card-body">
                <h2 class="card-title">Informations du diplômé</h2>
                <form class="row g-3" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                    <div class="col-12 col-lg-6"><label class="form-label" for="palmares-name">Nom complet <span class="text-danger">*</span></label><input class="form-control" id="palmares-name" name="noms" maxlength="50" required value="<?= htmlspecialchars((string) ($_POST['noms'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"></div>
                    <div class="col-12 col-lg-6"><label class="form-label" for="palmares-year">Année académique <span class="text-danger">*</span></label><input class="form-control" id="palmares-year" name="anne" maxlength="50" placeholder="Ex. 2024-2025" required value="<?= htmlspecialchars((string) ($_POST['anne'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"></div>
                    <div class="col-12 col-md-4"><label class="form-label" for="palmares-department">Département <span class="text-danger">*</span></label><select class="form-select" id="palmares-department" name="departement" required><option value="">Sélectionner un département</option><?php foreach ($palmaresDepartments as $department): ?><option value="<?= (int) $department['id'] ?>" <?= (int) ($_POST['departement'] ?? 0) === (int) $department['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) ($department['section_titre'] ? $department['section_titre'] . ' · ' : '') . $department['titre'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div>
                    <div class="col-12 col-md-4"><label class="form-label" for="palmares-session">Session <span class="text-danger">*</span></label><select class="form-select" id="palmares-session" name="session" required><option value="">Sélectionner une session</option><?php foreach ($palmaresSessions as $session): ?><option value="<?= (int) $session['id'] ?>" <?= (int) ($_POST['session'] ?? 0) === (int) $session['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $session['nom_s'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div>
                    <div class="col-12 col-md-4"><label class="form-label" for="palmares-level">Niveau <span class="text-danger">*</span></label><select class="form-select" id="palmares-level" name="niveau" required><option value="">Sélectionner un niveau</option><?php foreach ($palmaresLevels as $level): ?><option value="<?= (int) $level['id'] ?>" <?= (int) ($_POST['niveau'] ?? 0) === (int) $level['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $level['titre'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div>
                    <div class="col-12"><button class="btn btn-primary" name="btn_palm" value="1" type="submit">Enregistrer le résultat</button></div>
                </form>
            </div></div>
        <?php endif; ?>
        <div class="card mt-4"><div class="card-body">
            <div class="admin-card-heading"><div><h2 class="card-title">Résultats publiés</h2><p>Modifiez ou retirez les entrées du palmarès. Les 200 résultats les plus récents sont affichés.</p></div></div>
            <div class="table-responsive"><table class="table align-middle"><thead><tr><th>Diplômé</th><th>Année</th><th>Département</th><th>Session</th><th>Niveau</th><th>Actions</th></tr></thead><tbody>
                <?php foreach (($palmaresRows ?? []) as $row): ?>
                    <tr><td><?= htmlspecialchars((string) $row['noms'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string) $row['anne'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string) (($row['section_titre'] ? $row['section_titre'] . ' · ' : '') . ($row['departement_titre'] ?? '')), ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string) ($row['session_titre'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars((string) ($row['niveau_titre'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td><td><details><summary class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier</summary><form method="post" class="row g-2 mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $row['id_pe'] ?>"><input type="hidden" name="admin_action" value="update"><div class="col-12"><label class="form-label">Nom complet</label><input class="form-control" name="noms" maxlength="50" required value="<?= htmlspecialchars((string) $row['noms'], ENT_QUOTES, 'UTF-8') ?>"></div><div class="col-12"><label class="form-label">Année académique</label><input class="form-control" name="anne" maxlength="50" required value="<?= htmlspecialchars((string) $row['anne'], ENT_QUOTES, 'UTF-8') ?>"></div><div class="col-12"><label class="form-label">Département</label><select class="form-select" name="departement" required><?php foreach ($palmaresDepartments as $department): ?><option value="<?= (int) $department['id'] ?>" <?= (int) $row['departement'] === (int) $department['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) ($department['section_titre'] ? $department['section_titre'] . ' · ' : '') . $department['titre'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div><div class="col-12"><label class="form-label">Session</label><select class="form-select" name="session" required><?php foreach ($palmaresSessions as $session): ?><option value="<?= (int) $session['id'] ?>" <?= (int) $row['session'] === (int) $session['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $session['nom_s'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div><div class="col-12"><label class="form-label">Niveau</label><select class="form-select" name="niveau" required><?php foreach ($palmaresLevels as $level): ?><option value="<?= (int) $level['id'] ?>" <?= (int) $row['niveau'] === (int) $level['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $level['titre'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div><div class="col-12"><button class="btn btn-primary btn-sm" type="submit"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button></div></form></details><form method="post" class="mt-2" onsubmit="return confirm('Supprimer ce résultat du palmarès ?');"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $row['id_pe'] ?>"><button class="btn btn-sm btn-outline-danger" name="admin_action" value="delete" type="submit"><i class="bi bi-trash me-1" aria-hidden="true"></i> Supprimer</button></form></td></tr>
                <?php endforeach; ?>
            </tbody></table></div>
            <?php if (empty($palmaresRows)): ?><p class="admin-empty-state">Aucun résultat enregistré.</p><?php endif; ?>
        </div></div>
    </section>
</main>
