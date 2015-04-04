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
  dnevnik_zapis("Ažuriranje termina");
  
  if (isset($_GET['idTermin'])) {
        $idTermin=$_GET['idTermin'];
        $upit="Select * from termin where terminID=$idTermin";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $terminDatumVrijeme=$red['terminDatumVrijeme'];
            $kartotekaID=$red['kartoteka_kartotekaID'];
            $status2=$red['status'];
            $vet=$red['veterinar'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
        

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
        
  }else{
      $greske.="Fale podaci.<br>"; 
  }
  
  if(isset($_POST['uTermini'])) {
         
        $idTermin=$_GET['idTermin'];
      
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

            $upit = "update termin set terminDatumVrijeme='$datumVrijeme',kartoteka_kartotekaID='$kartoteka',status='$status',veterinar='$veterinar' where terminID='$idTermin'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno ažuriran termin");
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
 $skripta="uTermini.php?idTermin={$idTermin}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->assign('vrijednost', array("'$terminDatumVrijeme'","'$kartotekaID'","'$status2'","'$vet'"));
 $smarty->display('predlosci/uTermini.tpl');
 
 include 'footer.php';

 ?>
