
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Verificare reCAPTCHA
$secretKey = "6LeNqDUpAAAAAHXdZ-oencWdG8i1qJbOndZBEQOf";
$response = $_POST['g-recaptcha-response'];
$remoteIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIP";
$recaptchaData = json_decode(file_get_contents($url));

if (!$recaptchaData->success) {
    // Răspunsul reCAPTCHA nu este valid
    echo "Eroare reCAPTCHA!";
} else {
    // Răspunsul reCAPTCHA este valid

 
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
    $email = htmlspecialchars($_POST['email']);
    $parola = htmlspecialchars($_POST['parola']);

    // Verific dacă utilizatorul este activ
    $verificare_status = "SELECT status, parola, nume_utilizator, email, tip_user FROM utilizatori WHERE email = '$email'";
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

            //Preiau numele utilizatorului din db
            // $query_nume_utilizator = "SELECT nume_utilizator FROM utilizatori WHERE email = '$email'";
            // $rezultat_nume_utilizator = $conn->query($query_nume_utilizator);

            // if ($rezultat_nume_utilizator->num_rows > 0) {
            //    $nume_utilizator = $rezultat_nume_utilizator->fetch_assoc()["nume_utilizator"];

                $_SESSION['user'] = array(
                 'nume_utilizator' => $utilizator["nume_utilizator"],
                  'email' => $utilizator["email"],
                 'tip_user' => $utilizator["tip_user"],
                );

            header("Location: index.php");
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
}
?>
