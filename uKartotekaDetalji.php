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
  dnevnik_zapis("Ažuriranje detalja kartoteke");

  if (isset($_GET['idDetalji'])) {
        $idDetalji=$_GET['idDetalji'];
        $upit="Select * from kartotekaDetalji where kartotekaDetaljiID=$idDetalji";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $kartotekaID=$red['kartotekaID'];
            $datetimeID=$red['datumVrijemePregleda'];
            $statusID=$red['status'];
            $statusRID=$red['statusRacun'];
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

  }else{
      $greske.="Fale podaci. <br>"; 
  }  

  if(isset($_POST['uKartotekaDetalji'])) {
         
         $idDetalji=$_GET['idDetalji'];
         
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

            $upit = "update kartotekaDetalji set kartotekaID='$kartoteka',datumVrijemePregleda='$datetime',status='$status',statusRacun='$statusR' where kartotekaDetaljiID='$idDetalji'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno ažuriran detalj kartoteke");
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
 $skripta="uKartotekaDetalji.php?idDetalji={$idDetalji}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('vrijednost', array("'$kartotekaID'","'$datetimeID'","'$statusID'","'$statusRID'"));
 $smarty->display('predlosci/uKartotekaDetalji.tpl');
 
 include 'footer.php';

 ?>
