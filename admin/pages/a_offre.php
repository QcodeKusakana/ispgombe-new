<main id="main" class="main">

    <div class="pagetitle">
        <h1>Offre</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">offre</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                Ajouter un offre
            </button>
            <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter offre</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Titre</label>
                                    <input type="text" name="titre_of" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Prix</label>
                                    <input type="number" name="prix" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Description</label>
                                    <textarea class="form-control" name="desc_of" id="" cols="5" rows="2"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Catégorie</label>
                                    <select class="form-control"  name="categorie" id="">
                                        <option value="">Selectionner la catégorie</option>
                                        <option value="Service">SERVICES</option>
                                        <option value="HLC Gastro">HLC GASTRO</option>
                                        <option value="Specialite du coin">SPECIALITES DU COIN</option>
                                        <option value="Autre">AUTRES</option>
                                    </select>
                                </div>
                                <div class="text-left">
                                    <button type="submit" name="save" class="btn btn-primary"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <div class="card-body">
                    <h5 class="card-title">Liste des offres</h5>

                    <!-- List group with Advanced Contents -->
                    <div class="list-group">
                        <?php while($off=$reqOffre->fetch()){?>
                        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= $off['titre_of'] ?></h5>
                                <small><?= $off['prix'] ?>$</small>
                            </div>
                            <p class="mb-1"><?= $off['desc_of'] ?></p>
                            <small><?= $off['categorie'] ?></small>
                        </a>
                        <?php }  ?>
                    </div><!-- End List group Advanced Content -->

                </div>
            </div>
    </div>
    </section>

</main><!-- End #main -->