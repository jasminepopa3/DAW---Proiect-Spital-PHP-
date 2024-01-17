



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

    // Query pentru a obține pacientii
    $query_utilizatori_activi = "SELECT id_pacient, nume_pacient, prenume_pacient, cnp, sex FROM pacient";
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

    <link rel="stylesheet" href="pacienti.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

     <script>

     function redirectToAddPatient() {
        window.location.href = 'adauga_pacient.php';
    }
    
     function arataPopup(data) {
        var popup = document.getElementById('popupFisaPacient');
        if (popup) {
            document.getElementById('numePacient').textContent = data.nume_pacient;
            document.getElementById('prenumePacient').textContent = data.prenume_pacient;
            document.getElementById('sex').textContent = data.sex;
            document.getElementById('greutate').textContent = data.greutate;
            document.getElementById('inaltime').textContent = data.inaltime;
            document.getElementById('dataNasterii').textContent = data.data_nasterii;
            document.getElementById('nationalitate').textContent = data.nationalitate;
            document.getElementById('cnp').textContent = data.cnp;
            document.getElementById('serieCI').textContent = data.ci_serie;
            document.getElementById('nrCI').textContent = data.ci_numar;
            document.getElementById('adresa').textContent = data.adresa;
            document.getElementById('nrTelefon').textContent = data.numar_telefon;
            document.getElementById('email').textContent = data.email;
            popup.style.display = 'block';
        } else {
            console.error('Elementul popup nu a fost găsit!');
        }
    }

function inchidePopup() {
    document.getElementById('popupFisaPacient').style.display = 'none';
}

function printeazaFisa(idPacient) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Răspunsul de la generate_pdf.php
            console.log('PDF generat cu succes.');

             // Deschide PDF-ul într-o nouă fereastră
                window.open('generate_pdf.php?pacient_id=' + idPacient, '_blank');
            

        } else if (this.readyState == 4) {
            console.error('Eroare la request:', this.status);
        }
    };

    xhr.open('GET', 'generate_pdf.php?pacient_id=' + idPacient, true);
    xhr.send();
}



document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.deschide-fisa').forEach(button => {
        button.addEventListener('click', function() {
            var idPacient = this.getAttribute('data-id');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    arataPopup(data);

                    document.querySelector('#popupFisaPacient .printeaza-fisa').onclick = function() {
                        printeazaFisa(idPacient);
                    };

                } else if (this.readyState == 4) {
                    console.error('Eroare la request:', this.status);
                }
            };

            xhr.open('GET', 'get_fisa_pacient.php?idPacient=' + idPacient, true);
            xhr.send();
        });
    });
});

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
        // Afisez lista utilizatorilor activi
        echo '<ul>';
        echo '<li><button onclick="redirectToAddPatient()">Adauga pacient</button></li><br><br><br><br>';
        echo '<li>Lista pacienti:</li><br><br>';
        
        while ($row = $rezultat_utilizatori_activi->fetch_assoc()) {
            $id_pacient = $row['id_pacient'];
            $nume_utilizator_activ = $row['nume_pacient'];
            $prenume_utilizator_activ = $row['prenume_pacient'];
            $cnp_utilizator_activ = $row['cnp'];
            $sex_utilizator_activ = $row['sex'];
            echo "<li>$nume_utilizator_activ $prenume_utilizator_activ, $sex_utilizator_activ, $cnp_utilizator_activ <button data-id='$id_pacient' class='deschide-fisa'>Deschide fisa pacient</button></li>";
            echo "<br><br><br>";
        }
        echo '</ul>';
    } else {
        echo "Nu există pacienti.";
    } 
    // Închid conexiunea la baza de date
    $conn->close();
          
          ?>

        
          
<div id="popupFisaPacient" style="display:none;">
    <div style="text-align: center"><b>Fisa pacient</b><br><br></div>
    <div>Nume pacient: <span id="numePacient"></span></div>
    <div>Prenume pacient: <span id="prenumePacient"></span></div>
    <div>Sex: <span id="sex"></span></div>
    <div>Greutate: <span id="greutate"></span></div>
    <div>Inaltime: <span id="inaltime"></span></div>
    <div>Data nasterii: <span id="dataNasterii"></span></div>
    <div>Nationalitate: <span id="nationalitate"></span></div>
    <div>Cnp: <span id="cnp"></span></div>
    <div>Serie CI: <span id="serieCI"></span></div>
    <div>Nr. CI: <span id="nrCI"></span></div>
    <div>Adresa: <span id="adresa"></span></div>
    <div>Nr. telefon: <span id="nrTelefon"></span></div>
    <div>Email: <span id="email"></span></div>

    
    <br><br>
    <button onclick="inchidePopup()" >Închide</button>
    <button class="printeaza-fisa">Printează</button>

</div>



          
        
    </section>


  



</body>
</html>
<?php } else {
    // Utilizatorul nu este autentificat
    header("Location: index.php");
    exit();
}
?>
