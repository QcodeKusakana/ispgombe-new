<main id="main" class="main">

    <div class="pagetitle">
        <h1>Membres de la section</h1>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#faculty-staff-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Ajouter un membre
            </button>
            <div class="modal fade" id="faculty-staff-create" tabindex="-1" aria-labelledby="faculty-staff-create-title" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="faculty-staff-create-title">Ajouter un membre de section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-6">
                                    <label for="faculty-staff-name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="noms" id="faculty-staff-name" maxlength="25" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="faculty-staff-phone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" name="telephone" id="faculty-staff-phone" maxlength="25">
                                </div>
                                <div class="col-md-6">
                                    <label for="faculty-staff-email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" name="mail" id="faculty-staff-email" maxlength="255">
                                </div>
                                <div class="col-md-6">
                                    <label for="faculty-staff-role" class="form-label">Fonction <span class="text-danger">*</span></label>
                                    <select class="form-select" name="fonction" id="faculty-staff-role" required>
                                        <option value="">Sélectionner une fonction</option>
                                        <option value="CHEF DE SECTION">CHEF DE SECTION</option>
                                        <option value="CHARGE D'ENSEIGNEMENT">CHARGE D'ENSEIGNEMENT</option>
                                        <option value="CHARGE DE RECHERCHE">CHARGE DE RECHERCHE</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="faculty-staff-section" class="form-label">Section <span class="text-danger">*</span></label>
                                    <select class="form-select" name="faculte" id="faculty-staff-section" required>
                                        <option value="">Sélectionner une section</option>
                                        <?php $sections=$bdd->query("SELECT * FROM faculte");
                                        foreach($sections as $sec){
                                            ?>
                                            <option value="<?= (int) $sec['id'] ?>"><?= htmlspecialchars((string) $sec['titre'], ENT_QUOTES, 'UTF-8') ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="faculty-staff-photo" class="form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="photo" id="faculty-staff-photo" accept="image/jpeg,image/png,image/webp" required>
                                    <div class="form-text">JPG, PNG ou WebP — 15 Mo maximum.</div>
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
        <div class="container mt-4">
            <?php if (isset($erreurs)) : ?>
                <div class="alert alert-success">
                    <?= $erreurs ?>
                </div>
            <?php endif; ?>

            <?php if (isset($erreur)) : ?>
                <div class="alert alert-danger">
                    <?= $erreur ?>
                </div>
            <?php endif; ?>
        </div>

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des <span class="text-primary">Membres</span></h5>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Noms</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while ($mb = $reqMembres->fetch()) : ?>
                                    <tr>
                                        <td>
                                            <img src="./media/membre/<?= rawurlencode((string) $mb['photo']) ?>" alt="Photo de <?= htmlspecialchars((string) $mb['noms'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy" class="rounded-circle" style="width:50px; height:50px; object-fit:cover;">
                                        </td>
                                        <td class="fw-bold"><?= htmlspecialchars($mb['noms']) ?></td>
                                        <td>
                                            <?php if ($mb['valider'] == 1) : ?>
                                                <span class="badge bg-success">Activé</span>
                                                <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id'] ?>"><button class="btn btn-link text-warning p-0" name="admin_action" value="deactivate" title="Désactiver"><i class="bi bi-x-circle"></i></button></form>
                                            <?php else : ?>
                                                <span class="badge bg-secondary">Désactivé</span>
                                                <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id'] ?>"><button class="btn btn-link text-success p-0" name="admin_action" value="activate" title="Activer"><i class="bi bi-check-circle"></i></button></form>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="?pages=a_membre_update&amp;edit=<?= (int) $mb['id'] ?>" class="btn btn-sm btn-primary me-1" aria-label="Modifier <?= htmlspecialchars((string) $mb['noms'], ENT_QUOTES, 'UTF-8') ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id'] ?>"><button class="btn btn-sm btn-danger" name="admin_action" value="delete" aria-label="Supprimer <?= htmlspecialchars((string) $mb['noms'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-trash" aria-hidden="true"></i></button></form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>

</main><!-- End #main -->
