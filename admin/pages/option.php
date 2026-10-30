<main id="main" class="main">

    <div class="pagetitle">
        <h1>Options de formation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">option</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#option-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Ajouter une option
            </button>
            <div class="modal fade" id="option-create" tabindex="-1" aria-labelledby="option-create-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="option-create-title">Nouvelle option de formation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-12">
                                    <label for="option-title" class="form-label">Nom de l’option <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="titre" id="option-title" maxlength="255" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="option-department" class="form-label">Département <span class="text-danger">*</span></label>
                                    <select class="form-select" name="departement" id="option-department" required>
                                        <option value="">Sélectionner un département</option>
                                        <?php $sections=$bdd->query("SELECT * FROM departement");
                                            foreach($sections as $sec){
                                        ?>
                                                <option value="<?= (int) $sec['id'] ?>"><?= htmlspecialchars((string) $sec['titre'], ENT_QUOTES, 'UTF-8') ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="text-left">
                                    <button type="submit" name="save" class="btn btn-primary"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1" aria-hidden="true"></i> Fermer</button>
                        </div>
                    </div>
                </div><!-- End Disabled Backdrop Modal-->

            </div>
        </div>
        <div class="container">
            <?php if(isset($erreurs)){ echo '<b style="color:lime">'.$erreurs.'</b>';} ?>
            <?php if(isset($erreur)){ echo '<b style="color:red">'.$erreur.'</b>';} ?>
        </div>
        <section class="section">
            <div class="row">
                <div class="card-body pb-0">
                    <h5 class="card-title">Liste des <span>| Options</span></h5>

                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Département</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while($mb=$reqMembres->fetch()){ ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars((string) $mb['titre_opt'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars((string) $mb['titre_dep'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><details><summary class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier</summary><form method="post" class="mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="option_id" value="<?= (int) $mb['id_opt'] ?>"><label class="form-label" for="option-title-<?= (int) $mb['id_opt'] ?>">Nom</label><input class="form-control mb-2" id="option-title-<?= (int) $mb['id_opt'] ?>" name="titre" maxlength="255" required value="<?= htmlspecialchars((string) $mb['titre_opt'], ENT_QUOTES, 'UTF-8') ?>"><label class="form-label" for="option-department-<?= (int) $mb['id_opt'] ?>">Département</label><select class="form-select mb-2" id="option-department-<?= (int) $mb['id_opt'] ?>" name="departement" required><?php foreach ($optionDepartmentOptions as $departmentOption): ?><option value="<?= (int) $departmentOption['id'] ?>" <?= (int) $mb['departement'] === (int) $departmentOption['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $departmentOption['titre'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select><button class="btn btn-sm btn-primary" name="update_option" value="1"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button></form></details><form method="post" class="d-inline mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id_opt'] ?>"><button class="btn btn-sm btn-outline-danger" name="admin_action" value="delete"><i class="bi bi-trash me-1" aria-hidden="true"></i> Supprimer</button></form></td>
                            </tr>
                        <?php } if ($reqMembres->rowCount() === 0): ?><tr><td colspan="3"><div class="admin-empty-state">Aucune option enregistrée pour le moment.</div></td></tr><?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
    </div>
    </section>

</main><!-- End #main -->
