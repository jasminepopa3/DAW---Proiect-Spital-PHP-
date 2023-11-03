<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Jasmine"/>
    <meta name="description" content="Activitatile spitalului FMI"/>
    <meta name="keywords" content="Spital">



    <title>Activitatile spitalului FMI</title>

    <link rel="stylesheet" href="welcome_spital.css" />
  </head>


  <body>
    <nav>
        <div class="logo">Spitalul de Urgență FMI</div>
    </nav>
    

    
    <section class="hero">
      <div class="hero-container">
        <div class="column-left">
          <table>
               <tr>
                    <td>
                         Numele meu este Popa Jasmine-Mihaela, sunt studentă în anul II la Facultatea de Matematică și Informatică
                         din cadrul Universității din București și mi-am ales ca temă de proiect la materia Dezvoltarea Aplicațiilor Web (PHP) 'Gestionarea activităților unui spital'.
                    </td>
               </tr>
               <tr>
                    <td>
                         <br>
                         Pentru construirea unui mediu de lucru propice medicilor, dar și tuturor celorlalți angajați din cadrul unui spital, este necesar ca sistemele informaționale utilizate de către aceștia să fie de o calitate înaltă.
                         Deși spitalele au ca scop principal tratarea persoanelor bolnave, în spatele oricărei programări, a oricărei operații sau a oricărei situații de urgență se află birocrația.
                         Din păcate, excesul birocrației poate avea rezultate negative asupra muncii prestate în spitale, motiv pentru care o aplicație care să faciliteze stocarea tuturor datelor într-o baza de date, dar și generarea de documente este vitală.
                         Mi-am propus astfel să creez o aplicație web ușor de folosit, dar completă, prin care să se poată eficientiza procesele birocratice dintr-un spital.
                    </td>
               </tr>
               <tr>
                    <td>
                         <br>
                         Pentru început, am creat o bază de date care să acopere nevoile vitale în ceea ce reprezintă stocarea datelor dintr-un spital.
                         Am creat 16 tabele, având un număr divers de coloane (în funcție de datele ce ar trebui stocate în fiecare), incluzând chei primare, dar și chei străine care să permită corelarea cu celelalte tabele (dacă este necesar).
                         <br><br>Astfel, tabelele create (care se pot vedea și în imaginea din dreapta) sunt:
                         <ul>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;angajati</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aparate</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aparate_copii</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;furnizori</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;medicamente</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;meserii</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pacient</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paturi</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;paturi_copii</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;produse_uz_general</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;programari</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;program_lucru</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;roluri</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sectiuni</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tipuri_programari</li>
                              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;utilizatori</li>
                         </ul>
                         <br>Acum voi prezenta o descriere succintă a fiecărui tabel și a necesității fiecăruia.
                    </td>
               </tr>
               <tr>
                    <td>
                        <br><br>Tabelul <b>angajati</b> reține id-ul angajatului (cheie primară), id-ul meseriei sale (cheie străină ce face legătura cu tabelul <b>meserii</b>), precum și diverse detalii despre angajat (nume, prenume, data nașterii, cnp, data angajării, salariul etc.).
                        <br><br>Tabelul <b>aparate</b> reține id-ul aparatului (cheie primară), id-ul furnizorului (cheie străină ce face legătura cu tabelul <b>furnizori</b>), precum și alte detalii: denumirea, cantitatea, prețul de achiziție etc.
                        <br><br>Tabelul <b>aparate_copii</b> reține id-ul copiei, împreună cu id-ul aparatului (cheie străină ce face legătura cu tabelul <b>aparate</b>), împreună formând cheia primară a tabelului. De asemenea, în tabel se află și id-ul secțiunii (cheie străină ce face legătura cu tabelul <b>secțiuni</b>) și data de achiziție. Acest tabel a fost creat pentru a putea ține mai ușor evidența localizării fiecărui aparat (la UPU, la Cardiologie etc.).
                        <br><br>Tabelul <b>furnizori</b> reține id-ul furnizorului (cheie primară), alături de alte detalii precum denumirea, CIF-ul, banca, contul, adresa etc.
                        <br><br>Tabelul <b>medicamente</b> reține id-ul medicamentului (cheie primară), id-ul furnizorului (cheie străină ce face legătura cu tabelul <b>furnizori</b>), precum și alte detalii: denumirea, data fabricării, data expirării, cantitatea etc. Orice spital are o secțiune de farmacie pentru care trebuie să ținem evidența medicamentelor existente.
                        <br><br>Tabelul <b>meserii</b> reține id-ul meseriei (cheie primară) și numele meseriei (medic chirurg, medic ortoped, asistent medical, recepționistă etc.).
                        <br><br>Tabelul <b>pacient</b> reține id-ul pacientului (cheie primară), precum și alte detalii: numele, prenumele, cnp-ul, greutatea, înălțimea, data nașterii, sex, adresă etc.
                        <br><br>Tabelul <b>paturi</b> reține id-ul patului (cheie primară), id-ul furnizorului (cheie străină ce face legătura cu tabelul <b>furnizori</b>), precum și alte detalii: tipul patului, cantitatea etc.
                        
                    </td>
               </tr>
          </table>
        </div>

        <div class="column-right">
          <img
            id="hero-image"
            src="ss111.png"
            alt="illustration"
            class="hero-image"
          />
          <table>
          <tr>
          <br><br>Tabelul <b>paturi_copii</b> reține id-ul copiei, împreună cu id-ul patului (cheie străină ce face legătura cu tabelul <b>paturi</b>), împreună formând cheia primară a tabelului. De asemenea, în tabel se află și id-ul secțiunii (cheie străină ce face legătura cu tabelul <b>secțiuni</b>) și disponibilitatea. La fel ca în cazul tabelului <b>aparate_copii</b>, acest tabel a fost creat pentru a putea ține mai ușor evidența localizării fiecărui pat și a disponibilității sale (ocupat sau nu).
                        <br><br>Tabelul <b>produse_uz_general</b> reține id-ul produsului (cheie primară), id-ul furnizorului (cheie străină ce face legătura cu tabelul <b>furnizori</b>), precum și alte detalii: denumirea, cantitatea, prețul de achiziție etc. Acest tabel a fost creat deoarece un spital are nevoie de mai multe consumabile precum săpun, hârtie, ace, seringi etc.
                        <br><br>Tabelul <b>programari</b> reține id-ul programării (cheie primară), alături de id-ul pacientului programat (cheie străină ce face legătura cu tabelul <b>pacient</b>), id-ul angajatului care trebuie să fie prezent la programare (ex. un medic neurolog, un medic ORL etc.)(cheie străină ce face legătura cu tabelul <b>angajati</b>), id-ul secțiunii pentru care se face programarea (cheie străină ce face legătura cu tabelul <b>sectiuni</b>) și id-ul tipului de programare (ce face legătura cu tabelul <b>tipuri_programari</b>). De asemenea, se reține și data și ora programării, precum și prețul acesteia.
                        <br><br>Tabelul <b>tipuri_programari</b> reține id-ul tipului de programare (cheie primară), precum și denumirea (consult, operație, analize etc.).
                        <br><br>Tabelul <b>program_lucru</b> reține id-ul programului de zi (cheie primară), alături de id-ul angajatului pentru care se face programul în ziua respectivă (cheie străină ce face legătura cu tabelul <b>angajati</b>), dar și de id-ul secțiunii pe care va lucra (cheie străină ce face legătura cu tabelul <b>sectiuni</b>). În acest caz, am considerat necesară existența coloanei de id_secțiune, deoarece un asistent medical poate să lucreze pe secțiuni diferite, spre deosebire de medicii specializați. De asemenea, tabelul reține și ziua pentru care este făcut programul, precum și ora de începere și ora de ieșire din program.
                        <br><br>Tabelul <b>sectiuni</b> reține id-ul sectiunii (cheie primară), precum și numele secțiunii (ATI, UPU, Cardiologie, Gastroenterologie etc.).
                        <br><br>Tabelul <b>roluri</b> reține id-ul rolului pe care îl poate avea un utilizator atunci când se conectează în aplicația web (cheie primară), precum și numele rolului (admin, medic, asistent medical, recepționist etc.).
                        <br><br>Tabelul <b>utilizatori</b> reține id-ul utilizatorului care se conectează în aplicația web (cheie primară), id-ul rolului său (cheie străină ce face legătura cu tabelul <b>roluri</b>), precum și id-ul angajatului (cheie străină ce face legătura cu tabelul <b>angajati</b>). De asemenea, tabelul stochează și username-ul și parola.</tr>
                        <tr>
                    <td>
                         <br>Fiind cunoscut faptul că, în funcție de secțiunea din spital la care se prezintă un pacient, doctorul are de completat o fișă diferită, ce solicită completarea altor date față de celelalte secțiuni, îmi doresc ca aplicația mea web să permită utilizatorilor să deschidă fișe personalizate pentru fiecare secțiune. Astfel, odată cu crearea interfeței, voi crea și niște tabele <b>fisa_*</b> (ex. fisa_cardiologie, fisa_orl, fisa_ortopedie etc.) care să fie corelate cu tabelele <b>pacient, angajati, sectiuni</b> prin chei străine și care să stocheze datele necesare fiecărei secțiuni.
                    </td>
               </tr>
               <tr>
                    <td>
                         <br>Mulțumesc! 
                    </td>
               </tr>
          </table>
        </div>
      </div>
    </section>
  </body>
</html>
