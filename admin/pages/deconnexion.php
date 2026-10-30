<?php
session_start();
$_SESSION=array();
session_destroy();
@header("Location:?pages=login");
?>
<main id="main" class="main">

    <section class="section text-center">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="" class="btn btn-danger col-lg-12">Deconnexion</a></h5>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->













