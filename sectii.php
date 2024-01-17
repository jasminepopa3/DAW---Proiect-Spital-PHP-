



<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Verific dacă utilizatorul este autentificat
if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
    $nume_utilizator = $_SESSION['user']['nume_utilizator'];
    $email = $_SESSION['user']['email'];

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


     ?>

    
    <html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Jasmine"/>
    <meta name="description" content="Activitatile spitalului FMI"/>
    <meta name="keywords" content="Spital">



    <title>Activitatile spitalului FMI</title>

    <link rel="stylesheet" href="sectii.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  </head>


  <body>
    <nav>
        <div class="logo">Spitalul de Urgență FMI</div>
        <div class="nav-items">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="sectii.php">Secții</a> 
                <div class="dropdown-content">
                    <a href="cardiologie.php">Cardiologie</a>
                    <a href="ortopedie.php">Ortopedie</a>
                    <a href="upu.php">UPU</a>
                    <a href="pediatrie.php">Pediatrie</a>
                    <a href="ati.php">ATI</a>
                    <a href="gastroenterologie.php">Gastroenterologie</a>
                    <a href="pneumologie.php">Pneumologie</a>
                </div>
            </li>
            <li>
                <a href="pacienti.php">Fișe pacienți</a>
            </li>
            <?php
            //var_dump($_SESSION['user']);  Afișează conținutul array-ului $_SESSION['user']

            if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
              if (isset($_SESSION['user']['tip_user']) && $_SESSION['user']['tip_user'] == 'admin') {
                  // Utilizatorul este logat și are drepturi de admin, afișează butoanele specifice
                echo '<li class="dropdown">
                        <a href="#">Contul meu</a>
                        <div class="dropdown-content">
                           <a href="despre_angajati.php">Despre angajati</a>
                           <a href="logout.php">Logout</a>
                        </div>
                    </li>';
               }else if(isset($_SESSION['user']['tip_user']) && $_SESSION['user']['tip_user'] == 'user') {
                   echo '<li class="dropdown">
                        <a href="#">Contul meu</a>
                        <div class="dropdown-content">
                           <a href="logout.php">Logout</a>
                        </div>
                    </li>';

               }
}
?>

          </ul>
        </div>
    </nav>


    <section class="hero">
           <?php
// Calea către fluxul RSS
$rssUrl = 'https://www.openmedicalinstitute.org/feed/';

// Încarc conținutul fluxului RSS
$rssContent = simplexml_load_file($rssUrl);

// Verific dacă s-a încărcat cu succes
if ($rssContent) {


    // Afișez titlul fluxului
    echo '<h2> Spitalul nostru tinde spre excelenta si auto-depasire constanta. Astfel, personalul nostru din cadrul tutror secțiilor este intr-un continuu proces de invatare. Acest lucru este posibil doar datorita colegilor de la: <br><br> ' . $rssContent->channel->title . '</h2>';
    
    echo '<table>';
    // Afișez elementele din flux (titluri și conținut)
    foreach ($rssContent->channel->item as $item) {
        echo '<tr><td>';
        echo '<h3>' . $item->title . '</h3>';
        echo '</td></tr>';
        echo '<tr><td>';
        echo  $item->children('content', true)->encoded;
        echo '</td></tr>';
    }
    echo '</table>';
} else {
    echo 'Eroare la încărcarea fluxului RSS.';
}
?>

         
        
    </section>



</body>
</html>
<?php } else {
    // Utilizatorul nu este autentificat 
    header("Location: index.php");
    exit();
}
?>
