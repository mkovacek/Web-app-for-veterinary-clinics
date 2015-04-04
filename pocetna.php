<?php
include_once('aplikacijskiOkvir.php');
session_start();
$korisnik = provjeraKorisnika();

include 'headerLogIn.php'; 

 if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Početna administrator");
    $smarty->display('predlosci/pocetnaAdmin.tpl');
 }else if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Početna veterinar");
    $smarty->display('predlosci/pocetnaVeterinar.tpl');
 }else if($korisnik->get_vrsta()==3){
    dnevnik_zapis("Početna korisnik");
    $smarty->display('predlosci/pocetnaRegistriraniKorisnik.tpl');
 }else{
   header("Location: greske.php?e=2");
   exit();  
}

include 'footer.php' 
?>
