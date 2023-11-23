<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cod"])) {
    $cod_confirmare = $_GET["cod"];

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

// Verific dacă codul de confirmare există în baza de date
$verificare_cod = "SELECT * FROM utilizatori WHERE cod_confirmare = '$cod_confirmare'";
$result = $conn->query($verificare_cod);

if ($result->num_rows > 0) {
    // Actualizez statusul contului la "activat"
    $update_sql = "UPDATE utilizatori SET status = 'activ' WHERE cod_confirmare = '$cod_confirmare'";
    if ($conn->query($update_sql)) {
        echo "Contul a fost activat cu succes! Va puteti autentifica acum. <a href='index.php'>Autentificare</a>";
    } else {
        echo "Eroare la activarea contului: " . $conn->error;
    }
} else {
    echo "Cod de confirmare invalid!";
}

} else {
    echo "Acces invalid la acest script.";
}
?>
