<?php
// Conectare la baza de date
$servername = "sql306.infinityfree.com"; 
$username = "if0_35353732"; 
$password = "B6rndvUTlN"; 
$dbname = "if0_35353732_spital_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificare conexiune
if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

// Verificare dacă s-a primit un ID valid prin GET
if (isset($_GET['idPacient']) && is_numeric($_GET['idPacient'])) {
    $idPacient = $_GET['idPacient'];

    // Interogare pentru a obține informațiile despre pacient în funcție de ID
    $query = "SELECT * FROM pacient WHERE id_pacient = $idPacient";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Returnez datele sub formă de JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // ID-ul pacientului nu a fost găsit
        header('HTTP/1.1 404 Not Found');
        echo "ID-ul pacientului nu a fost găsit.";
    }
} else {
    // ID invalid sau lipsă
    header('HTTP/1.1 400 Bad Request');
    echo "ID invalid sau lipsă.";
}

// Închid conexiunea la baza de date
$conn->close();
?>
