<main id="main" class="main">

    <div class="pagetitle">
        <h1>A LA UNE</h1>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#faculty-cover-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Ajouter une image
            </button>
            <div class="modal fade" id="faculty-cover-create" tabindex="-1" aria-labelledby="faculty-cover-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="faculty-cover-title">Image de couverture de section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-12">
                                    <label for="faculty-cover-photo" class="form-label">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="photo_cv" id="faculty-cover-photo" accept="image/jpeg,image/png,image/webp" required>
                                    <div class="form-text">JPG, PNG ou WebP — 15 Mo maximum.</div>
                                </div>
                                <div class="col-md-12">
                                    <label for="faculty-cover-section" class="form-label">Section <span class="text-danger">*</span></label>
                                    <select class="form-select" name="faculte" id="faculty-cover-section" required>
                                        <option value="">Sélectionner une section</option>
                                        <?php $sections=$bdd->query("SELECT * FROM faculte");
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
    <section class="section">
        <div class="container">
            <?php if(isset($erreurs)){ echo '<b style="color:lime">'.$erreurs.'</b>';} ?>
            <?php if(isset($erreur)){ echo '<b style="color:red">'.$erreur.'</b>';} ?>
        </div>
        <div class="row">
            <div class="card-body pb-0">
                <h5 class="card-title">News &amp; Updates <span>| Photo</span></h5>

                <?php if ($nbrFichier === 0): ?><div class="admin-empty-state">Aucune image de couverture n’est encore enregistrée pour les sections.</div><?php endif; ?>

                <div class="news">
                    <div class="row">
                        <?php
                        //$reqCouv=$bdd->query("SELECT * FROM couverture ORDER BY id_cv DESC");
                        while($cv=$reqCouv->fetch()){ ?>
                        <div class="post-item clearfix col-12 col-sm-6 col-xl-4">
                            <img src="media/couverture/<?= rawurlencode((string) $cv['photo_cv']) ?>" alt="Image de couverture de la section" loading="lazy" style="width: 100%;height: 38vh;object-fit:cover;">
                            <details class="mt-2"><summary class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier</summary><form method="post" enctype="multipart/form-data" class="row g-2 mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="cover_id" value="<?= (int) $cv['id_cv'] ?>"><div class="col-12"><label class="form-label" for="cover-section-<?= (int) $cv['id_cv'] ?>">Section</label><select class="form-select" name="faculte" id="cover-section-<?= (int) $cv['id_cv'] ?>" required><?php foreach ($sectionsForEdit as $sectionForEdit): ?><option value="<?= (int) $sectionForEdit['id'] ?>" <?= (int) $cv['faculte'] === (int) $sectionForEdit['id'] ? 'selected' : '' ?>><?= htmlspecialchars((string) $sectionForEdit['titre'], ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div><div class="col-12"><label class="form-label" for="cover-photo-<?= (int) $cv['id_cv'] ?>">Remplacer l’image (facultatif)</label><input class="form-control" type="file" name="photo_cv" id="cover-photo-<?= (int) $cv['id_cv'] ?>" accept="image/jpeg,image/png,image/webp"></div><div class="col-12"><button class="btn btn-sm btn-primary" type="submit" name="update_cover" value="1"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button></div></form></details>
                            <form method="post" class="mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $cv['id_cv'] ?>"><button class="btn btn-sm btn-outline-danger" name="admin_action" value="delete"><i class="ri-delete-bin-6-fill"></i> Supprimer</button></form>
                        </div>
                        <?php } ?>
                    </div>


                </div><!-- End sidebar recent posts-->

            </div>
        </div>
    </section>

</main><!-- End #main -->
