<?php
    if (isset($_GET['info']) AND !empty($_GET['info']))
    {

        $get_id=(int)($_GET['info']);
        $section=$bdd->prepare("SELECT * FROM faculte WHERE id=? ORDER by id DESC LIMIT 1");
        $section->execute(array($get_id));
    }
?>
<style>
    .section {
        padding-top: 20px;
        padding-bottom: 90px;
    }
</style>
<?php foreach($section as $sec){
    $personnels=$bdd->prepare("SELECT * FROM personnel WHERE faculte=? ORDER by id DESC");
    $personnels->execute(array($sec['id']));
    ?>

    <section id="contact" class="contact section bg-light py-4">
        <div class="container">
            <div class="row">
                <!-- Colonne des enseignants -->
                <!-- Colonne des enseignants -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="text-center">Equipe dirigeante</h4>
                            <hr>
                            <?php foreach($personnels as $p){ ?>
                                <div class="card my-3 text-center">
                                    <img src="../admin/media/membre/<?=$p['photo'] ?>"
                                         class="rounded-circle mx-auto d-block"
                                         alt="Photo Enseignant"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $p['noms'] ?></h5>
                                        <p class="card-text"><strong><?= $p['fonction'] ?></strong></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>


                <!-- Colonne du carousel et description -->
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="card shadow-sm border-0 p-3">
                        <h5 class="text-primary">SECTION : <?= $sec['titre'] ?></h5>
                        <hr>
                        <div id="carouselExampleControls" class="carousel slide carousel-fade mb-4" data-bs-ride="carousel">
                            <div class="carousel-inner" style="border-radius: 10px; overflow: hidden;">
                                <?php
                                $reqCouv = $bdd->prepare("SELECT * FROM couverture WHERE faculte=?");
                                $reqCouv->execute([$_GET['info']]);
                                $first = true;
                                while ($cv = $reqCouv->fetch()) { ?>
                                    <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                        <img src="./admin/media/couverture/<?= htmlspecialchars($cv['photo_cv']) ?>" class="d-block w-100" style="object-fit: cover; height: 100%;" alt="Image couverture">
                                    </div>
                                    <?php $first = false;
                                } ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>

                        <!-- Contact-Info -->
                        <div class="contact-info p-3 bg-light rounded">
                            <h3 class="title"><b>Description</b></h3>
                            <hr/>
                            <p><?= nl2br(htmlspecialchars($sec['resume'])) ?></p>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </section>

    <!-- Section Départements et Annonces -->
    <section class="events section bg-white py-4">
        <div class="container">
            <div class="row">
                <!-- Départements -->
                <div class="col-lg-6 col-12">
                    <h2 class="title text-primary">Départements</h2>
                    <hr>
                    <div class="list-group">
                        <?php
                        $departement=$bdd->prepare("SELECT * FROM departement WHERE faculte=? ORDER by id DESC");
                        $departement->execute(array($sec['id']));
                        foreach($departement as $dep){ ?>
                            <a href="?pages=detail_departement&dep=<?= $dep['id'] ?>" class="list-group-item list-group-item-action">
                                <strong><?= $dep['titre'] ?></strong>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <!-- Annonces -->
                <div class="col-lg-6 col-12">
                    <h2 class="title text-primary">Annonces</h2>
                    <hr>
                    <div class="list-group">
                        <?php
                        $annonce=$bdd->prepare("SELECT * FROM annonce WHERE faculte=? ORDER by id DESC");
                        $annonce->execute(array($sec['id']));
                        foreach($annonce as $ann){ ?>
                            <div class="list-group-item">
                                <p class="m-0"><?= $ann['resumer'] ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php } ?>
<!--/ End Contact Us -->

