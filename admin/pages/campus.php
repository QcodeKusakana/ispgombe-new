<main id="main" class="main">

    <div class="pagetitle">
        <h1>Informations du campus</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">Campus</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#campus-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Ajouter une information
            </button>
            <div class="modal fade" id="campus-create" tabindex="-1" aria-labelledby="campus-create-title" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="campus-create-title">Nouvelle information campus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form role="form" class="col-md-12" method="post" enctype="multipart/form-data">
<input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="mb-3">
                                    <label for="campus-title" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" id="campus-title" name="titre" maxlength="255" required class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="campus-photo" class="form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" id="campus-photo" name="photo" accept="image/jpeg,image/png,image/webp" required class="form-control" />
                                    <div class="form-text">JPG, PNG ou WebP — 15 Mo maximum.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="campus-description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea id="campus-description" name="description" maxlength="20000" required class="form-control" rows="5" data-rich-text></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="campus" value="1">Enregistrer l’information</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1" aria-hidden="true"></i> Fermer</button>
                        </div>
                    </div>
                </div><!-- End Disabled Backdrop Modal-->

            </div>
        </div>
        <section class="section">
            <div class="container">
                <?php if(isset($erreurs)){ echo '<b style="color:lime">'.$erreurs.'</b>';} ?>
                <?php if(isset($erreur)){ echo '<b style="color:red">'.$erreur.'</b>';} ?>
            </div>
            <div class="row">
                <div class="card-body pb-0">
                    <h5 class="card-title">Information <span>| Campus</span></h5>

                    <div class="news">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Advanced Tables -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th>Titre</th>
                                                        <th>Date Pub(s)</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php while($activ=$les_activite->fetch()){
                                                        //$categ=$bdd->prepare("select * from categorie WHERE id_cat=?");
                                                        //$categ->execute(array($activ['categorie']));
                                                        //$infoCat=$categ->fetch();
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?= htmlspecialchars(mb_strimwidth((string) $activ['titre'], 0, 70, '…', 'UTF-8'), ENT_QUOTES, 'UTF-8') ?></td>
                                                            <td>
                                                                <?= htmlspecialchars(date('d/m/Y à H:i', strtotime((string) $activ['date_pub']) ?: 0), ENT_QUOTES, 'UTF-8') ?>
                                                            </td>
                                                            <td>
                                                                <details class="mb-2"><summary class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square me-1" aria-hidden="true"></i> Modifier</summary><form method="post" enctype="multipart/form-data" class="row g-2 mt-2"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="campus_id" value="<?= (int) $activ['id_act'] ?>"><div class="col-12"><label class="form-label" for="campus-title-<?= (int) $activ['id_act'] ?>">Titre</label><input class="form-control" id="campus-title-<?= (int) $activ['id_act'] ?>" name="titre" maxlength="255" required value="<?= htmlspecialchars((string) $activ['titre'], ENT_QUOTES, 'UTF-8') ?>"></div><div class="col-12"><label class="form-label" for="campus-description-<?= (int) $activ['id_act'] ?>">Description</label><textarea class="form-control" id="campus-description-<?= (int) $activ['id_act'] ?>" name="description" maxlength="20000" rows="4" required data-rich-text><?= htmlspecialchars((string) $activ['description'], ENT_QUOTES, 'UTF-8') ?></textarea></div><div class="col-12"><label class="form-label" for="campus-photo-<?= (int) $activ['id_act'] ?>">Remplacer la photo (facultatif)</label><input class="form-control" id="campus-photo-<?= (int) $activ['id_act'] ?>" type="file" name="photo" accept="image/jpeg,image/png,image/webp"></div><div class="col-12"><button class="btn btn-primary btn-sm" type="submit" name="update_campus" value="1"><i class="bi bi-check2 me-1" aria-hidden="true"></i> Enregistrer</button></div></form></details>
                                                                <div class="d-flex flex-wrap gap-1">
                                                                    <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $activ['id_act'] ?>"><button class="btn btn-sm <?= (int) $activ['etat_modifier'] === 1 ? 'btn-outline-secondary' : 'btn-outline-success' ?>" name="admin_action" value="<?= (int) $activ['etat_modifier'] === 1 ? 'unpublish' : 'publish' ?>"><?= (int) $activ['etat_modifier'] === 1 ? 'Retirer du site' : 'Publier' ?></button></form>
                                                                    <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $activ['id_act'] ?>"><button class="btn btn-sm btn-outline-danger" name="admin_action" value="delete"><i class="bi bi-trash me-1" aria-hidden="true"></i> Supprimer</button></form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                    <div class="pagination container" aria-label="Pagination campus">
                                                        <a aria-label="Page précédente" class="linkPagination <?php if($current=='1'){ echo "disabled btn btn-danger"; }else{ echo "btn btn-success"; } ?>" href="?pages=campus&amp;pag=<?php if($current !='1'){ echo $current-1; }else{ echo $current; } ?>">&laquo;</a>
                                                        <?php
                                                        for($i=1;$i<=$nbPage;$i++){
                                                            if($i==$current){
                                                                ?>
                                                                <a style="color: #999999;" class="linkPagination1" aria-current="page" href="?pages=campus&amp;pag=<?= $i ?>"><?= $i ?></a>
                                                            <?php
                                                            }  else {
                                                                ?>
                                                                <a class="linkPagination1" href="?pages=campus&amp;pag=<?= $i ?>"><?= $i ?></a>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                        <a aria-label="Page suivante" class="linkPagination <?php if($current==$nbPage){ echo "disabled btn btn-danger"; }else{ echo "btn btn-success"; } ?>" href="?pages=campus&amp;pag=<?php if($current !=$nbPage){ echo $current+1; }else{ echo $current; } ?>">&raquo;</a>
                                                    </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--End Advanced Tables -->
                                </div>
                            </div>
                        </div>


                    </div><!-- End sidebar recent posts-->

                </div>
            </div>
        </section>

</main><!-- End #main -->












