<?php
$session=$bdd->query("SELECT * FROM sessions");
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>SESSIONS</h1>
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
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SESSEIONS</h5>

                        <!-- Default List group -->
                        <ul class="list-group">
                            <?php foreach($session as $s){ ?>
                                <li class="list-group-item"><a href="?pages=niveau&ss=<?= $s['id'] ?>&dep=<?= $_GET['dep'] ?>"><?= $s['nom_s'] ?></a> </li>
                            <?php } ?>
                        </ul><!-- End Default List group -->

                    </div>
                </div>


            </div>

        </div>
    </section>

</main>















