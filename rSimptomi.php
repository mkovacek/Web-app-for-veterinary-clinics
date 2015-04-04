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
  dnevnik_zapis("Čitanje simptoma");
  
  if (isset($_GET['idSimptom'])) {
      
        $idSimptom=$_GET['idSimptom'];
        $upit="Select * from simptom where simptomID=$idSimptom";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $simptomOpis=$red['simptomOpis'];
            $kartDetaljiID=$red['kartotekaDetalji_kartotekaDetaljiID'];
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
 $smarty->assign('vrijednost', array("'$simptomOpis'","'$kartDetaljiID'"));
 $smarty->display('predlosci/rSimptomi.tpl');
 
 include 'footer.php';

 ?>
