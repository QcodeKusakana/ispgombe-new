<?php
require_once'../../functions/main_function.php';
require_once('../TCPDF-main/tcpdf.php');
$dat=DATE("Y-m-d");
$tarificats=$bdd->query("SELECT * FROM adhesion
  INNER JOIN provinces ON adhesion.province=provinces.id_p
  INNER JOIN territoires ON adhesion.territoire=territoires.id_tr
  INNER JOIN secteurs ON adhesion.secteur=secteurs.id_sec WHERE adhesion.province='".$_GET['IdProv']."'");
$provin=$bdd->query("SELECT * FROM  provinces WHERE provinces.id_p='".$_GET['IdProv']."'");
$provin->rowCount();
$infop=$provin->fetch();
class PDF extends TCPDF{
    public  function Header(){
        $imageFile= K_PATH_IMAGES.'logo.jpg';
        $this->Image($imageFile,18,0,20,'','JPG','','T',false,300,'',false,false,0,false,false,false);
        $this->Ln(1);
        $this->setFont('Times','B',20);
        $this->Cell(179,5,'RCR',0,1,'C');
        $this->setFont('Times','',13);
        $this->Cell(180,5,'RASSEMBLEMENT DES CHRÉTIENS RÉPUBLICAINS',0,1,'C');
        $this->Cell(180,5,'______________________________________________________________________________________________',0,1,'C');
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
$pdf->Ln();
$pdf->setFillColor(250,0,30);
$pdf->setFont('Times','B',13);
$pdf->Cell(180,5,'PARTI POLITIQUE',0,1,'C',1);
$pdf->setTextColor(0,0, 0);
$pdf->setFont('Times','',12);
$pdf->Cell(180,3,'03, Rue Olongi Quartier Mama-Yemo Kinshasa-Ngaliema',0,1,'C');
$pdf->Cell(180,3,'Arrêté N° 010/2006 du 30 janvier 2006',0,1,'C');
$pdf->setFont('helvetica','U',10);

$pdf->setFont('Times','B',18);
$pdf->Ln(4);
$pdf->Cell(180,5,"Liste des Membres de la Province de ".$infop['nom_p'],0,1,'C');
$pdf->Ln(4);
$pdf->setFillColor(224,235, 255);
$pdf->setFont('helvetica','B',13);
$pdf->Cell(26,5,"ID",1,0,'L',1);
$pdf->Cell(50,5,"Noms",1,0,'L',1);
$pdf->Cell(33,5,"Téléphone",1,0,'L',1);
$pdf->Cell(50,5,'Territoire',1,0,'L',1);
$pdf->Cell(30,5,'Secteur',1,0,'L',1);
//Boucle des données
foreach($tarificats as $tarificat):
    $pdf->Ln();
    $pdf->setFont('helvetica','',11);
    $pdf->Cell(26,7,$tarificat['codes'],1,0,'L',0);
    $pdf->Cell(50,7,$tarificat['nom'].' '.$tarificat['prenom'],1,0,'L',0);
    $pdf->Cell(33,7,$tarificat['telephone'],1,0,'L',0);
    $pdf->setFont('helvetica','',10);
    $pdf->Cell(50,7,$tarificat['nom_tr'],1,0,'L',0);
    $pdf->Cell(30,7,$tarificat['nom_sec'],1,0,'L',0);

endforeach;

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');