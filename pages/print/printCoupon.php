<?php
session_start();
require_once'../../php/main_functions.php';
require_once('../TCPDF-main/tcpdf.php');
$dat=DATE("Y-m-d");

$_SESSION['transact'] = 'PDORQNV101qf04EIrZG22Zem';
$_SESSION['annee'] = '2022';

if(!empty($_SESSION['transact']))
{
    $paiement=$bdd->prepare("SELECT * FROM paiement WHERE transact=? AND etat=1");
    $paiement->execute([$_SESSION['transact']]);
    if($paie=$paiement->fetch())
    {
        $verif1=$bdd->prepare("SELECT * FROM etudiant WHERE id=?");
        $verif1->execute([$paie['etudiant']]);
        if($et=$verif1->fetch())
        {
            $promo=$bdd->prepare("SELECT *  FROM promotion WHERE id=?");
            $promo->execute([$et['promotion']]);
            $prom=$promo->fetch();

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

    }
}



class PDF extends TCPDF{

    public  function Header(){
        $this->setFont('Times','',13);
        $this->Cell(0,0,'N° 1442/MI/2022',1,1,'R');
        $this->Ln(1);
        $this->Cell(80,5,'UNIVERSITE PEDAGOGIQUE NATIONALE',0,1,'');
        $this->Cell(80,5,'FACULTE SCIENCES',0,1,'');
        $this->Cell(80,5,'DEPARTEMENT MATH INFOS',0,1,'');
        $this->Cell(80,5,'KINSHASA/NGALIEMA',0,1,'');
        $imageFile= K_PATH_IMAGES.'upn.jpg';
        $this->Image($imageFile,15,38,30,'','JPG','','T',false,300,'',false,false,0,false,false,false);
    }
    public  function Footer(){
        $this->setFont('helvetica','I',7);
        $this->Cell(0,2,"03, Rue Olongi Quartier Mama-Yemo Kinshasa-Ngaliema",0,1,'C');
        $this->Cell(0,2,"CONTACTS/+243 82 177 6009 /+243 89 527 2225/+243 99 138 2620",0,1,'C');
        $this->Cell(0,2,"----------------------------------------------------------------------------------",0,1,'C');

    }
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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


$pdf->Ln(10);
$pdf->Ln();
$pdf->setFont('helvetica','',13);
$pdf->Cell(180,5,"                                     Année academique :         ".$annee,0,0,'',0);
$pdf->Ln();
$pdf->Cell(150,5,"                                     Promotion :                       ".$prom['titre'],0,0,'',0);
$pdf->Ln();
$pdf->Cell(150,5,"                                     Nom :                                ".$et['nom'],0,0,'',0);
$pdf->Ln();
$pdf->Cell(150,5,"                                     Postnom :                         ".$et['postnom'],0,0,'',0);
$pdf->Ln();
$pdf->Cell(150,5,"                                     Né(e) à :                           ".$et['dateNaiss'],0,0,'',0);
$pdf->Ln();

$pdf->setFont('Times','B',18);
$pdf->Ln(15);
$pdf->Cell(180,5,"PROFIL DE L'ETUDIANT",1,1,'C');
$pdf->Cell(180,5,"1ère SESSION",0,1,'C');
$pdf->Ln(5);
$pdf->setFillColor(224,235, 255);
$pdf->setFont('helvetica','B',13);
$pdf->Cell(10,5,"N°",1,0,'L',1);
$pdf->Cell(90,5,"INTITULE",1,0,'L',1);
$pdf->Cell(15,5,"POND",1,0,'L',1);
$pdf->Cell(10,5,"TP",1,0,'L',1);
$pdf->Cell(15,5,'INTE',1,0,'L',1);
$pdf->Cell(15,5,'EXAM',1,0,'L',1);
$pdf->Cell(20,5,'TOTAL',1,0,'L',1);


$i=1;
$vide=0;
$leger=0;
$grave=0;


$maxima=0;
$totalGeneral=0;
$courspromo=$bdd->prepare("SELECT * FROM courspromo WHERE promotion =? AND annee=? ORDER BY promotion");
$courspromo->execute([$et['promotion'], $_SESSION['annee']]);
while($csp=$courspromo->fetch())
{
    $max=20;
    $pond = $csp['ponderation'];
    $points = $pond * $max;
    $maxima = $maxima + $points;

    //calcul des cotes
    $cotation=$bdd->prepare("SELECT *  FROM delibe WHERE etudiant=? AND annee=? AND cours=?");
    $cotation->execute([$paie['etudiant'], $_SESSION['annee'], $csp['cours']]);
    if($cote=$cotation->fetch())
    {
        //intitule du cours
        $cours=$bdd->prepare("SELECT *  FROM cours WHERE id=?");
        $cours->execute([$cote['cours']]);
        if($cs=$cours->fetch())
        {
            $tp = round($cote['tp'],2);
            $interro = round($cote['interro'],2);
            $examen = round($cote['examen'],2);
            $total = $tp + $interro + $examen;

            $totalGeneral = $totalGeneral + ($total*$pond);

            if($total<8){$grave++;}
            if($total<10 && $total>7){$leger++;}
            if($total==0 && $total>7){$leger++;}

            $pdf->Ln();
            $pdf->setFont('helvetica','',11);
            $pdf->Cell(10,7,$i,1,0,'L',0);
            $pdf->Cell(90,7,$cs['titre'],1,0,'L',0);
            $pdf->Cell(15,7,$pond,1,0,'L',0);
            $pdf->Cell(10,7,$cote['tp'],1,0,'L',0);
            $pdf->Cell(15,7,$cote['interro'],1,0,'L',0);
            $pdf->Cell(15,7,$cote['examen'],1,0,'L',0);
            $pdf->Cell(20,7,$total,1,0,'L',0);
        }
        else
        {
            $pdf->Ln();
            $pdf->setFont('helvetica','',11);
            $pdf->Cell(10,7,$i,1,0,'L',0);
            $pdf->Cell(90,7,"",1,0,'L',0);
             $pdf->Cell(15,7,$pond,1,0,'L',0);
            $pdf->Cell(10,7,"",1,0,'L',0);
            $pdf->Cell(15,7,"",1,0,'L',0);
            $pdf->Cell(15,7,"",1,0,'L',0);
            $pdf->Cell(20,7,"",1,0,'L',0);
        }
    }
    else
    {
        $pdf->Ln();
        $pdf->setFont('helvetica','',11);
        $pdf->Cell(10,7,$i,1,0,'L',0);
        $pdf->Cell(90,7,"",1,0,'L',0);
        $pdf->Cell(15,7,$pond,1,0,'L',0);
        $pdf->Cell(10,7,"",1,0,'L',0);
        $pdf->Cell(15,7,"",1,0,'L',0);
        $pdf->Cell(15,7,"",1,0,'L',0);
        $pdf->Cell(20,7,"",1,0,'L',0);
    }

    $i++;

}


if($maxima > 0)
{
    $pourcentage = ($totalGeneral / $maxima)*100;
    $pourcentage = round($pourcentage,2);
}
else
{
    $pourcentage = 0;
}


$decision=$bdd->prepare("SELECT * FROM decision WHERE etudiant=? AND annee=?");
$decision->execute([$et['id'], $_SESSION['annee']]);   
if($decide=$decision->fetch())
{
    $dec = $decide['decision'];
}
else
{
    $dec = '';
}


$pdf->Ln(7);
$pdf->setFillColor(0,0, 0);
$pdf->setFont('helvetica','B',13);
$pdf->Cell(10,5,"N°",1,0,'L',1);
$pdf->Cell(90,5,"INTITULE",1,0,'L',1);
$pdf->Cell(15,5,"POND",1,0,'L',1);
$pdf->Cell(10,5,"TP",1,0,'L',1);
$pdf->Cell(15,5,'INTE',1,0,'L',1);
$pdf->Cell(15,5,'EXAM',1,0,'L',1);
$pdf->Cell(20,5,'TOTAL',1,0,'L',1);
$pdf->Ln(6);
$pdf->Cell(155,7,"MAXIMA GENERAL",1,0,'L',0);
$pdf->Cell(20,7,$maxima,1,0,'L',0);
$pdf->Ln(7);
$pdf->Cell(155,7,"TOTAL OBTENU",1,0,'L',0);
$pdf->Cell(20,7,$totalGeneral,1,0,'L',0);
$pdf->Ln(7);
$pdf->Cell(155,7,"POURCENTAGE",1,0,'L',0);
$pdf->Cell(20,7,$pourcentage."%",1,0,'L',0);
$pdf->Ln(7);
$pdf->Cell(155,7,"NOMBRE DE VIDES",1,0,'L',0);
$pdf->Cell(20,7,$vide,1,0,'L',0);
$pdf->Ln(7);
$pdf->Cell(155,7,"ECHECS LEGERS",1,0,'L',0);
$pdf->Cell(20,7,$leger,1,0,'L',0);
$pdf->Ln(7);
$pdf->Cell(155,7,"ECHECS GRAVES",1,0,'L',0);
$pdf->Cell(20,7,$grave,1,0,'L',0);
$pdf->Ln(7);
$pdf->Cell(155,7,"DECISION",1,0,'L',0);
$pdf->Cell(20,7,"",1,0,'L',0);
$pdf->Ln(7);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');