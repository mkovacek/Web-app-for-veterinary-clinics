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
  dnevnik_zapis("Kreiranje životinja");
  
  $upitKorisnik="Select korisnikID,korisnikIme,korisnikaPrezime from korisnik where tipKorisnika_tipKorisnikaID=3 and status=1";
  if($podaciKorisnik = $baza->selectUpiti($upitKorisnik)){
      while($redKorisnik = $podaciKorisnik->fetch_array()){
         $ispis2.="<option value='{$redKorisnik['korisnikID']}'>{$redKorisnik['korisnikIme']} {$redKorisnik['korisnikaPrezime']}</option>";   
      }
  }
  
  $upitTipZivotinje="Select * from tipZivotinje";
  if($podaciTipZivotinje = $baza->selectUpiti($upitTipZivotinje)){
      while($redTipZivotinje = $podaciTipZivotinje->fetch_array()){
         $ispis.="<option value='{$redTipZivotinje['tipZivotinjeID']}'>{$redTipZivotinje['tipZivotinjeNaziv']}</option>";   
      }
  }
  
  
  if(isset($_POST['cZivotinje'])) {
      
        if(empty($_POST['ime'])){
          $greske.="Unos imena je obavezan.<br>"; 
        }else{
          $ime = $_POST['ime'];  
          if (ucfirst($ime) != $ime){ 
            $ime=ucfirst($ime); 
          }
        } 

        if(empty($_POST['starost'])){
          $greske.="Unos starosti je obavezano.<br>"; 
        }else{
          $starost = $_POST['starost'];  
        }

         if(empty($_POST['tipZivotinje'])){
          $greske.="Obavezno je odabrati tip životinje.<br>"; 
         }else{
           $tipZivotinje = $_POST['tipZivotinje'];  
         }
         if(empty($_POST['korisnik'])){
          $greske.="Obavezno je odabrati ambulantu.<br>"; 
         }else{
           $korisnik = $_POST['korisnik'];  
         }
         
         if (empty($greske)) {
          $upit = "insert into zivotinja (zivotinjaIme,zivotinjaStarost,tipZivotinje_tipZivotinjeID,korisnik_korisnikID) values ('$ime','$starost','$tipZivotinje','$korisnik')";
          if (!$baza->ostaliUpiti($upit)){
              $greske.="Greska pri radu s bazom podataka. <br>";
          }else{
             dnevnik_zapis("Uspješno kreirana životinja");
             header("Location: crudZivotinja.php");
          }
        }   
}
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $skripta="cZivotinje.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->display('predlosci/cZivotinje.tpl');
 
 include 'footer.php';

 ?>