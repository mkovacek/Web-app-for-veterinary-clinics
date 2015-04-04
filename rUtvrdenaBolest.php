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
  dnevnik_zapis("Čitanje utvrđene bolesti");
  
  if (isset($_GET['idUtvrdenaBolest'])) {
      
        $idUtvrdenaBolest=$_GET['idUtvrdenaBolest'];
        $upit="Select popisBolestiNaziv,kartotekaDetalji_kartotekaDetaljiID,veterinar from utvrdenaBolest,popisBolesti where utvrdenaBolestID=$idUtvrdenaBolest and popisBolestiID=popisBolesti_popisBolestiID";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $popisBolestiNaziv=$red['popisBolestiNaziv'];
            $idKartoteka=$red['kartotekaDetalji_kartotekaDetaljiID'];
            $vet=$red['veterinar'];
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

 $smarty->assign('vrijednost', array("'$popisBolestiNaziv'","'$idKartoteka'","'$vet'"));
 $smarty->display('predlosci/rUtvrdenaBolest.tpl');
 
 include 'footer.php';

 ?>
