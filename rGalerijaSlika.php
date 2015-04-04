<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Čitanje galerije slika");
  
  if (isset($_GET['idGalerija'])) {
        $idGalerija=$_GET['idGalerija'];
        $upit="Select * from galerijaSlika where galerijaSlikaID=$idGalerija";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $url=$red['galerijaSlikaUrl'];
            $kartotekaID=$red['kartoteka_kartotekaID'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
  }      
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';

 $smarty->assign('vrijednost', array("'$kartotekaID'","'$url'"));
 $smarty->display('predlosci/rGalerijaSlika.tpl');
 
 include 'footer.php';

 ?>
