<?php
require("fpdf.php");

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('img/local/logoexia.png',8,2,80);
        // Saut de ligne
        $this->Ln(20);
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196,5,'Mes coordonnées - Mon téléphone',0,0,'C');
    }
}

// Activation de la classe
$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);

$requete = $bdd->query("SELECT * FROM evenements WHERE Id=8");
$reponse = $requete->fetch();


$pdf->Text(120,38,utf8_decode($row1['prenom']).' '.utf8_decode($row1['nom']));
$pdf->Text(120,43,utf8_decode($row1['adresse']));
$pdf->Text(120,48,$row1['code_postal'].' '.utf8_decode($row1['ville']));

// Position de l'entête à 10mm des infos (48 + 10)
$position_entete = 58;

function entete_table($position_entete){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position_entete);
    $pdf->SetX(8);
    $pdf->Cell(158,8,'Nom',1,0,'L',1);
    $pdf->SetX(166); // 8 + 96
    $pdf->Cell(10,8,'Description',1,0,'C',1);
    $pdf->SetX(176); // 104 + 10
    $pdf->Cell(24,8,'Date',1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne
}
entete_table($position_entete);

// Liste des détails
$position_detail = 66; // Position à 8mm de l'entête

    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(158,8,utf8_decode($reponse['Nom']),1,'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(166);
    $pdf->MultiCell(10,8,$reponse['Description'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(176);
    $pdf->MultiCell(24,8,$reponse['Date'],1,'R');
    $position_detail += 8;

    // Nom du fichier
$nom = 'Facture.pdf';

// Création du PDF
$pdf->Output($nom,'I');?>