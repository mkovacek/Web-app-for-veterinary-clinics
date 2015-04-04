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
  dnevnik_zapis("Ažuriranje detalja kartoteke");

  if (isset($_GET['idDetalji'])) {
        $idDetalji=$_GET['idDetalji'];
        $upit="Select * from kartotekaDetalji where kartotekaDetaljiID=$idDetalji";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $kartotekaID=$red['kartotekaID'];
            $datetimeID=$red['datumVrijemePregleda'];
            $statusID=$red['status'];
            $statusRID=$red['statusRacun'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
  }else{
      $greske.="Fale podaci. <br>"; 
  }  

  

    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $smarty->assign('vrijednost', array("'$kartotekaID'","'$datetimeID'","'$statusID'","'$statusRID'"));
 $smarty->display('predlosci/rKartotekaDetalji.tpl');
 
 include 'footer.php';

 ?>
