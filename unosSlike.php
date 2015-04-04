<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Unos slike");
    if (isset($_GET['idKartoteka'])){
        $idKartoteka=($_GET['idKartoteka']);
    }
    $skripta="upload_file.php?idKartoteka={$idKartoteka}";
    include 'headerLogIn.php';
    $smarty->assign('skripta', $skripta);
    $smarty->display('predlosci/unosSlike.tpl');
    include 'footer.php'; 
    
}else{
    header("Location: greske.php?e=2");
    exit();
}




?>




