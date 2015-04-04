<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
$ispis="";
$ispis2="";
$ispis3="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Kreiranje računa");
  
  $upitDetalji="SELECT kartotekaDetaljiID from kartotekaDetalji";
  
  if($podaciDetalji= $baza->selectUpiti($upitDetalji)){
      while($redDetalji = $podaciDetalji->fetch_array()){
         $ispis.="<option value='{$redDetalji['kartotekaDetaljiID']}'>{$redDetalji['kartotekaDetaljiID']}</option>";   
      }
  }else{
     $greske.="Greska pri radu s bazom podataka. <br>"; 
  }
  
  $upitDetalji2="SELECT * from popisBolesti";
  
  $upitKlijent="Select korisnikID,korisnikIme,korisnikaPrezime from korisnik where tipKorisnika_tipKorisnikaID=3 and ambulanta_ambulantaID!=0";
  if($podaciKlijent = $baza->selectUpiti($upitKlijent)){
      while($redKlijent = $podaciKlijent->fetch_array()){
         $ispis2.="<option value='{$redKlijent['korisnikID']}'>{$redKlijent['korisnikIme']} {$redKlijent['korisnikaPrezime']}</option>";   
      }
  }else{
      $greske.="Greska pri radu s bazom podataka. <br>"; 
  }
  
  $upitVeterinari="Select korisnikID,korisnikIme,korisnikaPrezime from korisnik where tipKorisnika_tipKorisnikaID=2";
  if($podaciVeterinari = $baza->selectUpiti($upitVeterinari)){
      while($redVeterinari = $podaciVeterinari->fetch_array()){
         $ispis3.="<option value='{$redVeterinari['korisnikID']}'>{$redVeterinari['korisnikIme']} {$redVeterinari['korisnikaPrezime']}</option>";   
      }
  }else{
      $greske.="Greska pri radu s bazom podataka. <br>"; 
  }
  

  if(isset($_POST['cRacun'])) {

         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['klijent'])){
          $greske.="Obavezno je odabrati klijenta.<br>"; 
         }else{
           $klijent = $_POST['klijent'];  
         }
         
         if(empty($_POST['veterinar'])){
          $greske.="Obavezno je odabrati veterinara.<br>"; 
         }else{
           $veterinar = $_POST['veterinar'];  
         }
         
         if (empty($greske)) {

            $upit = "insert into racun (racunDatumVrijeme,korisnik_klijentID,korisnik_veterinarID,kartotekaDetalji_kartotekaDetaljiID) values (now(),'$klijent','$veterinar','$kartoteka')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreiran račun");
                 header("Location: crudRacun.php");
            }  
        } 
         if (!empty($greske)){   
            header('Location: greske.php?kod='.$greske);
            exit();
         }
}
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $skripta="cRacun.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->assign('ispis3', $ispis3);
 $smarty->display('predlosci/cRacun.tpl');
 
 include 'footer.php';

 ?>
