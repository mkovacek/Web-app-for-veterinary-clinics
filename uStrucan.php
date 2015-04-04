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
  dnevnik_zapis("Ažuriranje stručnosti");
  
  if (isset($_GET['idStrucan']) && isset($_GET['idZivotinje']) && isset($_GET['idKorisnik']) ) {
        $idStrucan=$_GET['idStrucan'];
        $idZivotinje=$_GET['idZivotinje'];
        $idKorisnik=$_GET['idKorisnik'];
        
        $upitZivotinja="Select korisnikIme,korisnikaPrezime,tipZivotinjeNaziv from korisnik,strucan,tipZivotinje
                        where korisnik_korisnikID=korisnikID and tipZivotinje_tipZivotinjeID=tipZivotinjeID
                        and korisnikID=$idKorisnik and tipZivotinjeID=$idZivotinje";
        if($podaciS=$baza->selectUpiti($upitZivotinja)){
            $redS=$podaciS->fetch_array();
            $imeprezime=$redS['korisnikIme'].' '.$redS['korisnikaPrezime'];
            $zivotinja=$redS['tipZivotinjeNaziv'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
    }
  
  
  $upitKorisnik="Select korisnikID,korisnikIme,korisnikaPrezime from korisnik where tipKorisnika_tipKorisnikaID=2";
  if($podaciKorisnik = $baza->selectUpiti($upitKorisnik)){
      while($redKorisnik = $podaciKorisnik->fetch_array()){
         $ispis.="<option value='{$redKorisnik['korisnikID']}'>{$redKorisnik['korisnikIme']} {$redKorisnik['korisnikaPrezime']}</option>";   
      }
  }
  
  $upitTipZivotinje="Select * from tipZivotinje";
  if($podaciTipZivotinje = $baza->selectUpiti($upitTipZivotinje)){
      while($redTipZivotinje = $podaciTipZivotinje->fetch_array()){
         $ispis2.="<option value='{$redTipZivotinje['tipZivotinjeID']}'>{$redTipZivotinje['tipZivotinjeNaziv']}</option>";   
      }
  }
  
  
  if(isset($_POST['uStrucan'])) {

        $idStrucan=$_GET['idStrucan'];
        
        if(empty($_POST['veterinar'])){
          $greske.="Unos veterinara je obavezan.<br>"; 
        }else{
          $veterinar = $_POST['veterinar'];  
        }

         if(empty($_POST['tipZivotinje'])){
          $greske.="Obavezno je odabrati tip životinje.<br>"; 
         }else{
           $tipZivotinje = $_POST['tipZivotinje'];  
         }

         
         if (empty($greske)) {
                $upit = "update strucan set korisnik_korisnikID='$veterinar',tipZivotinje_tipZivotinjeID='$tipZivotinje' where strucanID='$idStrucan'";
                if (!$baza->ostaliUpiti($upit)){
                     $greske.="Greska pri radu s bazom podataka. <br>";
                }else{
                     dnevnik_zapis("Uspješno ažurirana stručnost");
                     header("Location: crudStrucan.php");
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

 include 'headerLogIn.php';
 $skripta="uStrucan.php?idStrucan={$idStrucan}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->assign('vrijednost', array("'$idKorisnik '","'$imeprezime'","'$idZivotinje'","'$zivotinja'"));
 $smarty->display('predlosci/uStrucan.tpl');
 
 include 'footer.php';

 ?>
