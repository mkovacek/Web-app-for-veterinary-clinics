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
  dnevnik_zapis("Kreiranje utvrđene bolesti");
  
  $upitDetalji="SELECT kartotekaDetaljiID from kartotekaDetalji 
                where kartotekaDetaljiID not in (Select kartotekaDetalji_kartotekaDetaljiID from utvrdenaBolest )";
  
  if($podaciDetalji= $baza->selectUpiti($upitDetalji)){
      while($redDetalji = $podaciDetalji->fetch_array()){
         $ispis.="<option value='{$redDetalji['kartotekaDetaljiID']}'>{$redDetalji['kartotekaDetaljiID']}</option>";   
      }
  }else{
     $greske.="Greska pri radu s bazom podataka. <br>"; 
  }
  
  $upitDetalji2="SELECT * from popisBolesti";
  
  if($podaciDetalji2= $baza->selectUpiti($upitDetalji2)){
      while($redDetalji2 = $podaciDetalji2->fetch_array()){
         $ispis2.="<option value='{$redDetalji2['popisBolestiID']}'>{$redDetalji2['popisBolestiNaziv']}</option>";   
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
  

  if(isset($_POST['cUtvrdenaBolest'])) {

         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['bolest'])){
          $greske.="Obavezno je odabrati bolest.<br>"; 
         }else{
           $bolest = $_POST['bolest'];  
         }
         
         if(empty($_POST['veterinar'])){
          $greske.="Obavezno je odabrati veterinara.<br>"; 
         }else{
           $veterinar = $_POST['veterinar'];  
         }
         
         if (empty($greske)) {

            $upit = "insert into utvrdenaBolest (kartotekaDetalji_kartotekaDetaljiID,popisBolesti_popisBolestiID,veterinar) values ('$kartoteka','$bolest','$veterinar')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreirana utvrđena bolest");
                 header("Location: crudUtvrdenaBolest.php");
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
 $skripta="cUtvrdenaBolest.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->assign('ispis3', $ispis3);
 $smarty->display('predlosci/cUtvrdenaBolest.tpl');
 
 include 'footer.php';

 ?>
