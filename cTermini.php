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
  dnevnik_zapis("Kreiranje termina");
  
  $upitKartoteka="SELECT kartotekaID from kartoteka";
  
  if($podaciKartoteka= $baza->selectUpiti($upitKartoteka)){
      while($redKartoteka = $podaciKartoteka->fetch_array()){
         $ispis.="<option value='{$redKartoteka['kartotekaID']}'>{$redKartoteka['kartotekaID']}</option>";   
      }
  }else{
     $greske.="Greska pri radu s bazom podataka. <br>"; 
  }
  
  $upitVeterinari="Select korisnikID,korisnikIme,korisnikaPrezime from korisnik where tipKorisnika_tipKorisnikaID=2";
  if($podaciVeterinari = $baza->selectUpiti($upitVeterinari)){
      while($redVeterinari = $podaciVeterinari->fetch_array()){
         $ispis2.="<option value='{$redVeterinari['korisnikID']}'>{$redVeterinari['korisnikIme']} {$redVeterinari['korisnikaPrezime']}</option>";   
      }
  }else{
      $greske.="Greska pri radu s bazom podataka. <br>"; 
  }

  if(isset($_POST['cTermini'])) {

        if(empty($_POST['datumVrijeme'])){
          $greske.="Unos datuma i vremena je obavezano.<br>"; 
        }else{
          $datumVrijeme = $_POST['datumVrijeme'];  
        }

         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['status'])){
          $status=0;
         }else{
           $status = $_POST['status'];  
         }
         
         if(empty($_POST['veterinar'])){
          $greske.="Obavezno je odabrati veterinara.<br>"; 
         }else{
           $veterinar = $_POST['veterinar'];  
         }
         
       
         if (empty($greske)) {

            $upit = "insert into termin(terminDatumVrijeme,kartoteka_kartotekaID,status,veterinar) values ('$datumVrijeme','$kartoteka','$status','$veterinar')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreiran termin");
                 header("Location: crudTermini.php");
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
 $skripta="cTermini.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
  $smarty->assign('ispis2', $ispis2);
 $smarty->display('predlosci/cTermini.tpl');
 
 include 'footer.php';

 ?>
