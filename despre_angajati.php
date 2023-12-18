



<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Verifică dacă utilizatorul este autentificat și este de tip admin
if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator']) && $_SESSION['user']['tip_user'] == 'admin') {
    $nume_utilizator = $_SESSION['user']['nume_utilizator'];
    $email = $_SESSION['user']['email'];

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

    // Query pentru a obține utilizatorii activi
    $query_utilizatori_activi = "SELECT nume_utilizator FROM utilizatori WHERE status = 'activ'";
    $rezultat_utilizatori_activi = $conn->query($query_utilizatori_activi);


     ?>

    
    <html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Jasmine"/>
    <meta name="description" content="Activitatile spitalului FMI"/>
    <meta name="keywords" content="Spital">



    <title>Activitatile spitalului FMI</title>

    <link rel="stylesheet" href="despre_angajati.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script>
    function deschidePopUp(numeUtilizator) {
    // Crează un element div pentru pop-up
    var popup = document.createElement("div");
    popup.classList.add("popup");

    // Adaugă un text area pentru introducerea raportului
    var textArea = document.createElement("textarea");
    textArea.placeholder = "Introduceți raportul pentru " + numeUtilizator + "...";
    popup.appendChild(textArea);

    // Adaugă un buton de salvare
    var salvareButton = document.createElement("button");
    salvareButton.textContent = "Salvare";
    salvareButton.onclick = function() {
        salveazaRaport(numeUtilizator, textArea.value);
        inchidePopUp();
    };
    popup.appendChild(salvareButton);

    // Adaugă un buton de printare
    var printButton = document.createElement("button");
    printButton.textContent = "Printează";
    printButton.onclick = function() {
        printeazaRaport(numeUtilizator, textArea.value);
    };
    //  popup.appendChild(printButton);

    // Adaugă un buton de închidere
    var inchidereButton = document.createElement("button");
    inchidereButton.textContent = "Închidere";
    inchidereButton.onclick = function() {
        inchidePopUp();
    };
    popup.appendChild(inchidereButton);

    // Adaugă pop-up-ul la body
    document.body.appendChild(popup);
}


function inchidePopUp() {
    var popup = document.querySelector(".popup");
    if (popup) {
        popup.remove();
    }
}


function salveazaRaport(numeUtilizator, continut) {
    // Folosim AJAX pentru a trimite datele la server
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("POST", "salveaza_raport.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("nume_utilizator=" + encodeURIComponent(numeUtilizator) + "&continut=" + encodeURIComponent(continut));
}


function printeazaRaport(numeUtilizator, continut) {
    salveazaRaport(numeUtilizator, continut) ;
    // Generare PDF folosind PHP
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            window.open(this.responseText, '_blank'); // Deschide PDF-ul într-o fereastră nouă
        }
    };
    xhttp.open("POST", "generare_pdf.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("nume_utilizator=" + encodeURIComponent(numeUtilizator) + "&continut=" + encodeURIComponent(continut));
}








    </script>
  </head>


  <body>
    <nav>
        <div class="logo">Spitalul de Urgență FMI</div>
        <div class="nav-items">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="">Secții</a> 
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
                <a href="">Fișe pacienți</a>
            </li>
            <?php
            //var_dump($_SESSION['user']);  Afișează conținutul array-ului $_SESSION['user']

            if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator'])) {
              if (isset($_SESSION['user']['tip_user']) && $_SESSION['user']['tip_user'] == 'admin') {
                  // Utilizatorul este logat și are drepturi de admin, afișează butoanele specifice
                echo '<li class="dropdown">
                        <a href="#">Contul meu</a>
                        <div class="dropdown-content">
                           <a href="#">Despre angajati</a>
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
          // Verifică dacă există rezultate
    if ($rezultat_utilizatori_activi->num_rows > 0) {
        // Afisează lista utilizatorilor activi
        echo '<ul>';
        while ($row = $rezultat_utilizatori_activi->fetch_assoc()) {
            $nume_utilizator_activ = $row['nume_utilizator'];
            echo "<li>$nume_utilizator_activ <button onclick=\"deschidePopUp('$nume_utilizator_activ')\">Adaugă raport</button></li>";
            echo "<br><br><br>";
        }
        echo '</ul>';
    } else {
        echo "Nu există utilizatori activi.";
    } 
    // Închide conexiunea la baza de date
    $conn->close();
          
          ?>
          
        
    </section>


  


</script>
</body>
</html>
<?php } else {
    // Utilizatorul nu este autentificat sau nu este de tip admin, îl redirecționăm către o altă pagină
    header("Location: index.php");
    exit();
}
?>
