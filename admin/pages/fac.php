<?php
$faculte=$bdd->query("SELECT * FROM faculte");
?>
<main id="main" class="main">

<div class="pagetitle">
    <h1>AJOUTER PALMARES</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">List Group</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-6">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">FACULTES</h5>

            <!-- Default List group -->
            <ul class="list-group">
                <?php foreach($faculte as $fa){ ?>
                    <li class="list-group-item"><a href="?pages=fac&id=<?= $fa['id'] ?>"><?= $fa['titre'] ?></a> </li>
                <?php } ?>
            </ul><!-- End Default List group -->

        </div>
    </div>


</div>

<div class="col-lg-6">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">DEPARTEMENTS</h5>

            <!-- List group with active and disabled items -->
            <ul class="list-group">
                <?php if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $depp=$bdd->prepare("SELECT * FROM departement WHERE faculte=?");
                    $depp->execute(array($id));

                    foreach($depp as $dep){
                        ?>
                        <li class="list-group-item"><a href="?pages=sess&dep=<?= $dep['id'] ?>"><?= $dep['titre'] ?></a> </li>
                    <?php }
                } ?>
            </ul><!-- End ist group with active and disabled items -->

        </div>
    </div>



</div>

</div>
</section>

</main>















