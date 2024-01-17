

<table>
<tr>
    <td style='width:50%'><img src="logoo.jpg" alt="logo_spital" width="75" height="60"></td>
    <td style='width:50%'><p style="text-align: right"><br>Strada Academiei 14,<br> București 010014 </p></td>
</tr>
<tr>
  <td colspan="2"></td>
</tr>
<tr>
  <td colspan="2" style="text-align: center; background-color: #f2f2f2;"><h1>Fisa pacient</h1></td>
</tr>
<tr>
  <td colspan="2"></td>
</tr>
<tr>
  <td colspan="2"></td>
</tr>
<tr>
  <td colspan="2">Nume pacient: <?php echo $nume_pacient ?></td>
</tr>
<tr>
  <td colspan="2">Prenume pacient: <?php echo $prenume_pacient ?></td>
</tr>
<tr>
  <td colspan="2">Data nasterii: <?php echo $data_nasterii ?></td>
</tr>
<tr>
  <td colspan="2">Sex: <?php echo $sex ?></td>
</tr>
<tr>
  <td colspan="2">Inaltime: <?php echo $inaltime ?></td>
</tr>
<tr>
  <td colspan="2">Greutate: <?php echo $greutate ?></td>
</tr>
<tr>
  <td colspan="2">Adresa: <?php echo $adresa ?></td>
</tr>
<tr>
  <td colspan="2">CNP: <?php echo $cnp ?></td>
</tr>
<tr>
  <td colspan="2">Nr. telefon: <?php echo $numar_telefon ?></td>
</tr>
<tr>
  <td colspan="2"></td>
</tr>
<tr>
  <td colspan="2"></td>
</tr>
<tr>
    <td width="70%" style="text-align:left">Data,</td>
    <td width="30%" style="text-align:right">Parafa unității medicale,</td>
</tr>

<?php
date_default_timezone_set('Europe/Bucharest');
$dataCurenta = date('Y-m-d');
?>

<tr>
    <td width="80%"><?php echo $dataCurenta ?></td>
    <td width="20%"><img src="parafa.png" alt="parafa_spital" width="200" height="190"></td>
</tr>
</table>
