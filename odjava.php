<?php
include_once('aplikacijskiOkvir.php');
session_start();
dnevnik_zapis("Odjava");
unset($_SESSION["PzaWeb"]);
PrijavaOdjavaKorisnika::brisanjeSesije();
header("Location: index.php");
?>

