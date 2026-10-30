<main id="main" class="main">

    <div class="pagetitle">
        <h1>ANNONCE DEPARTEMENT</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">fonds</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#department-announcement-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Nouvelle annonce de département
            </button>
            <div class="modal fade" id="department-announcement-create" tabindex="-1" aria-labelledby="department-announcement-title" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="department-announcement-title">Nouvelle annonce de département</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-12">
                                    <label for="department-announcement-text" class="form-label">Texte de l’annonce <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="resumer" id="department-announcement-text" maxlength="5000" rows="6" required data-rich-text></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="department-announcement-select" class="form-label">Département <span class="text-danger">*</span></label>
                                    <select class="form-select" name="departement" id="department-announcement-select" required>
                                        <option value="">Sélectionner un département</option>
                                        <?php $departement=$bdd->query("SELECT * FROM departement");
                                        foreach($departement as $dep){
                                            ?>
                                            <option value="<?= (int) $dep['id'] ?>"><?= htmlspecialchars((string) $dep['titre'], ENT_QUOTES, 'UTF-8') ?></option>
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
        <section class="section">
            <div class="container">
                <?php if(isset($erreurs)){ echo '<b style="color:lime">'.$erreurs.'</b>';} ?>
                <?php if(isset($erreur)){ echo '<b style="color:red">'.$erreur.'</b>';} ?>
            </div>
            <div class="row">
                <div class="card-body pb-0">
                    <h5 class="card-title">News &amp; Updates <span>| Photo</span></h5>

                        <?php if ($nbrFichier === 0): ?><div class="admin-empty-state">Aucune annonce n’a encore été publiée pour les départements.</div><?php endif; ?>

                    <div class="news">
                        <div class="row">
                            <?php
                            //$reqCouv=$bdd->query("SELECT * FROM couverture ORDER BY id_cv DESC");
                            while($cv=$reqCouv->fetch()){ ?>
                                <div class="post-item clearfix col-12">
                                    <div class="admin-rich-preview"><?= admin_sanitize_rich_text((string) $cv['resumer']) ?></div>
                                    <details class="mb-2"><summary class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier</summary><form method="post" class="mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="announcement_id" value="<?= (int) $cv['id'] ?>"><label class="form-label" for="announcement-department-<?= (int) $cv['id'] ?>">Texte de l’annonce</label><textarea class="form-control mb-2" id="announcement-department-<?= (int) $cv['id'] ?>" name="resumer" maxlength="5000" rows="5" required data-rich-text><?= htmlspecialchars((string) $cv['resumer'], ENT_QUOTES, 'UTF-8') ?></textarea><button class="btn btn-sm btn-primary" type="submit" name="update_announcement" value="1"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Valider les modifications</button></form></details>
                                    <form method="post" class="mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $cv['id'] ?>"><button class="btn btn-sm btn-outline-danger" name="admin_action" value="delete"><i class="ri-delete-bin-6-fill"></i> Supprimer</button></form>
                                </div>
                            <?php } ?>
                        </div>


                    </div><!-- End sidebar recent posts-->

                </div>
            </div>
        </section>

</main><!-- End #main -->
