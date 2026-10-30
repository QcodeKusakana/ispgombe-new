<?php
$nbrdocument=$bdd->query('SELECT * FROM activite');
$nbrFichier=$nbrdocument->rowCount();
$mode_edition=0;
//code de modification des articles
if (isset($_GET['edit'],$_GET['edit'])){
    $mode_edition=1;
    $edit_id=(int)($_GET['edit']);

    $edit_pub=$bdd->prepare("SELECT * FROM activite WHERE id_act=?");
    $edit_pub->execute(array($edit_id));

    if ($edit_pub->rowCount()==1){

        $edit_pub=$edit_pub->fetch();

    }else{
        echo '<script>alert("Erreur : la activite concerné n\'existe pas...")</script>';
    }
}
if(isset($_POST['modifier'])){
//code d'insertion des articles
    $titre=trim((string) ($_POST['titre'] ?? ''));
    $description=admin_sanitize_rich_text(trim((string) ($_POST['description'] ?? '')));
    //$categorie=htmlspecialchars(trim($_POST['categorie']));

    if($mode_edition==1){
        $update_cat=$bdd->prepare('UPDATE activite SET titre=?,description=? WHERE id_act=?');
        $update_cat->execute(array($titre,$description,$edit_id));
        echo '<script>alert("Votre article a été modifier avec succès!")</script>';

    }
}
?>
<?php //$id_categ=$bdd->query('SELECT * FROM categorie WHERE nom_cat  ORDER BY nom_cat'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Modification de l'article</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">Modifier</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">


                <form role="form" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                    <div class="col-lg-8">
                        <legend>MODIFIER ARTICLE</legend>
                        <?php if(isset($sms)){ echo '<b style="color:lime">'.$sms.'</b>';} ?>
                        <?php if(isset($erreur)){ echo '<b style="color:red">'.$erreur.'</b>';} ?>
                        <div class="form-group">
                            <label>Titre *</label>
                            <input type="text" name="titre" value="<?= htmlspecialchars((string) $edit_pub['titre'], ENT_QUOTES, 'UTF-8') ?>" class="form-control col-md-12" />
                        </div>

                        <div class="form-group">
                            <label>Description *</label>
                            <textarea name="description" placeholder="la description" class="form-control" rows="10" data-rich-text><?= htmlspecialchars((string) $edit_pub['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-danger" name="modifier">Modifier maintennant</button>
                        <a class="btn btn-dark" href='?pages=activite'><i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Retour</a>
                    </div>

                </form>

            </div>
        </div>
    </section>

</main><!-- End #main -->







<script src="uploadFile.js"> </script>
