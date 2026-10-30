<?php
function load_faculte()
{
    global $bdd;
    $req = $bdd->query("SELECT * FROM faculte ORDER BY titre ASC ");
    $results= array();

    while($rows= $req->fetchObject()){
        $results[]=$rows;
    }
    echo "<option value=''>--Faculté 1er Choix *--</option>";
    foreach($results as $result){?>
        <option value="<?= $result->id ?>"><?= $result->titre ?></option>
    <?php }
    return $results;
}
function load_faculte2()
{
    global $bdd;
    $req = $bdd->query("SELECT * FROM faculte ORDER BY titre ASC ");
    $results= array();

    while($rows= $req->fetchObject()){
        $results[]=$rows;
    }
    echo "<option value=''>--Faculter 2em Choix *--</option>";
    foreach($results as $result){?>
        <option value="<?= $result->id ?>"><?= $result->titre ?></option>
    <?php }
    return $results;
}
function load_province()
{
    global $bdd;
    $req = $bdd->query("SELECT * FROM provinces ORDER BY nom_p ASC ");
    $results= array();

    while($rows= $req->fetchObject()){
        $results[]=$rows;
    }
    echo "<option value=''>Selectionner votre Province d'Origine *</option>";
    foreach($results as $result){?>
        <option value="<?= $result->id_p ?>"><?= $result->nom_p ?></option>
    <?php }
    return $results;
}
function filtrer_Telephone ($telephone)
{
    $debut = substr($telephone, 0, 1);
    $debut2 = substr($telephone,0,2);
    $nb = strlen($telephone);

    if( $debut == '0')
    {
        if($debut2 == '00')
        {
            $prefix='';
            $sufixe=substr($telephone,2,$nb);
            $tel=$prefix.$sufixe;
        }
        else
        {
            $prefix='243';
            $sufixe=substr($telephone,1,$nb);
            $tel=$prefix.$sufixe;
        }
    }
    elseif($debut == "+")
    {
        $prefix='';
        $sufixe=substr($telephone,1,$nb);
        $tel=$prefix.$sufixe;
    }
    elseif($nb < 10)
    {
        $prefix='243';
        $sufixe=$telephone;
        $tel=$prefix.$sufixe;
    }
    elseif($nb < 9)
    {
        $prefix='';
        $sufixe='';
        $tel=$prefix.$sufixe;
    }
    else
    {
        $prefix='';
        $sufixe=$telephone;
        $tel=$prefix.$sufixe;
    }

    return $tel;
}

function insert_Etudiants(
    $matricule,
    $nom,
    $postnom,
    $prenom,
    $lieuNaiss,
    $dateNaiss,
    $sexe,
    $etatCivil,
    $nationalite,
    $telephone,
    $photo,
    $nomDuPere,
    $nomDeLaMere,
    $province,
    $district,
    $territoire,
    $adresseDuCandidat,
    $personnePrevenir,
    $telephonePersonnePrevenir,
    $nomDeEcoleDeFreq,
    $adresseDeEcoleProvince,
    $sectionSuiviAuxHum,
    $nomDuCentreDeExetat,
    $anneeObtentionDuDiplome,
    $pourcentageDuDiplome,
    $numeroDuDiplomeEtat,
    $activiteProfessionelles,
    $etudesPostSecondaireEntreprise,
    $promotion,
    $facChoix1,
    $depChoix1,
    $facChoix2,
    $depChoix2,
    $cycle,
    $diplomeAttest,
    $certificat,
    $bulletin,
    $carteIdentite,
    $attestNaissance,
    $mdp,
    $defaut,
    $date_inscrit,
    $qrcode,
    $types
) {
    global $bdd;
    $r = array(
        'matricule' => $matricule,
        'nom' => $nom,
        'postnom' => $postnom,
        'prenom' => $prenom,
        'lieuNaiss' => $lieuNaiss,
        'dateNaiss' => $dateNaiss,
        'sexe' => $sexe,
        'etatCivil' => $etatCivil,
        'nationalite' => $nationalite,
        'telephone' => $telephone,
        'photo' => $photo,
        'nomDuPere' => $nomDuPere,
        'nomDeLaMere' => $nomDeLaMere,
        'province' => $province,
        'district' => $district,
        'territoire' => $territoire,
        'adresseDuCandidat' => $adresseDuCandidat,
        'personnePrevenir' => $personnePrevenir,
        'telephonePersonnePrevenir' => $telephonePersonnePrevenir,
        'nomDeEcoleDeFreq' => $nomDeEcoleDeFreq,
        'adresseDeEcoleProvince' => $adresseDeEcoleProvince,
        'sectionSuiviAuxHum' => $sectionSuiviAuxHum,
        'nomDuCentreDeExetat' => $nomDuCentreDeExetat,
        'anneeObtentionDuDiplome' => $anneeObtentionDuDiplome,
        'pourcentageDuDiplome' => $pourcentageDuDiplome,
        'numeroDuDiplomeEtat' => $numeroDuDiplomeEtat,
        'activiteProfessionelles' => $activiteProfessionelles,
        'etudesPostSecondaireEntreprise' => $etudesPostSecondaireEntreprise,
        'promotion' => $promotion,
        'facChoix1' => $facChoix1,
        'depChoix1' => $depChoix1,
        'facChoix2' => $facChoix2,
        'depChoix2' => $depChoix2,
        'cycle' => $cycle,
        'diplomeAttest' => $diplomeAttest,
        'certificat' => $certificat,
        'bulletin' => $bulletin,
        'carteIdentite' => $carteIdentite,
        'attestNaissance' => $attestNaissance,
        'mdp' => $mdp,
        'defaut' => $defaut,
        'date_inscrit' => $date_inscrit,
        'qrcode' => $qrcode,
        'type' => $types
    );
    $sql = "INSERT INTO etudiant(matricule,nom,postnom,prenom,lieuNaiss,dateNaiss,sexe,etatCivil,nationalite,telephone,photo,nomDuPere,nomDeLaMere,province,district,territoire,adresseDuCandidat,personnePrevenir,telephonePersonnePrevenir,nomDeEcoleDeFreq,adresseDeEcoleProvince,sectionSuiviAuxHum,nomDuCentreDeExetat,anneeObtentionDuDiplome,pourcentageDuDiplome,numeroDuDiplomeEtat,activiteProfessionelles,etudesPostSecondaireEntreprise,
    promotion,
    facChoix1,
    depChoix1,
    facChoix2,
    depChoix2,
    cycle,
    diplomeAttest,
    certificat,
    bulletin,
    carteIdentite,
    attestNaissance,
    mdp,
    defaut,
    date_inscrit,
    qrcode,
    type) VALUES(
    :matricule,
    :nom,
    :postnom,
    :prenom,
    :lieuNaiss,
    :dateNaiss,
    :sexe,
    :etatCivil,
    :nationalite,
    :telephone,
    :photo,
    :nomDuPere,
    :nomDeLaMere,
    :province,
    :district,
    :territoire,
    :adresseDuCandidat,
    :personnePrevenir,
    :telephonePersonnePrevenir,
    :nomDeEcoleDeFreq,
    :adresseDeEcoleProvince,
    :sectionSuiviAuxHum,
    :nomDuCentreDeExetat,
    :anneeObtentionDuDiplome,
    :pourcentageDuDiplome,
    :numeroDuDiplomeEtat,
    :activiteProfessionelles,
    :etudesPostSecondaireEntreprise,
    :promotion,
    :facChoix1,
    :depChoix1,
    :facChoix2,
    :depChoix2,
    :cycle,
    :diplomeAttest,
    :certificat,
    :bulletin,
    :carteIdentite,
    :attestNaissance,
    :mdp,
    :defaut,
    :date_inscrit,
    :qrcode,
    :type
    )";
    $req = $bdd->prepare($sql);
    $req->execute($r);
}