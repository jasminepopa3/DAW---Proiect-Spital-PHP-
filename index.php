<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Verific dacă utilizatorul este autentificat
if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
    $nume_utilizator = $_SESSION['user']['nume_utilizator'];
    $email = $_SESSION['user']['email'];
    // echo "Buna, ";
    // echo  $nume_utilizator;
} else {
    // Utilizatorul nu este autentificat

    // Cod specific pentru guests
    $mesaj = "Bine ați venit! Vă invităm să vă conectați pentru a trece la treaba!";
    echo "<script>alert('$mesaj');</script>";
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

    <link rel="stylesheet" href="home_page.css" />
  </head>


  <body>
    <nav>
        <div class="logo">Spitalul de Urgență FMI</div>
        <div class="nav-items">
          <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
            echo '<li class="dropdown">
                 <a href="#">Secții</a> 
                 <div class="dropdown-content">
                     <a href="cardiologie.php">Cardiologie</a>
                     <a href="ortopedie.php">Ortopedie</a>
                     <a href="upu.php">UPU</a>
                     <a href="pediatrie.php">Pediatrie</a>
                     <a href="ati.php">ATI</a>
                     <a href="gastroenterologie.php">Gastroenterologie</a>
                     <a href="pneumologie.php">Pneumologie</a>
                </div>
                </li>';
            }
            ?>

            <?php
            if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
                    echo '<li><a href="fise_pacienti.php">Fișe pacienți</a></li>';
            }
            ?>
            <?php
            //var_dump($_SESSION['user']);  Afișez conținutul array-ului $_SESSION['user']

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
      <div class="hero-container">
        <div class="column-left">
          <h1>Viața e o călătorie. Fiecare are dreptul de a se bucura de ea.</h1>
          <p>
            Suntem o echipă de profesioniști. Hai să ajutăm oamenii. Programările și urgențele te așteaptă.
          </p>
          <a href="welcome_spital.php"><button>Despre proiectul Spitalul de Urgență FMI</button></a><br>
          <?php

            if (!(isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator']))) { ?>
               <a href="login.php"><button>Autentificare</button></a>
            <?php } ?>
        </div>
        <div class="column-right">
          <img
            id="hero-image"
            src="fmi.png"
            alt="illustration"
            class="hero-image"
          />
        </div>
      </div>
    </section>


  </body>
</html>


