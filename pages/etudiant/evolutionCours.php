<div id="faq4" class="panel-collapse collapse" role="tabpanel"
     aria-labelledby="FaqTitle4">
    <div class="faq-body" style="background-color:#EEFAFF!important; ">
        <section class="events section" style="padding-top: 0px!important;padding-bottom: 0px!important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="coming-event">
                            <?php
                            $courspromo4 = $bdd->prepare("SELECT * FROM affectcours WHERE promotion =? ORDER BY promotion");
                            $courspromo4->execute([$et['promotion']]);
                            while ($csp4 = $courspromo4->fetch()) {
                                //AFFICHAGE DES COURS PAR GROUPE
                                $cours4 = $bdd->prepare("SELECT *  FROM cours WHERE id=?");
                                $cours4->execute([$csp4['cours']]);

                                $coursCount = $bdd->prepare("SELECT SUM(heure) as 'SOMME' FROM prestation WHERE cours =? ORDER BY cours");
                                $coursCount->execute([$csp4['cours']]);
                                $som=$coursCount->fetch();
                                foreach ($cours4 as $cs4) {
                                    ?>
                                    <!-- Single Event -->
                                    <div class="single-event">
                                        <div class="<?php if($cs4['fin']==1){ echo "event-date"; }else{echo "event-date bg-primary"; } ?> ">
                                            <p><?php if($cs4['fin']==1){ echo "<span>Términé</span>"; }else{ echo $som['SOMME'] ."h"; } ?><span style="border-top: 1px solid #fff"><?= $csp4['NombreHeure'] ?>h</span></p>
                                        </div>
                                        <div class="event-content">
                                            <h3 class="event-title "><a href=""><?= $cs4['titre'] ?></a></h3>


                                            <table border="1" class="table-bordered">
                                                <?php  //AFFICHAGE DES PERSONNELS OU PROF
                                                $profs2 = $bdd->prepare("SELECT *  FROM personnel WHERE id=?");
                                                $profs2->execute([$csp4['prof']]);
                                                foreach ($profs2 as $prf2) {
                                                    ?>

                                                    <tr class="badge-secondary">
                                                        <th colspan="6">PROFESSEUR
                                                            : <?= $prf2['prenom'] ?> <?= $prf2['nom'] ?></th>
                                                    </tr>
                                                <?php

                                                }
                                                ?>

                                                <tr>
                                                    <th>N°</th>
                                                    <th>DATE</th>
                                                    <th>MATIERES</th>
                                                    <th>Nbre D'HEURE</th>
                                                </tr>

                                                <?php
                                                $annee=date("Y");
                                                $cours4 = $bdd->prepare("SELECT *  FROM prestation WHERE cours=? AND  annee=?");
                                                $cours4->execute([$cs4['id'],$annee]);
                                                $i=1;
                                                //AFFICHAGE DES COURS
                                                while ($cs5 = $cours4->fetch()) {
                                                    ?>
                                                    <tr>

                                                        <td style="padding:8px ">Séance <?= $i++ ?></td>
                                                        <td style="padding:8px "><?= $cs5['dateDeSeance'] ?></td>
                                                        <td style="padding:8px "><?= $cs5['matiere'] ?></td>
                                                        <td style="padding:8px "><?= $cs5['heure'] ?> h</td>
                                                    </tr>
                                                <?php }  ?>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- End Single Event -->
                                <?php
                                }
                            }?>
                            <!-- End Single Event -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>