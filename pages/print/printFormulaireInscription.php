<?php
require_once'../../php/main_function.php';
require_once('../TCPDF-main/tcpdf.php');
$dat=DATE("Y-m-d");
//$_SESSION['transact'] = 'PDurSFM10mxk14i22j722j3w';
$_SESSION['annee'] = '2022';

if(!empty($_SESSION['id']))
{
    $paiement=$bdd->prepare("SELECT * FROM etudiant WHERE id=?");
    $paiement->execute([$_SESSION['id']]);
    if($paie=$paiement->fetch())
    {
        $verif1=$bdd->prepare("SELECT * FROM etudiant WHERE id=?");
        $verif1->execute([$_SESSION['id']]);
        if($et=$verif1->fetch())
        {
            $promo=$bdd->prepare("SELECT *  FROM promotion WHERE id=?");
            $promo->execute([$et['promotion']]);
            $prom=$promo->fetch();

            $prov=$bdd->prepare("SELECT *  FROM provinces WHERE id_p=?");
            $prov->execute([$et['province']]);
            $pro=$prov->fetch();

            $territ=$bdd->prepare("SELECT *  FROM territoires WHERE id_tr=?");
            $territ->execute([$et['territoire']]);
            $terr=$territ->fetch();

            $district=$bdd->prepare("SELECT *  FROM secteurs WHERE id_sec=?");
            $district->execute([$et['district']]);
            $distric=$district->fetch();

            $optioner=$bdd->prepare("SELECT *  FROM optioner WHERE id=?");
            $optioner->execute([$prom['optioner']]);
            $opt=$optioner->fetch();

            $departement=$bdd->prepare("SELECT *  FROM departement WHERE id=?");
            $departement->execute([$opt['departement']]);
            $dep=$departement->fetch();

            $faculte=$bdd->prepare("SELECT *  FROM faculte WHERE id=?");
            $faculte->execute([$dep['faculte']]);
            $fac=$faculte->fetch();

            $nouveau = $_SESSION['annee'];
            $ancien = $nouveau-1;
            $annee = $ancien.'-'.$nouveau;




        }
    }
    else
    {
        echo "echec du paiement";
    }
}

/*$etudiantform=$bdd->query("SELECT *,
                                        etudiant.id as 'IdEtu',
                                        faculte.id as 'IdFac',
                                        faculte.titre as 'TitreFac',
                                        departement.id as 'IdDep',
                                        departement.titre as 'TitreDep',
                                        promotion.id as 'IdPro',
                                        promotion.titre as 'TitrePro',
                                        optioner.id as 'IdOp',
                                        optioner.titre as 'TitreOp',
                                        cours.titre as 'TitreCour'
                      FROM faculte
                      INNER JOIN departement ON faculte.id=departement.faculte
                      INNER JOIN optioner ON departement.id=optioner.departement
                      INNER JOIN promotion ON optioner.id=promotion.optioner
                      INNER JOIN etudiant ON promotion.id=etudiant.promotion
                      INNER JOIN affectcours ON promotion.id=affectcours.promotion
                      INNER JOIN cours ON cours.id=affectcours.cours
                      INNER JOIN provinces ON etudiant.province=provinces.id_p
                      INNER JOIN territoires ON provinces.id_p=territoires.id_p
                      INNER JOIN secteurs ON secteurs.id_tr=territoires.id_tr
                      WHERE etudiant.id='".$_GET['ID']."'");
$info=$etudiantform->fetch();*/
class PDF extends TCPDF{
    public  function Header(){
        $imageFile= K_PATH_IMAGES.'GOMBE.jpg';
        $this->Image($imageFile,6,2,18,'','JPG','','I',false,300,'',false,false,0,false,false,false);
        $this->Ln(1);
        $this->setFont('Times','B',16);
        $this->Cell(179,5,'République Democratique du Congo',0,1,'C');
        $this->setFont('Times','B',14);
        $this->Cell(179,5,"Ministère de l'Enseigneiment Universitaire et Recherche Scientifique",0,1,'C');
        $this->setFont('Times','B',16);
        $this->Cell(179,5,'L’INSTITUT SUPERIEUR PEDAGOGIQUE DE LA GOMBE ISP/G',0,1,'C');
        $this->setFont('Times','B',18);
        $this->Cell(180,0,'KINSHASA/GOMBE',0,1,'C');
        $this->setFont('Times','B',18);
        $this->Cell(180,0,'_________________________________________________',0,1,'C');
        $this->Ln(2);
        $this->setFont('Times','B',18);
        $this->Cell(180,7,'ANNEE ACADEMIQUE 2023-2024',0,1,'C');
    }
    public  function Footer(){


    }
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Qcode+');
$pdf->SetTitle('FICHE D\'INSCRIPTION '.$et['matricule']);
$pdf->SetSubject('Qcode');
$pdf->SetKeywords('Qcode+, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
//Creation d'un tableau des données
//$imageFile= "../../imgQrCod/".$et['qrcode'];
//$pdf->Image($imageFile,186,2,18,'','PNG','','I',false,300,'',false,false,0,false,false,false);
$pdf->Ln(30);

$pdf->setFont('Times','B',12);
$pdf->Cell(180,5,"FORMULAIRE D'INSCRIPTION A L'ENSEIGNEMENT SUPERIEUR ET UNIVERSITAIRE",1,1,'C');
$pdf->Ln(10);
$pdf->setFont('helvetica','B',13);
$pdf->Cell(50,5,"CYCLE : ".$et['cycle'],0,0,'L',0);
$pdf->Cell(50,5,"PROM : ",0,0,'L',0);
$pdf->Cell(50,5,"N° D'ORDRE : ".$et['id'],0,0,'L',0);
$pdf->Ln();
$pdf->Ln(3);
$pdf->setFont('helvetica','B',13);
$pdf->Cell(50,5,"I. INDENTITE ",0,0,'L',0);
$pdf->Ln();
$pdf->Ln(3);
$pdf->setFont('helvetica','',11);
$pdf->Cell(80,5,"1. Nom                   : ".$et['nom'],0,0,'L',0);
$pdf->Cell(80,5,"Nom du père               : ".$et['nomDuPere'],0,0,'L',0);
$pdf->Ln();
$pdf->Cell(80,5,"2. Post nom            : ".$et['postnom'],0,0,'L',0);
$pdf->Cell(80,5,"Nom de la mère          : ".$et['nomDeLaMere'],0,0,'L',0);
$pdf->Ln();
$pdf->Cell(80,5,"3. Prénom            : ".$et['prenom'],0,0,'L',0);
$pdf->Cell(80,5,"Province d'Orig            : ".$pro['nom_p'],0,0,'L',0);
$pdf->Ln();
$pdf->Cell(80,5,"3. Lieu de Naiss     : ".$et['lieuNaiss'],0,0,'L',0);
$pdf->Cell(80,5,"District                          : ".$distric['nom_sec'],0,0,'L',0);
$pdf->Ln();
$pdf->Cell(80,5,"3. Date de Naiss     : ".$et['dateNaiss'],0,0,'L',0);
$pdf->Cell(80,5,"Territoire                      : ".$terr['nom_tr'],0,0,'L',0);


$html='
';
$pdf->writeHTML($html,true,false,true,false,'');
$html="";
$pdf->writeHTML($html,true,false,true,false,'');


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');