<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Čitanje terapije");
  
  if (isset($_GET['idTerapija'])) {
      
        $idTerapija=$_GET['idTerapija'];
        $upit="Select * from terapija where terapijaID=$idTerapija";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $terapijaID=$red['terapijaID'];
            $terapijaOpis=$red['terapijaOpis'];
            $terapijaCijena=$red['terapijaCijena'];
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
 $smarty->assign('vrijednost', array("'$terapijaOpis'","'$terapijaCijena'","'$kartDetaljiID'"));
 $smarty->display('predlosci/rTerapija.tpl');
 
 include 'footer.php';

 ?>
