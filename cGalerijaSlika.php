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
  dnevnik_zapis("Kreiranje galerije slika");
  
  $upitKartoteka="SELECT kartotekaID from kartoteka";
  
  if($podaciKartoteka= $baza->selectUpiti($upitKartoteka)){
      while($redKartoteka = $podaciKartoteka->fetch_array()){
         $ispis.="<option value='{$redKartoteka['kartotekaID']}'>{$redKartoteka['kartotekaID']}</option>";   
      }
  }else{
     $greske.="Greska pri radu s bazom podataka. <br>"; 
  }

  if(isset($_POST['cGalerijaSlika'])) {

         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['url'])){
          $greske.="Obavezno je napisati url.<br>"; 
         }else{
           $url = $_POST['url'];  
         }
         
         
       
         if (empty($greske)) {

            $upit = "insert into galerijaSlika(galerijaSlikaUrl,kartoteka_kartotekaID) values ('$url','$kartoteka')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreirana galerija slika");
                 header("Location: crudGalerijaSlika.php");
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
 $skripta="cGalerijaSlika.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->display('predlosci/cGalerijaSlika.tpl');
 
 include 'footer.php';

 ?>
