



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
                    <a href="">Cardiologie</a>
                    <a href="">Ortopedie</a>
                    <a href="">UPU</a>
                    <a href="">Pediatrie</a>
                    <a href="">ATI</a>
                    <a href="">Gastroenterologie</a>
                    <a href="">Pneumologie</a>
                </div>
            </li>
            <li>
                <a href="pacienti.php">Fișe pacienți</a>
            </li>
            <?php

            if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
              if (isset($_SESSION['user']['tip_user']) && $_SESSION['user']['tip_user'] == 'admin') {
                  // Utilizatorul este logat și are drepturi de admin, afișează butoanele specifice (despre angajati)
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
           
              <h2>Aceasta este sectia de ati.</h2>
          
        
    </section>


  



</body>
</html>
<?php } else {
    // Utilizatorul nu este autentificat 
    header("Location: index.php");
    exit();
}
?>
