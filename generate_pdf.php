<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('tcpdf/tcpdf.php');
 // Conectare la baza de date 
   $servername = "sql306.infinityfree.com"; 
   $username = "if0_35353732"; 
   $password = "B6rndvUTlN"; 
   $dbname = "if0_35353732_spital_db"; 

    // Creez conexiunea
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verific conexiunea
    if ($conn->connect_error) {
        die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
    }

$id_pacient = isset($_GET['pacient_id']) ? intval($_GET['pacient_id']) : 0;

$sql = "SELECT * FROM pacient WHERE id_pacient = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_pacient);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    

    // Setez variabilele necesare pentru 'fisa_pacient_print_view.php'
    $nume_pacient = $row['nume_pacient']; 
    $prenume_pacient=$row['prenume_pacient'];
    $cnp=$row['cnp'];
    $data_nasterii=$row['data_nasterii'];
    $ci_serie=$row['ci_serie'];
    $ci_numar=$row['ci_numar'];
    $greutate=$row['greutate'];
    $inaltime=$row['inaltime'];
    $sex=$row['sex'];
    $numar_telefon=$row['numar_telefon'];
    $email=$row['email'];
    $adresa=$row['adresa'];
    

    // Începe să capturezi output-ul
    ob_start();
    include 'fisa_pacient_print_view.php';
    $view_content = ob_get_clean();

    

    // Crearea PDF-ului cu TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetTitle('Fisa consultatie');
    $pdf->SetHeaderMargin(12);
    $pdf->SetTopMargin(12);
    $pdf->SetFooterMargin(10);
    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

    $pdf->SetFont('freesans', '', 11);

    $pdf->AddPage();

    // Adăugați conținutul fișierului de vizualizare la PDF
    $pdf->writeHTML($view_content);

    // Output PDF
    $pdf->Output('fisa_pacient.pdf', 'I');
} else {
    echo "Nu s-au găsit date pentru pacientul specificat.";
}

// Închid conexiunea la baza de date
    $conn->close();
?>
