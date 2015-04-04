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
  dnevnik_zapis("Kreiranje detalja kartoteke");
  
  $upitKartoteka="SELECT kartotekaID from kartoteka";
  
  if($podaciKartoteka= $baza->selectUpiti($upitKartoteka)){
      while($redKartoteka = $podaciKartoteka->fetch_array()){
         $ispis.="<option value='{$redKartoteka['kartotekaID']}'>{$redKartoteka['kartotekaID']}</option>";   
      }
  }else{
     $greske.="Greska pri radu s bazom podataka. <br>"; 
  }

  if(isset($_POST['cKartotekaDetalji'])) {

         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['datetime'])){
          $greske.="Obavezno je napisati datum i vrijeme.<br>"; 
         }else{
           $datetime = $_POST['datetime'];  
         }
         
         if(empty($_POST['status'])){
          $status=0;
         }else{
           $status = $_POST['status'];  
         }
         
         if(empty($_POST['statusR'])){
          $statusR=0;
         }else{
           $statusR = $_POST['statusR'];  
         }
         
         
       
         if (empty($greske)) {

            $upit = "insert into kartotekaDetalji(kartotekaID,datumVrijemePregleda,status,statusRacun) values ('$kartoteka','$datetime','$status','$statusR')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreiran detalj kartoteke");
                 header("Location: crudKartotekaDetalji.php");
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
 $skripta="cKartotekaDetalji.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->display('predlosci/cKartotekaDetalji.tpl');
 
 include 'footer.php';

 ?>
