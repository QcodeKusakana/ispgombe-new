<main id="main" class="main">

    <div class="pagetitle">
        <h1>Agents des départements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">departement</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#department-agent-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Ajouter un agent
            </button>
            <div class="modal fade" id="department-agent-create" tabindex="-1" aria-labelledby="department-agent-create-title" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="department-agent-create-title">Ajouter un agent de département</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-6">
                                    <label for="department-agent-name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="noms" id="department-agent-name" maxlength="150" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="department-agent-grade" class="form-label">Grade académique</label>
                                    <input type="text" class="form-control" name="grade" id="department-agent-grade" maxlength="150">
                                </div>
                                <div class="col-md-6">
                                    <label for="department-agent-domain" class="form-label">Domaine <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="domaine" id="department-agent-domain" maxlength="150" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="department-agent-phone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" name="telephone" id="department-agent-phone" maxlength="150">
                                </div>
                                <div class="col-md-6">
                                    <label for="department-agent-email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" name="mail" id="department-agent-email" maxlength="150">
                                </div>
                                <div class="col-md-12">
                                    <label for="department-agent-department" class="form-label">Département <span class="text-danger">*</span></label>
                                    <select class="form-select" name="departement" id="department-agent-department" required>
                                        <option value="">Sélectionner un département</option>
                                        <?php $sections=$bdd->query("SELECT * FROM departement");
                                        foreach($sections as $sec){
                                            ?>
                                            <option value="<?= (int) $sec['id'] ?>"><?= htmlspecialchars((string) $sec['titre'], ENT_QUOTES, 'UTF-8') ?></option>
                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="department-agent-photo" class="form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="photo" id="department-agent-photo" accept="image/jpeg,image/png,image/webp" required>
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
            <?php if(isset($erreurs)){ echo '<div class="alert alert-success">'.$erreurs.'</div>'; } ?>
            <?php if(isset($erreur)){ echo '<div class="alert alert-danger">'.$erreur.'</div>'; } ?>
        </div>

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liste des <span class="text-primary">Membres</span></h5>

                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">Noms</th>
                                <th scope="col">Statut</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while($mb = $reqMembres->fetch()){ ?>
                                <tr>
                                    <td>
                                        <img style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;"
                                             src="./media/membre/<?= rawurlencode((string) $mb['photo']) ?>"
                                             alt="Photo de <?= htmlspecialchars((string) $mb['noms'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy">
                                    </td>
                                    <td class="fw-bold"><?= htmlspecialchars($mb['noms']) ?></td>
                                    <td>
                                        <?php if($mb['valider'] == 1){ ?>
                                            <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id'] ?>"><button class="badge bg-success border-0" name="admin_action" value="deactivate">Activé</button></form>
                                        <?php } else { ?>
                                            <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id'] ?>"><button class="badge bg-secondary border-0" name="admin_action" value="activate">Désactivé</button></form>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="?pages=agent_dep_update&amp;edit=<?= (int) $mb['id'] ?>"
                                           class="btn btn-sm btn-primary me-1" aria-label="Modifier <?= htmlspecialchars((string) $mb['noms'], ENT_QUOTES, 'UTF-8') ?>">
                                            <i class="bi bi-pencil-square" aria-hidden="true"></i> Modifier
                                        </a>
                                        <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $mb['id'] ?>"><button class="btn btn-sm btn-danger" name="admin_action" value="delete" aria-label="Supprimer <?= htmlspecialchars((string) $mb['noms'], ENT_QUOTES, 'UTF-8') ?>"><i class="bi bi-trash" aria-hidden="true"></i> Supprimer</button></form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>


</main><!-- End #main -->
