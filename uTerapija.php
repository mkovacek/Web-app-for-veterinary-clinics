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
  dnevnik_zapis("Ažuriranje terapije");
  
  if (isset($_GET['idTerapija'])) {
      
        $idTerapija=$_GET['idTerapija'];
        $upit="Select * from terapija where terapijaID=$idTerapija";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $terapijaID=$red['terapijaID'];
            $terapijaOpis=$red['terapijaOpis'];
            $terapijaCijena=$red['terapijaCijena'];
            $kartDetaljiID=$red['kartotekaDetalji_kartotekaDetaljiID'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
  }else{
      $greske.="Fale podaci.<br>"; 
  }
  
  
  if(isset($_POST['uTerapija'])) {
         
         $idTerapija=$_GET['idTerapija'];  
    
         if(empty($_POST['kartoteka'])){
          $greske.="Obavezno je odabrati kartoteku.<br>"; 
         }else{
           $kartoteka = $_POST['kartoteka'];  
         }
         
         if(empty($_POST['terapija'])){
          $greske.="Obavezno je napisati terapiju.<br>"; 
         }else{
           $terapija = $_POST['terapija'];  
         }
         
         if(empty($_POST['cijena'])){
          $greske.="Obavezno je napisati terapiju.<br>"; 
         }else{
           $cijena = $_POST['cijena'];  
         }
         
         if (empty($greske)) {

            $upit = "update terapija set terapijaOpis='$terapija',terapijaCijena='$cijena',kartotekaDetalji_kartotekaDetaljiID='$kartoteka' where terapijaID='$idTerapija'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno ažurirana terapija");
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
 $skripta="uTerapija.php?idTerapija={$idTerapija}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('vrijednost', array("'$terapijaOpis'","'$terapijaCijena'","'$kartDetaljiID'"));
 $smarty->display('predlosci/uTerapija.tpl');
 
 include 'footer.php';

 ?>
