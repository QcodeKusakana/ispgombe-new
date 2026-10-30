<main id="main" class="main">

    <div class="pagetitle">
        <h1>Galerie</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">galerie</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                Ajouter galerie
            </button>
            <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter galerie</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Titre</label>
                                    <input type="text" name="titre_g" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Image</label>
                                    <input type="file" name="photo_g" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Catégorie</label>
                                    <select class="form-control"  name="categ" id="">
                                        <option value="">Selectionner la catégorie</option>
                                        <option value="Chambre & Villa">CHAMBRE & VILLA</option>
                                        <option value="Salle polyvalente">SALLE POLYVALENTE</option>
                                        <option value="Restaurant">RESTAURANT</option>
                                        <option value="Fiesta night club">FIESTA NIGHT CLUB</option>
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
                <?php while($ga=$reqGalerie->fetch()){ ?>
                <div class="card col-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $ga['titre_g'] ?></h5>
                    </div>
                    <img style="width: 100%;height: 25vh;" src="./media/galerie/<?= $ga['photo_g'] ?>" class="card-img-bottom" alt="...">
                </div>
                <?php } ?>
            </div>
    </div>
    </section>

</main><!-- End #main -->