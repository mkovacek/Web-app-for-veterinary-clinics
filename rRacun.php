<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Čitanje terapije");
  
  if (isset($_GET['idRacun'])) {
      
        $idRacun=$_GET['idRacun'];
        $upit="Select racunDatumVrijeme,korisnikIme,korisnikaPrezime,kartotekaDetalji_kartotekaDetaljiID from racun,korisnik where racunID='$idRacun' and korisnik_klijentID=korisnikID";
        if($podaci=$baza->selectUpiti($upit)){ 
            $red=$podaci->fetch_array();
            $datetime=$red['racunDatumVrijeme'];
            $korisnik=$red['korisnikIme'].' '.$red['korisnikaPrezime'];
            $kartDetaljiID=$red['kartotekaDetalji_kartotekaDetaljiID'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
        
        $upit2="Select korisnikIme,korisnikaPrezime,kartotekaDetalji_kartotekaDetaljiID from racun,korisnik where racunID='$idRacun' and korisnik_veterinarID=korisnikID";
        if($podaci=$baza->selectUpiti($upit2)){ 
            $red=$podaci->fetch_array();
            $veterinar=$red['korisnikIme'].' '.$red['korisnikaPrezime'];
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
 $smarty->assign('vrijednost', array("'$datetime'","'$korisnik'","'$veterinar'","'$kartDetaljiID'"));
 $smarty->display('predlosci/rRacun.tpl');
 
 include 'footer.php';

 ?>
