<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
$ispis="";
$ispis2="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanjetermina");
  
    if (isset($_GET['idTermin'])) {
          $idTermin=$_GET['idTermin'];
          $upit="Select * from termin where terminID=$idTermin";
          if($podaci=$baza->selectUpiti($upit)){
              $red=$podaci->fetch_array();
              $terminDatumVrijeme=$red['terminDatumVrijeme'];
              $kartotekaID=$red['kartoteka_kartotekaID'];
              $status=$red['status'];
              $veterinar=$red['veterinar'];
          }else{
              $greske.="Greska pri radu s bazom podataka. <br>"; 
          }
    }else{
        $greske.="Fale podaci.<br>"; 
    }
  
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $smarty->assign('vrijednost', array("'$terminDatumVrijeme'","'$kartotekaID'","'$status'","'$veterinar'"));
 $smarty->display('predlosci/rTermini.tpl');
 
 include 'footer.php';

 ?>
