<?php
session_start();
session_destroy();
header("Location: index.php"); // sau pagina pe care o preferi
exit();
?>