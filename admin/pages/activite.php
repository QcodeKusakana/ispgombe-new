<main id="main" class="main">

    <div class="pagetitle">
        <h1>Publier un article</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?pages=home">Home</a></li>
                <li class="breadcrumb-item active">article</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <!-- Disabled Backdrop Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activity-create">
                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i> Nouvel article
            </button>
            <div class="modal fade" id="activity-create" tabindex="-1" aria-labelledby="activity-create-title" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activity-create-title">Nouvel article</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Multi Columns Form -->
                            <form role="form" class="col-md-12" method="post" enctype="multipart/form-data">
<input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">
                                <div class="mb-3">
                                    <label for="activity-title" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" id="activity-title" name="titre" maxlength="255" required class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="activity-photo" class="form-label">Photo <span class="text-danger">*</span></label>
                                    <input type="file" id="activity-photo" name="photo" accept="image/jpeg,image/png,image/webp" required class="form-control" />
                                    <div class="form-text">JPG, PNG ou WebP — 15 Mo maximum.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="activity-description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea id="activity-description" name="description" maxlength="20000" required class="form-control" rows="5" data-rich-text></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="activite" value="1">Enregistrer l’article</button>
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
                    <h5 class="card-title">Nos publications <span>| Article</span></h5>

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
                                                        <th>Delete</th>
                                                        <th>Editer</th>
                                                        <th>Publier</th>
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
                                                            <td class="center"><div class="d-flex flex-wrap gap-1 align-items-center"><span class="badge <?= (int) $activ['etat_modifier'] === 1 ? 'bg-success' : 'bg-secondary' ?>"><?= (int) $activ['etat_modifier'] === 1 ? 'Publié' : 'Brouillon' ?></span><form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $activ['id_act'] ?>"><button class="btn btn-sm btn-outline-danger" name="admin_action" value="delete"><i class="bi bi-trash me-1" aria-hidden="true"></i> Supprimer</button></form></div></td>
                                                            <td><a class="btn btn-primary" href="?pages=modif_article&amp;edit=<?= (int) $activ['id_act'] ?>"><i class="bi bi-pencil-square" aria-hidden="true"></i> Modifier</a></td>
                                                            <td class="center">
                                                                <?php
                                                                if($activ['etat_modifier']==0){
                                                                    ?>
                                                                    <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $activ['id_act'] ?>"><button class="btn btn-sm btn-success" name="admin_action" value="publish"><i class="bi bi-cloud-upload me-1" aria-hidden="true"></i> Publier</button></form>
                                                                <?php
                                                                }
                                                                if($activ['etat_modifier']==1){
                                                                    ?>
                                                                    <form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"><input type="hidden" name="record_id" value="<?= (int) $activ['id_act'] ?>"><button class="btn btn-sm btn-outline-secondary" name="admin_action" value="unpublish"><i class="bi bi-eye-slash me-1" aria-hidden="true"></i> Retirer</button></form>
                                                                <?php } ?>

                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                    <div class="pagination container" aria-label="Pagination des articles">
                                                        <a aria-label="Page précédente" class="linkPagination <?php if($current=='1'){ echo "disabled btn btn-danger"; }else{ echo "btn btn-success"; } ?>" href="?pages=activite&amp;pag=<?php if($current !='1'){ echo $current-1; }else{ echo $current; } ?>">&laquo;</a>
                                                        <?php
                                                        for($i=1;$i<=$nbPage;$i++){
                                                            if($i==$current){
                                                                ?>
                                                                <a style="color: #999999;" class="linkPagination1" aria-current="page" href="?pages=activite&amp;pag=<?= $i ?>"><?= $i ?></a>
                                                            <?php
                                                            }  else {
                                                                ?>
                                                                <a class="linkPagination1" href="?pages=activite&amp;pag=<?= $i ?>"><?= $i ?></a>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                        <a aria-label="Page suivante" class="linkPagination <?php if($current==$nbPage){ echo "disabled btn btn-danger"; }else{ echo "btn btn-success"; } ?>" href="?pages=activite&amp;pag=<?php if($current !=$nbPage){ echo $current+1; }else{ echo $current; } ?>">&raquo;</a>
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












