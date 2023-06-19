<?php
require_once('tcpdf/tcpdf.php');

if (isset($_GET['id_cand'])) {
    $searchValue = $_GET['id_cand'];
    include('includes/dbconnection.php');

    // Requête SQL pour récupérer les données correspondantes
    $sql ="SELECT * FROM tblvisitor where ID = $searchValue ";
    $result = $con->query($sql);

    // Vérifier si la requête a été exécutée avec succès
    if ($result === false) {
        die("Erreur lors de l'exécution de la requête : " . $conn->error);
    }

    // Génération du fichier PDF
    $pdf = new TCPDF();
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetFont('times', '', 12);
    $pdf->AddPage();
    $pdf->SetTextColor(0, 0, 153); // Rouge (RGB: 255, 0, 0)
    $pdf->SetFontSize(16); // Taille de police 16 points
    $pdf->Cell(0, 10, "Confirmation d'inscription", 0, 1, 'C');
    $pdf->Cell(0, 10, "Salon de l'orientation et des études à l'étranger", 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetTextColor(0, 0, 0); // Rouge (RGB: 255, 0, 0)
    $pdf->SetFontSize(14); // Taille de police 16 points
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $pdf->Cell(40, 10, 'Nom:', 0, 0, 'L');
            $pdf->Cell(0, 10, $row['FullName'], 0, 1, 'L');

            $pdf->Cell(40, 10, 'Email:', 0, 0, 'L');
            $pdf->Cell(0, 10, $row['Email'], 0, 1, 'L');

            $pdf->Cell(40, 10, 'Téléphone:', 0, 0, 'L');
            $pdf->Cell(0, 10, $row['MobileNumber'], 0, 1, 'L');
            $pdf->Ln(10);
        }
    }
    // create some HTML content
$html = '
<img src="footer.png" alt="test alt attribute" width="2000" height="500" border="0" /></div>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();


    // Téléchargement du fichier PDF
    $pdf->Output('resultats_recherche.pdf', 'D');

    // Fermer la connexion à la base de données
    $conn->close();
}
