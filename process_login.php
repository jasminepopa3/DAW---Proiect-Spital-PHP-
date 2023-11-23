<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    // Preiau datele din formular
    $email = $_POST["email"];
    $parola = $_POST["parola"];

    // Verific dacă utilizatorul este activ
    $verificare_status = "SELECT status, parola FROM utilizatori WHERE email = '$email'";
    $rezultat_status = $conn->query($verificare_status);

    if ($rezultat_status->num_rows > 0) {
        $utilizator = $rezultat_status->fetch_assoc();
        $status = $utilizator["status"];
        $parola_hash = $utilizator["parola"];

        if ($status !== "activ") {
            die("Contul nu este activ. Verificați adresa de e-mail pentru instrucțiuni de activare.");
        }

        // Verific parola
        if (password_verify($parola, $parola_hash)) {
            header("Location: welcome_spital.php");
            exit();
        } else {
            die("Parola incorectă.");
        }
    } else {
        die("Adresa de e-mail sau parola incorecte.");
    }

    // Închid conexiunea la baza de date
    $conn->close();
}
?>
