<?php
include_once('aplikacijskiOkvir.php');
session_start();
$korisnik = provjeraKorisnika();

include 'headerLogIn.php'; 

 if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD-popis tablica");
    $smarty->display('predlosci/crudB.tpl');
 }else{
   header("Location: greske.php?e=2");
   exit();  
}

include 'footer.php' 
?>
