<?php
if (isset($_GET['dep']) AND !empty($_GET['dep']))
{

    $get_id=(int)($_GET['dep']);
    $depart=$bdd->prepare("SELECT * FROM departement WHERE id=? ORDER by id DESC LIMIT 1");
    $depart->execute(array($get_id));
}
?>

<!-- CSS pour effet zoom et modal -->
<style>
    .zoomable {
        width: 100px;
        height: 100px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
        cursor: pointer;
    }

    .zoomable:hover {
        transform: scale(1.2);
    }

    /* Styles du modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        max-width: 80%;
        max-height: 80%;
        border-radius: 10px;
    }

    .close {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 40px;
        color: white;
        cursor: pointer;
    }



    .gallery {
        gap: 20px;
    }

    .photo-item {
        position: relative;
        padding-bottom: 20px; /* Pour donner un peu d'espace pour la carte */
    }

    .card {
        position: relative;
        border-radius: 10px; /* Arrondi des coins de la carte */
        overflow: hidden; /* Cache tout ce qui dépasse des bords arrondis */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre douce pour donner un effet flottant */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animation au survol */
    }

    .card-img-top {
        transition: opacity 0.3s ease;
        object-fit: cover; /* Remplir l'espace sans déformer l'image */
    }

    .info {
        background-color: rgba(0, 0, 0, 0.6); /* Fond semi-transparent */
        opacity: 0; /* Cacher les informations par défaut */
        transition: opacity 0.3s ease; /* Effet de transition pour l'apparition */
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px;
    }

    .card:hover .info {
        opacity: 1; /* Afficher les informations au survol */
    }

    .card:hover .card-img-top {
        opacity: 0.3; /* Rendre l'image plus transparente au survol pour faire ressortir l'info */
    }

    .card:hover {
        transform: scale(1.05); /* Effet d'agrandissement au survol */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Ombre plus marquée au survol */
    }

    .text-white h3, .text-white p {
        margin: 0; /* Supprimer les marges pour un alignement plus propre */
    }

    .text-white p {
        font-size: 0.9rem; /* Taille de police plus petite pour les paragraphes */
    }
    .card {
        position: relative;
        border-radius: 10px; /* Arrondi des coins de la carte */
        overflow: hidden; /* Cache tout ce qui dépasse des bords arrondis */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre douce pour donner un effet flottant */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animation au survol */
    }

    .card-img-top {
        transition: opacity 0.3s ease;
        object-fit: cover; /* Remplir l'espace sans déformer l'image */
    }

    .info {
        background-color: #ced4da; /* Fond semi-transparent */
        opacity: 0; /* Cacher les informations par défaut */
        transition: opacity 0.3s ease; /* Effet de transition pour l'apparition */
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px;
    }

    .card:hover .info {
        opacity: 1; /* Afficher les informations au survol */
    }

    .card:hover .card-img-top {
        opacity: 0.3; /* Rendre l'image plus transparente au survol pour faire ressortir l'info */
    }

    .card:hover {
        transform: scale(1.05); /* Effet d'agrandissement au survol */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Ombre plus marquée au survol */
    }

    .text-white h3, .text-white p {
        margin: 0; /* Supprimer les marges pour un alignement plus propre */
    }

    .text-white p {
        font-size: 0.9rem; /* Taille de police plus petite pour les paragraphes */
    }
    .card-img-top {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        margin: 10px auto;
    }
    .swiper-container {
        width: 90%;
        padding: 10px 0;
    }
    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0px;
    }
    .card {
        width: 90%; /* Largeur ajustable */
        padding: 10px;
        text-align: center;
        transition: transform 0.3s ease-in-out;
        margin: auto;
    }
    .card .card1{
        width: 100%; /* Largeur ajustable */
        max-width: 300px; /* Limite pour les grands écrans */
        margin: auto;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .swiper-button-prev1, .swiper-button-next1 {
        color: #007bff; /* Couleur des flèches */
    }
    .swiper-pagination-bullet {
        background: #007bff; /* Couleur des petits points */
    }
    .list-group {
        font-size: 12px;
        padding: 0; /* Supprime le padding du UL */
        margin: 0;  /* Supprime le margin du UL */
    }

    .list-group-item {
        padding: 4px 8px; /* Réduit le padding de chaque LI */
        margin: 0; /* Supprime l’espace entre les LI */
        line-height: 1.2; /* Diminue l'espacement vertical du texte */
    }

</style>

<?php foreach($depart as $d){
    $personnels=$bdd->prepare("SELECT * FROM personnel WHERE departement=? ORDER by id DESC");
    $personnels->execute(array($d['id']));
    ?>
    <section id="contact" class="contact section" style="background: #F4F4F4; padding: 50px 0;">
        <div class="container">
            <div class="row">
                <!-- Colonne des enseignants -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card shadow-sm border-0 p-3">
                        <h4 class="text-center text-primary">Equipe dirigeante</h4>
                        <hr>
                        <div class="row">
                            <?php foreach($personnels as $p){ ?>
                                <div class="col-lg-12 col-md-6 col-12 mb-3">
                                    <div class="card border-0 shadow text-center">
                                        <div class="image-container">
                                            <img src="../admin/media/membre/<?=$p['photo'] ?>"
                                                 class="rounded-circle img-thumbnail zoomable"
                                                 alt="Photo Enseignant"
                                                 onclick="openModal('../admin/media/membre/<?=$p['photo'] ?>')">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $p['noms'] ?></h5>
                                            <p class="card-text"><strong><?= $p['fonction'] ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Modal d'aperçu de l'image -->
                <div id="imageModal" class="modal">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <img class="modal-content" id="modalImage">
                </div>


                <!-- Colonne du carousel et description -->
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="card shadow-sm border-0 p-3">
                        <h5 class="text-primary">DEPARTEMENT : <?= htmlspecialchars($d['titre']) ?></h5>
                        <hr>
                        <div id="carouselExampleControls" class="carousel slide carousel-fade mb-4" data-bs-ride="carousel">
                            <div class="carousel-inner" style="border-radius: 10px; overflow: hidden;">
                                <?php
                                $reqCouv = $bdd->prepare("SELECT * FROM couverture WHERE departement=?");
                                $reqCouv->execute([$_GET['dep']]);
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
                            <p><?= nl2br(htmlspecialchars($d['resume'])) ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Options et Annonces -->
    <!-- Section Départements et Annonces -->
    <section class="events section bg-white py-4">
        <div class="container">
            <div class="row">
                <!-- Départements -->
                <div class="col-lg-6 col-12">
                    <h2 class="title text-primary">Filière organisée</h2>
                    <hr/>
                    <div class="list-group">
                        <?php
                        $departement=$bdd->prepare("SELECT * FROM optioner WHERE departement=? ORDER by id DESC");
                        $departement->execute(array($d['id']));
                        foreach($departement as $dep){
                            ?>
                            <div class="list-group-item list-group-item-action d-flex align-items-center">
                                <span class="badge bg-primary rounded-pill me-3">ISP</span>
                                <h5 class="mb-0"><?= $dep['titre'] ?></h5>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Annonces -->
                <div class="col-lg-6 col-12">
                    <h2 class="title text-primary">Annonce</h2>
                    <hr/>
                    <div class="list-group">
                        <?php
                        $annonce=$bdd->prepare("SELECT * FROM annonce WHERE departement=? ORDER by id DESC");
                        $annonce->execute(array($d['id']));
                        foreach($annonce as $ann){
                            ?>
                            <p class="list-group-item bg-light border-0 text-justify p-3">
                                <?= $ann['resumer'] ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4" style="overflow: hidden;">
        <div class="swiper-container">
            <h3 class="text-primary text-center mb-4">MEMBRES DU DÉPARTEMENT</h3>
            <hr/>
            <div class="swiper-wrapper">
                <?php
                $reqMembres=$bdd->prepare("SELECT * FROM agent_dep WHERE departement = ? ORDER BY id DESC");
                $reqMembres->execute([$get_id]);

                ?>
                <?php while($mb=$reqMembres->fetch()){ ?>
                <div class="swiper-slide">
                    <div class="card card1">
                        <img src="../admin/media/membre/<?=$mb['photo'] ?>" class="card-img-top" alt="<?=$mb['noms'] ?>" onclick="openModal('../admin/media/membre/<?=$mb['photo'] ?>')">
                        <ul class="list-group" style="font-size: 15px; padding: 0; margin: 0;">
                            <li class="list-group-item" style="padding: 4px 8px; margin: 0; line-height: 1.2;">
                                <strong></strong> <?=$mb['noms'] ?>
                            </li>
                             <li class="list-group-item" style="padding: 4px 8px; margin: 0; line-height: 1.2;">
                                <strong>Grade:</strong> <?=$mb['grade'] ?>
                            </li>
                            <li class="list-group-item" style="padding: 4px 8px; margin: 0; line-height: 1.2;">
                                <strong>Domaine:</strong> <?=$mb['domaine'] ?>
                            </li>
                           
                            <li class="list-group-item" style="padding: 4px 8px; margin: 0; line-height: 1.2;">
                                <strong></strong> <?=$mb['mail'] ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>

            <!-- Pagination et boutons de navigation -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev1"></div>
            <div class="swiper-button-next1"></div>
        </div>
    </div>


<?php } ?>
<!--/ End Contact Us -->

<!-- Script JavaScript pour gérer le modal -->
<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').style.display = "flex";
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = "none";
    }
</script>


