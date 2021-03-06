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
  dnevnik_zapis("Ažuriranje galerije slika");
  
  if (isset($_GET['idGalerija'])) {
        $idGalerija=$_GET['idGalerija'];
        $upit="Select * from galerijaSlika where galerijaSlikaID=$idGalerija";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $url=$red['galerijaSlikaUrl'];
            $kartotekaID=$red['kartoteka_kartotekaID'];
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

  }  
  
  if(isset($_POST['uGalerijaSlika'])) {

         $idGalerija=$_GET['idGalerija'];
      
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

            $upit = "update galerijaSlika set galerijaSlikaUrl='$url',kartoteka_kartotekaID='$kartoteka' where galerijaSlikaID='$idGalerija'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno ažurirana galerija slika");
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
 $skripta="uGalerijaSlika.php?idGalerija={$idGalerija}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('vrijednost', array("'$kartotekaID'","'$url'"));
 $smarty->display('predlosci/uGalerijaSlika.tpl');
 
 include 'footer.php';

 ?>
