<?php
session_start();

if (!isset($_SESSION['user']) && empty($_SESSION['user']['nume_utilizator'])) {
    header("Location: index.php"); 
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date
    $servername = "sql306.infinityfree.com"; 
    $username = "if0_35353732"; 
    $password = "B6rndvUTlN"; 
    $dbname = "if0_35353732_spital_db"; 

    // Creează conexiunea
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifică conexiunea
    if ($conn->connect_error) {
        die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
    }

    // Preia datele din formular
    $nume_pacient = htmlspecialchars($_POST['nume_pacient']);
    $prenume_pacient = htmlspecialchars($_POST['prenume_pacient']);
    $cnp = htmlspecialchars($_POST['cnp']);
    $sex = htmlspecialchars($_POST['sex']);
    $ci_serie = htmlspecialchars($_POST['ci_serie']);
    $data_nasterii = htmlspecialchars($_POST['data_nasterii']);
    $greutate = htmlspecialchars($_POST['greutate']);
    $inaltime = htmlspecialchars($_POST['inaltime']);
    $numar_telefon = htmlspecialchars($_POST['numar_telefon']);
    $adresa = htmlspecialchars($_POST['adresa']);
    $nationalitate = htmlspecialchars($_POST['nationalitate']);
    $email = htmlspecialchars($_POST['email']);
    $prenume_tata = htmlspecialchars($_POST['prenume_tata']);
    $casatorit = htmlspecialchars($_POST['casatorit']);
    $asigurare_medicala = htmlspecialchars($_POST['asigurare_medicala']);

    // Salvează datele în baza de date
    $sql = "INSERT INTO pacient (nume_pacient, prenume_pacient, prenume_tata, greutate, inaltime, data_nasterii, sex, adresa,
    cnp, ci_serie, ci_numar, numar_telefon, email, nationalitate, asigurare_medicala, casatorit) VALUES ('$nume_pacient', '$prenume_pacient',
    '$prenume_tata', '$greutate', '$inaltime', '$data_nasterii', '$sex', '$adresa', '$cnp', '$ci_serie', '$ci_numar', '$numar_telefon', '$email',
    '$nationalitate', '$asigurare_medicala', '$casatorit')";

    if ($conn->query($sql) === TRUE) {
        echo "Pacient adăugat cu succes! Va vom readuce la pagina pentru Fise pacienti.";
        header("refresh:5;url=pacienti.php"); // Redirect after 5 seconds
    exit();
    } else {
        echo "Eroare la adăugarea pacientului: " . $conn->error;
    }

    // Închide conexiunea la baza de date
    $conn->close();
}
?>
