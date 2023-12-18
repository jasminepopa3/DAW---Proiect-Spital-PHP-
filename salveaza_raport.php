<?php
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

// Preluare date din request
$numeUtilizator = $_POST['nume_utilizator'];
$continut = $_POST['continut'];

// Salvez raportul în baza de date
$query = "INSERT INTO rapoarte_angajati (nume_utilizator, continut) VALUES ('$numeUtilizator', '$continut')";

if ($conn->query($query) === TRUE) {
    echo "Raportul a fost salvat cu succes!";
} else {
    echo "Eroare la salvarea raportului: " . $conn->error;
}

// Închid conexiunea
$conn->close();
?>
