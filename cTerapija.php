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
  dnevnik_zapis("Kreiranje terapije");
  
  $upitDetalji="SELECT kartotekaDetaljiID from kartotekaDetalji 
                where kartotekaDetaljiID not in (Select kartotekaDetalji_kartotekaDetaljiID from terapija )";
  
  if($podaciDetalji= $baza->selectUpiti($upitDetalji)){
      while($redDetalji = $podaciDetalji->fetch_array()){
         $ispis.="<option value='{$redDetalji['kartotekaDetaljiID']}'>{$redDetalji['kartotekaDetaljiID']}</option>";   
      }
  }else{
     $greske.="Greska pri radu s bazom podataka. <br>"; 
  }

  if(isset($_POST['cTerapija'])) {

         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['terapija'])){
          $greske.="Obavezno je napisati simptom.<br>"; 
         }else{
           $terapija = $_POST['terapija'];  
         }
         
         if(empty($_POST['cijena'])){
          $greske.="Obavezno je odabrati simptom.<br>"; 
         }else{
           $cijena = $_POST['cijena'];  
         }
         
         if (empty($greske)) {

            $upit = "insert into terapija (terapijaOpis,terapijaCijena,kartotekaDetalji_kartotekaDetaljiID) values ('$terapija','$cijena','$kartoteka')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreirana terapija");
                 header("Location: crudTerapija.php");
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
 $skripta="cTerapija.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->display('predlosci/cTerapija.tpl');
 
 include 'footer.php';

 ?>
