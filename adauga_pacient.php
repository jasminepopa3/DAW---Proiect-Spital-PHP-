



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

    <link rel="stylesheet" href="pacienti.css" />
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

            if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
              if (isset($_SESSION['user']['tip_user']) && $_SESSION['user']['tip_user'] == 'admin') {
                  // Utilizatorul este logat și are drepturi de admin, afișez butoanele specifice (despre angajati)
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
      
    <h2 style="text-align: center">Completează datele pacientului:</h2><br>

<form action="process_insert_pacient.php" method="post">
    <label for="nume_pacient">Nume pacient:</label>
    <input type="text" name="nume_pacient" required> <br><br>

    <label for="prenume_pacient">Prenume pacient:</label>
    <input type="text" name="prenume_pacient" required><br><br>

    <label for="prenume_tata">Prenume tata:</label>
    <input type="text" name="prenume_tata" required><br><br>

    <label for="greutate">Greutate:</label>
    <input type="number" name="greutate" required><br><br>

    <label for="inaltime">Inaltime:</label>
    <input type="number" name="inaltime" required><br><br>

    <label for="data_nasterii">Data nasterii:</label>
    <input type="date" name="data_nasterii" required><br><br>

    <label for="sex">Sex:</label>
    <input type="text" name="sex" required><br><br>

    <label for="adresa">Adresa:</label>
    <input type="text" name="adresa" required><br><br>

    <label for="cnp">CNP:</label>
    <input type="text" name="cnp" required><br><br>

    <label for="ci_serie">Serie CI:</label>
    <input type="text" name="ci_serie" required><br><br>

    <label for="ci_numar">Numar CI:</label>
    <input type="text" name="ci_numar" required><br><br>

    <label for="numar_telefon">Nr. telefon:</label>
    <input type="text" name="numar_telefon" required><br><br>

    <label for="email">Email:</label>
    <input type="text" name="email" required><br><br>

    <label for="nationalitate">Nationalitate:</label>
    <input type="text" name="nationalitate" required><br><br>

    <label for="asigurare_medicala">Asigurare medicala:</label>
    <input type="text" name="asigurare_medicala" required><br><br>

    <label for="casatorit">Casatorit:</label>
    <input type="text" name="casatorit" required><br><br>



    <input type="submit" value="Adauga acest pacient">
</form>
          
        
    </section>


  

</body>
</html>
<?php } else {  //nu e autentificat
    header("Location: index.php");
    exit();
}
?>











