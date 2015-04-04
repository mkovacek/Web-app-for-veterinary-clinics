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
  dnevnik_zapis("Kreiranje simptoma");
  
  $upitDetalji="SELECT kartotekaDetaljiID from kartotekaDetalji 
                where kartotekaDetaljiID not in (Select kartotekaDetalji_kartotekaDetaljiID from simptom )";
  
  if($podaciDetalji= $baza->selectUpiti($upitDetalji)){
      while($redDetalji = $podaciDetalji->fetch_array()){
         $ispis.="<option value='{$redDetalji['kartotekaDetaljiID']}'>{$redDetalji['kartotekaDetaljiID']}</option>";   
      }
  }else{
     $greske.="Greska pri radu s bazom podataka. <br>"; 
  }

  if(isset($_POST['cSimptomi'])) {

         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['simptom'])){
          $greske.="Obavezno je odabrati simptom.<br>"; 
         }else{
           $simptom = $_POST['simptom'];  
         }
         
         if (empty($greske)) {

            $upit = "insert into simptom (simptomOpis,kartotekaDetalji_kartotekaDetaljiID) values ('$simptom','$kartoteka')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreiran simptom");
                 header("Location: crudSimptomi.php");
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
 $skripta="cSimptomi.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->display('predlosci/cSimptomi.tpl');
 
 include 'footer.php';

 ?>
