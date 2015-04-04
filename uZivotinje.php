<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Ažuriranje tablice životinje");
    
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
    
     if (isset($_GET['idZivotinje'])){
        $idZivotinje=$_GET['idZivotinje'];
        $upit="SELECT zivotinjaIme,zivotinjaStarost,korisnikID,korisnikIme,korisnikaPrezime,tipZivotinjeID,tipZivotinjeNaziv
               FROM zivotinja,korisnik,tipZivotinje WHERE zivotinjaID='$idZivotinje' and korisnikID=korisnik_korisnikID
               AND tipZivotinjeID=tipZivotinje_tipZivotinjeID ";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $naziv=$red['zivotinjaIme'];
            $starost=$red['zivotinjaStarost'];
            $zivotinjaID=$red['tipZivotinjeID'];
            $zivotinja=$red['tipZivotinjeNaziv'];
            $korisnikID=$red['korisnikID'];
            $imeprezime=$red['korisnikIme'].' '.$red['korisnikaPrezime'];
        }else{
          $greske.="Greška kod rada sa bazom.<br>";  
        }       
    }
      
      if(isset($_POST['uZivotinje'])) {
        $idZivotinje=$_GET['idZivotinje'];
    
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
          $upit = "UPDATE zivotinja set zivotinjaIme='$ime',zivotinjaStarost='$starost',tipZivotinje_tipZivotinjeID='$tipZivotinje' ,korisnik_korisnikID='$korisnik' where zivotinjaID='$idZivotinje'";
          if (!$baza->ostaliUpiti($upit)){
              $greske.="Greska pri radu s bazom podataka. <br>";
          }else{
             dnevnik_zapis("Uspješno ažurirana životinja");
             header("Location: crudZivotinja.php");
          }
        }
      }

        if (!empty($greske)){   
            header('Location: greske.php?kod='.$greske);
            exit();
        }
}else{
    header("Location: greske.php?e=2");
    exit();
}
   
    include 'headerLogIn.php' ; 
    $skripta="uZivotinje.php?idZivotinje={$idZivotinje}";
    $smarty->assign('skripta', $skripta);
    $smarty->assign('ispis', $ispis);
    $smarty->assign('ispis2', $ispis2);
    $smarty->assign('vrijednost', array("'$naziv'","'$starost'","'$zivotinjaID'","'$zivotinja'","'$korisnikID'","'$imeprezime'"));
    $smarty->display('predlosci/uZivotinje.tpl');
    
    include 'footer.php' 
?>

