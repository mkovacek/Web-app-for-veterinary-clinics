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
  dnevnik_zapis("Čitanje popisa bolesti");
   
  if (isset($_GET['idBolesti'])) {
      
      $idBolesti=$_GET['idBolesti'];
        $upit="Select * from popisBolesti where popisBolestiID=$idBolesti";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $popisBolestiID=$red['popisBolestiID'];
            $nazivBolesti=$red['popisBolestiNaziv'];
        }
      
  }else{
      $greske.="Fale podaci.<br>";
  }
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';;
 $smarty->assign('vrijednost', array("'$nazivBolesti'"));
 $smarty->display('predlosci/rPopisBolesti.tpl');
 
 include 'footer.php';

 ?>
