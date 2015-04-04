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
  
  
  if(isset($_POST['cStrucnost'])) {

        if(empty($_POST['veterinar'])){
          $greske.="Unos starosti je obavezano.<br>"; 
        }else{
          $veterinar = $_POST['veterinar'];  
        }

         if(empty($_POST['tipZivotinje'])){
          $greske.="Obavezno je odabrati tip životinje.<br>"; 
         }else{
           $tipZivotinje = $_POST['tipZivotinje'];  
         }

         
         if (empty($greske)) {
          $provjera="Select *from strucan where korisnik_korisnikID=$veterinar and tipZivotinje_tipZivotinjeID=$tipZivotinje";
          if($provjeraPodaci=$baza->selectUpiti($provjera)){
              if($provjeraPodaci->num_rows==0){
                $upit = "insert into strucan (korisnik_korisnikID,tipZivotinje_tipZivotinjeID) values ('$veterinar','$tipZivotinje')";
                if (!$baza->ostaliUpiti($upit)){
                     $greske.="Greska pri radu s bazom podataka. <br>";
                }else{
                     dnevnik_zapis("Uspješno kreirana stručnost");
                     header("Location: crudStrucan.php");
                }  
              }else{
                  $greske.="Veterinar je već stručan za taj tip životinje. <br>";
              }
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
 $skripta="cStrucnost.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->display('predlosci/cStrucnost.tpl');
 
 include 'footer.php';

 ?>
