<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispis2="";

if(!$korisnik->get_vrsta()==2){
    header("Location: greske.php?e=2");
    exit();
}
     
    include 'headerLogIn.php' ; 
    
    $smarty->display('predlosci/statistikaVeterinar.tpl');
    
    include 'footer.php' 
?>

