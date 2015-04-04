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
  dnevnik_zapis("Kreiranje stručnosti");
  
  $upitZivotinje="SELECT zivotinjaID, zivotinjaIme, korisnikIme, korisnikaPrezime
                  FROM zivotinja, korisnik
                  WHERE korisnikID = zivotinja.korisnik_korisnikID
                  AND zivotinjaID NOT IN (SELECT zivotinja_zivotinjaID FROM kartoteka)";
  
  if($podaciZivotinje = $baza->selectUpiti($upitZivotinje)){
      while($redZivotinje = $podaciZivotinje->fetch_array()){
         $ispis.="<option value='{$redZivotinje['zivotinjaID']}'>{$redZivotinje['zivotinjaIme']} {$redZivotinje['korisnikIme']} {$redZivotinje['korisnikaPrezime']}</option>";   
      }
  }
  
  
  $upitAmbulanta="Select ambulantaID,ambulantaNaziv from ambulanta";
  if($podaciAmbulanta = $baza->selectUpiti($upitAmbulanta)){
      while($redAmbulanta = $podaciAmbulanta->fetch_array()){
         $ispis2.="<option value='{$redAmbulanta['ambulantaID']}'>{$redAmbulanta['ambulantaNaziv']}</option>";   
      }
  }
  
  
  if(isset($_POST['cKartoteka'])) {

        if(empty($_POST['ambulanta'])){
          $greske.="Unos starosti je obavezano.<br>"; 
        }else{
          $ambulanta = $_POST['ambulanta'];  
        }

         if(empty($_POST['zivotinja'])){
          $greske.="Obavezno je odabrati tip životinje.<br>"; 
         }else{
           $zivotinja = $_POST['zivotinja'];  
         }
         
         $provjera="Select korisnikIme from zivotinja,korisnik,ambulanta
                    where zivotinjaID='$zivotinja' and ambulantaID='$ambulanta'
                    and korisnikID=korisnik_korisnikID and ambulantaID=ambulanta_ambulantaID";
         if($podaciProvjera=$baza->selectUpiti($provjera)){
             if($podaciProvjera->num_rows==0){
                 $greske.="Vlasnik životinje nepripada odabranoj ambulanti.<br>";
             }
         }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
         }
         
         
         if (empty($greske)) {

            $upit = "insert into kartoteka (zivotinja_zivotinjaID,kartotekaDatumVrijemeKreiranja,ambulanta_ambulantaID) values ('$zivotinja',now(),'$ambulanta')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreirana kartoteka");
                 header("Location: crudKartoteka.php");
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
 $skripta="cKartoteka.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->display('predlosci/cKartoteka.tpl');
 
 include 'footer.php';

 ?>
