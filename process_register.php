
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


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
    $nume_utilizator = $_POST["nume_utilizator"];
    //$nume = $_POST["nume"];
    //$prenume = $_POST["prenume"];
    $cnp = $_POST["cnp"];
    $email = $_POST["email"];
    $parola = $_POST["parola"];
    //$rol = $_POST["rol"];

    // Verific existenta CNP-ului în tabela angajati
    $verificare_cnp = "SELECT cnp FROM angajati WHERE cnp = '$cnp'";
    $rezultat = $conn->query($verificare_cnp);

    if ($rezultat->num_rows === 0) {
        echo '<script type="text/javascript">alert("Inregistrarea nu a functionat.");</script>';
        die("Acest angajat nu există.");
    }

    // Verific daca CNP-ul a fost deja utilizat de alt utilizator
    $verificare_cnp_utilizator = "SELECT cnp FROM utilizatori WHERE cnp = '$cnp'";
    $rezultat_cnp_utilizator = $conn->query($verificare_cnp_utilizator);

    if ($rezultat_cnp_utilizator->num_rows > 0) {
        echo '<script type="text/javascript">alert("Inregistrarea nu a functionat.");</script>';
        die("Acest CNP a fost deja utilizat de alt utilizator.");
    }

    // Verific daca adresa de email a fost deja utilizata
    $verificare_email_utilizator = "SELECT email FROM utilizatori WHERE email = '$email'";
    $rezultat_email_utilizator = $conn->query($verificare_email_utilizator);

    if ($rezultat_email_utilizator->num_rows > 0) {
        echo '<script type="text/javascript">alert("Inregistrarea nu a functionat.");</script>';
        die("Această adresă de email a fost deja utilizată.");
    }

    // Obțin id_angajat
    $angajat = $rezultat->fetch_assoc();
    $id_angajat = $angajat["id_angajat"];

    // Hash-uiesc parola
    $parola_hash = password_hash($parola, PASSWORD_DEFAULT);

    // Generez un cod de confirmare unic
    $cod_confirmare = md5(uniqid(rand(), true));

    // Salvez datele în baza de date (default: 'in asteptare')
    $sql = "INSERT INTO utilizatori (nume_utilizator, cnp, email, parola, id_angajat, cod_confirmare) 
            VALUES ('$nume_utilizator', '$cnp', '$email', '$parola_hash','$id_angajat', '$cod_confirmare')";

    if ($conn->query($sql) === TRUE) {
        require_once('class.phpmailer.php');

       // Mesajul
       $message = "Apasati pe link-ul urmator pentru a va activa contul: https://www.spital.kesug.com/confirm.php?cod=$cod_confirmare";
       //echo "Cod de confirmare: $cod_confirmare";

       $message = wordwrap($message, 160, "<br />\n");
       
       $mail = new PHPMailer(true); 
       $mail->IsSMTP();
       try {
        $username='spitaldaw@gmail.com';
        $password='yfqs hdlp svej jzzt ';
    
        $mail->SMTPDebug  = 0;                     
        $mail->SMTPAuth   = true; 

        $to=$email;
        $nume='Utilizator nou';

        $mail->SMTPSecure = "ssl";                 
        $mail->Host       = "smtp.gmail.com";      
        $mail->Port       = 465;                   
        $mail->Username   = $username;  			
        $mail->Password   = $password;            
        $mail->AddReplyTo('spitaldaw@gmail.com', 'Spitalul de urgenta FMI');
        $mail->AddAddress($to, $nume);
 
        $mail->SetFrom('spitaldaw@gmail.com', 'Spitalul de urgenta FMI');
        $mail->Subject = 'Activare cont';
        $mail->AltBody = 'Ceva nu a functionat cum trebuie.'; 
        $mail->MsgHTML($message);
        $mail->Send();
        echo "Mesajul a fost trimis cu succes. Verificati mail-ul.</p>\n";

        } catch (phpmailerException $e) {
             echo $e->errorMessage(); //Eroare de la PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Eroare de la altceva
        }
        
        echo '<script type="text/javascript">alert("Mail de confirmare trimis.");</script>';

        } else {
            echo "Eroare la trimiterea e-mail-ului.";
        }

    // Închid conexiunea la baza de date
    $conn->close();
}
?>
