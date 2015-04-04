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
  dnevnik_zapis("Ažuriranje računa");
  
  if (isset($_GET['idRacun'])) {
      
        $idRacun=$_GET['idRacun'];
        $upit="Select korisnik_klijentID,korisnik_veterinarID,kartotekaDetalji_kartotekaDetaljiID from racun where racunID=$idRacun";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $klijent=$red['korisnik_klijentID'];
            $vet=$red['korisnik_veterinarID'];
            $idKartoteka=$red['kartotekaDetalji_kartotekaDetaljiID'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
        
        
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
        
  }else{
      $greske.="Fale podaci.<br>"; 
  }

  if(isset($_POST['uRacun'])) {
   
         $idRacun=$_GET['idRacun'];
         
         
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

            $upit = "update racun set racunDatumVrijeme=now(), korisnik_klijentID='$klijent',korisnik_veterinarID='$veterinar', kartotekaDetalji_kartotekaDetaljiID='$kartoteka' where racunID='$idRacun'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno ažuriran račun");
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
 $skripta="uRacun.php?idRacun={$idRacun}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis2', $ispis2);
  $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis3', $ispis3);
 $smarty->assign('vrijednost', array("'$klijent'","'$vet'","'$idKartoteka'"));
 $smarty->display('predlosci/uRacun.tpl');
 
 include 'footer.php';

 ?>
