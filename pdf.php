<?php

require("fpdf.php");
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

class PDF extends FPDF {

    // Header
    function Header() {
        // Logo
        $this->Image('img/exia.png', 70, 2, 80);
        // Saut de ligne
        $this->Ln(20);
    }

    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196, 5, '', 0, 0, 'C');
    }

}

// Activation de la classe
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica', '', 11);
$pdf->SetTextColor(0);


//requete a la BDD
if(isset($_POST)) {
$evenement = $_POST['event'];
$query = $bdd->prepare('SELECT * FROM evenements WHERE Id=' .$evenement);
$query->execute();
$data = $query->fetch();
$tab = explode('|', $data["Inscrits"]);
$date = $data['Date'];
$nomE = $data['Nom'];
}
$position_detail = 66; // Position à 8mm de l'entête
foreach ($tab as $userInscrits) {
    
    global $nbUser;
    $nbUser = $nbUser + 1;
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE Id =' . $userInscrits);
    $req->execute();
    $data = $req->fetch();
    $nom = $data['Nom'];
    $prenom = $data['Prenom'];
    $userInscrits = $nomE;
    
    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(50, 8, $nom, 1, 'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(58);
    $pdf->MultiCell(50, 8, $prenom, 1, 'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(108);
    $pdf->MultiCell(50, 8, $userInscrits, 1, 'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(158);
    $pdf->MultiCell(50, 8, $date, 1, 'L');

    $position_detail += 8;
}
// Position de l'entête à 10mm des infos (48 + 10)
$position_entete = 58;

function entete_table($position_entete) {
    global $pdf;
    $pdf->SetDrawColor(0); // Couleur du fond
    $pdf->SetFillColor(255, 0, 0); // Couleur des filets
    $pdf->SetTextColor(255); // Couleur du texte
    $pdf->SetY($position_entete);
    $pdf->SetX(8);
    $pdf->Cell(50, 8, 'Noms', 1, 0, 'C', 1);
    $pdf->SetX(58);
    $pdf->Cell(50, 8, 'Prenoms', 1, 0, 'C', 1);
    $pdf->SetX(108);
    $pdf->Cell(50, 8, 'Evenements', 1, 0, 'C', 1);
    $pdf->SetX(158);
    $pdf->Cell(50, 8, 'Dates', 1, 0, 'C', 1);
    $pdf->Ln(); // Retour à la ligne
}

entete_table($position_entete);

// Nom du fichier
$nom = 'ListeEtudiants';
// Création du PDF
$pdf->Output($nom, 'I');
?>