<div id="faq1" class="panel-collapse collapse" role="tabpanel"
     aria-labelledby="FaqTitle1" >
    <div class="faq-body" style="background-color:#EEFAFF!important; ">
        <ol>
            <?php
            $annee=date("Y");
            $courspromo = $bdd->prepare("SELECT * FROM affectcours WHERE promotion =? AND annee=? ORDER BY promotion");
            $courspromo->execute([$et['promotion'],$annee]);
            while ($csp = $courspromo->fetch()) {
                $profs = $bdd->prepare("SELECT *  FROM personnel WHERE id=?");
                $profs->execute([$csp['prof']]);
                if ($prf = $profs->fetch()) {
                    $cours = $bdd->prepare("SELECT *  FROM cours WHERE id=?");
                    $cours->execute([$csp['cours']]);
                    $a=1;
                    if ($cs = $cours->fetch()) {
                        ?>
                        <li style="margin-left: 20px;font-weight: bold"> <div class="" ><?= $cs['titre'] ?> || <span style="color: red"> <?= $prf['prenom'] ?> <?= $prf['nom'] ?></span></div></li>
                    <?php
                    }
                }
            }

            ?>
        </ol>
    </div>
</div>












