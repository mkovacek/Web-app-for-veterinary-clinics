<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice dnevnik");
    if (isset($_GET['idDnevnik'])){
        $idDnevnik=$_GET['idDnevnik'];
        
        $upit="Select * from dnevnik where dnevnikID='$idDnevnik'";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $korisnik=$red['korisnik'];
            $adresa=$red['adresa'];
            $skripta=$red['skripta'];
            $tekst=$red['tekst'];
            $vrijeme=$red['vrijeme'];
        }else{
          $greske.="Greška kod rada sa bazom.<br>";  
        }
            
    }    
    if (!empty($greske)){   
    header('Location: greske.php?kod='.$greske);
    exit();
    }
}else{
    header("Location: greske.php?e=2");
    exit();
}
   
    include 'headerLogIn.php' ; 
    
    $smarty->assign('vrijednost', array("'$korisnik'","'$adresa'","'$skripta'","'$tekst'","'$vrijeme'"));
    $smarty->display('predlosci/rDnevnik.tpl');
    
    include 'footer.php' 
?>

