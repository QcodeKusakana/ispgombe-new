<main id="main" class="main">

    <div class="pagetitle">
        <h1>Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">service</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                Ajouter un service
            </button>
            <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="photo_ser" id="inputName5">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Description</label>
                                    <textarea class="form-control" name="desc_ser" id="" cols="5" rows="2"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Particularité</label>
                                    <textarea class="form-control" name="particularite" id="" cols="5" rows="2"></textarea>
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
                <div class="card-body pb-0">
                    <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

                    <div class="news">
                        <div class="post-item clearfix">
                            <?php if(isset($_GET['editphoto'])){ ?>
                                <form action="" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                    <label for="">Photo</label>
                                    <input type="file" value="<?= $edit_pub['photo_ser']?>" name="photo_ser" class="form-control" id=""/>
                                    <button type="submit" class="btn btn-danger col-4" name="btnphoto">UPDATE</button>
                                </form>
                            <?php }else{ ?>
                                <a href="?pages=a_service&editphoto=1&edits=<?= $infoSer['id_ser'] ?>" style="font-size: 20px"><i class="ri-edit-2-fill"></i> Editer</a>
                                <img src="./media/service/<?= $infoSer['photo_ser'] ?>" alt="" style="float: left;width: 330px; margin-right: 8px">
                           <?php } ?>
                            <p>
                                <?php if(isset($_GET['editdesc'])){ ?>
                                    <form action="" method="post" enctype="multipart/form-data" class="col-lg-4"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                        <h4><a href="#">NOS SERVICES</a></h4>
                                        <label for="">Description</label>
                                        <textarea name="desc_ser"  class="form-control" id="" cols="10" rows="5"><?= $edit_pub['desc_ser']?></textarea>
                                        <button type="submit" class="btn btn-danger col-4" name="btndesc">UPDATE</button>
                                    </form>
                                <?php }else{ ?>
                                    <h4><a href="#">NOS SERVICES</a></h4>
                                    <?= $infoSer['desc_ser'] ?>
                                    <a href="?pages=a_service&editdesc=1&edits=<?= $infoSer['id_ser'] ?>" style="font-size: 18px"><i class="ri-edit-2-fill"></i> Editer</a>
                                <?php } ?>

                            </p>
                            <p>
                                <?php if(isset($_GET['editpar'])){ ?>
                                    <form action="" method="post" enctype="multipart/form-data" class="col-lg-4"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                    <h4><a href="#">Notre Particularité</a></h4>
                                        <label for="">Particularité</label>
                                        <textarea name="particularite"  class="form-control" id="" cols="10" rows="5"><?= $edit_pub['particularite']?></textarea>
                                        <button type="submit" class="btn btn-danger col-4" name="btnpart">UPDATE</button>
                                    </form>
                                <?php }else{ ?>
                                    <h4><a href="#">Notre Particularité</a></h4>
                                    <?= $infoSer['particularite'] ?>
                                    <a href="?pages=a_service&editpar=1&edits=<?= $infoSer['id_ser'] ?>" style="font-size: 18px"><i class="ri-edit-2-fill"></i> Editer</a>
                                <?php } ?>


                            </p>
                        </div>


                    </div><!-- End sidebar recent posts-->

                </div>
                </div>
            </div>
        </section>

</main><!-- End #main -->