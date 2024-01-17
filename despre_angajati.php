



<?php
session_start();
// error_reporting(E_ALL);
//  ini_set('display_errors', 1);
require 'jpgraph/src/jpgraph.php';
require 'jpgraph/src/jpgraph_pie.php';
require 'jpgraph/src/jpgraph_pie3d.php';

 

// Verific dacă utilizatorul este autentificat și este de tip admin
if (isset($_SESSION['user']) && !empty($_SESSION['user']['nume_utilizator']) && $_SESSION['user']['tip_user'] == 'admin') {
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
    // Creez un element div pentru pop-up
    var popup = document.createElement("div");
    popup.classList.add("popup");

    // Adaug un textarea pentru a scrie raportul
    var textArea = document.createElement("textarea");
    textArea.placeholder = "Introduceți raportul pentru " + numeUtilizator + "...";
    popup.appendChild(textArea);

    // Adaug un buton de salvare
    var salvareButton = document.createElement("button");
    salvareButton.textContent = "Salvare";
    salvareButton.onclick = function() {
        salveazaRaport(numeUtilizator, textArea.value);
        inchidePopUp();
    };
    popup.appendChild(salvareButton);

    // Adaug un buton de printare -- nu am mai adaugat->vezi pacienti
    // var printButton = document.createElement("button");
    // printButton.textContent = "Printează";
    // printButton.onclick = function() {
    //     printeazaRaport(numeUtilizator, textArea.value);
    // };
    //  popup.appendChild(printButton);

    // Adaug un buton de închidere
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
    // Folosesc AJAX pentru a trimite datele la server
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


    </script>
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
          // Verific dacă există rezultate
    if ($rezultat_utilizatori_activi->num_rows > 0) {
        // Afisez lista utilizatorilor activi + buton
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


//partea de jpgraph

$sql = "SELECT m.nume_meserie, COUNT(a.id_meserie) AS numar_angajati 
        FROM angajati a 
        JOIN meserii m ON a.id_meserie = m.id_meserie 
        GROUP BY a.id_meserie";

$result = $conn->query($sql);
if (!$result) {
    echo 'Eroare la executarea query-ului: ' . $conn->error;
    exit;
}

$meserii = array();
$numar_angajati = array();

while ($row = $result->fetch_assoc()) {
    $meserii[] = $row['nume_meserie'];
    $numar_angajati[] = $row['numar_angajati'];
}

$fimg = 'jpgraph-3d_pie.png';

$graph = new PieGraph(560, 320);

$theme_class = new VividTheme;
$graph->SetTheme($theme_class);
$graph->SetShadow();

$graph->title->Set('Numarul de angajati pe meserie');
$graph->title->SetFont(FF_FONT1, FS_BOLD);

$p1 = new PiePlot3D($numar_angajati);
$p1->ExplodeSlice(1);
$p1->SetCenter(0.5);
$p1->SetLegends($meserii);
$graph->legend->Pos(0.1, 0.9);

$graph->Add($p1);
$graph->Stroke($fimg);

if (file_exists($fimg)) {
    echo '<img src="' . $fimg . '" />';
} else {
    echo 'Unable to create: ' . $fimg;
}

$conn->close();
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
