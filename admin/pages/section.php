<main id="main" class="main">

    <div class="pagetitle">
        <h1>Sections</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">section</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#section-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Ajouter une section
            </button>
            <div class="modal fade" id="section-create" tabindex="-1" aria-labelledby="section-create-title" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="section-create-title">Nouvelle section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-12">
                                    <label for="section-title" class="form-label">Nom de la section <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="titre" id="section-title" maxlength="255" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="section-summary" class="form-label">Résumé</label>
                                    <textarea class="form-control" name="resume" id="section-summary" maxlength="20000" rows="5" data-rich-text></textarea>
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
                    <h5 class="card-title">Liste des <span>| Sections</span></h5>

                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while($mb=$reqMembres->fetch()){ ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars((string) $mb['titre'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><details><summary class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier</summary><form method="post" class="mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="section_id" value="<?= (int) $mb['id'] ?>"><label class="form-label" for="section-title-<?= (int) $mb['id'] ?>">Nom</label><input class="form-control mb-2" id="section-title-<?= (int) $mb['id'] ?>" name="titre" maxlength="255" required value="<?= htmlspecialchars((string) $mb['titre'], ENT_QUOTES, 'UTF-8') ?>"><label class="form-label" for="section-resume-<?= (int) $mb['id'] ?>">Résumé</label><textarea class="form-control mb-2" id="section-resume-<?= (int) $mb['id'] ?>" name="resume" maxlength="20000" rows="4" data-rich-text><?= htmlspecialchars((string) $mb['resume'], ENT_QUOTES, 'UTF-8') ?></textarea><button class="btn btn-sm btn-primary" name="update_section" value="1"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button></form></details><form method="post" class="d-inline mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id'] ?>"><button class="btn btn-sm btn-outline-danger" name="admin_action" value="delete"><i class="bi bi-trash me-1" aria-hidden="true"></i> Supprimer</button></form></td>
                            </tr>
                        <?php } if ($reqMembres->rowCount() === 0): ?><tr><td colspan="2"><div class="admin-empty-state">Aucune section enregistrée pour le moment.</div></td></tr><?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
    </div>
    </section>

</main><!-- End #main -->
