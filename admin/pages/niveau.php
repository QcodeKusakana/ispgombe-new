<?php
$niveau=$bdd->query("SELECT * FROM niveau");
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>NIVEAU D'ETUDE</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">niveau</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">NIVEAU</h5>

                        <!-- Default List group -->
                        <ul class="list-group">
                            <?php foreach($niveau as $s){ ?>
                                <li class="list-group-item"><a href="?pages=palmares&ss=<?= $_GET['ss'] ?>&dep=<?= $_GET['dep'] ?>&niv=<?= $s['id'] ?>"><?= $s['titre'] ?></a> </li>
                            <?php } ?>
                        </ul><!-- End Default List group -->

                    </div>
                </div>


            </div>

        </div>
    </section>

</main>















