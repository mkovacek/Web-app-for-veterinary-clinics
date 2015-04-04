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
  dnevnik_zapis("Ažuriranje simptoma");
  
  if (isset($_GET['idSimptom'])) {
      
        $idSimptom=$_GET['idSimptom'];
        $upit="Select * from simptom where simptomID=$idSimptom";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $simptomID=$red['simptomID'];
            $simptomOpis=$red['simptomOpis'];
            $kartDetaljiID=$red['kartotekaDetalji_kartotekaDetaljiID'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
  }else{
      $greske.="Fale podaci.<br>"; 
  }
  
  
  if(isset($_POST['uSimptomi'])) {
         
         $idSimptom=$_GET['idSimptom'];  
    
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

            $upit = "update simptom set simptomOpis='$simptom' ,kartotekaDetalji_kartotekaDetaljiID='$kartoteka' where simptomID='$idSimptom'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno ažuriran simptom");
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
 $skripta="uSimptomi.php?idSimptom={$idSimptom}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('vrijednost', array("'$simptomOpis'","'$kartDetaljiID'"));
 $smarty->display('predlosci/uSimptomi.tpl');
 
 include 'footer.php';

 ?>
