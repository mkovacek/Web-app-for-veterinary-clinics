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
  dnevnik_zapis("Ažuriranje utvrđene bolesti");
  
  if (isset($_GET['idUtvrdenaBolest'])) {
      
        $idUtvrdenaBolest=$_GET['idUtvrdenaBolest'];
        $upit="Select popisBolestiID,popisBolestiNaziv,kartotekaDetalji_kartotekaDetaljiID,veterinar from utvrdenaBolest,popisBolesti where utvrdenaBolestID=$idUtvrdenaBolest and popisBolestiID=popisBolesti_popisBolestiID";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $popisBolestiID=$red['popisBolestiID'];
            $popisBolestiNaziv=$red['popisBolestiNaziv'];
            $idKartoteka=$red['kartotekaDetalji_kartotekaDetaljiID'];
            $vet=$red['veterinar'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
        
        $upitDetalji2="SELECT * from popisBolesti";
  
        if($podaciDetalji2= $baza->selectUpiti($upitDetalji2)){
            while($redDetalji2 = $podaciDetalji2->fetch_array()){
               $ispis2.="<option value='{$redDetalji2['popisBolestiID']}'>{$redDetalji2['popisBolestiNaziv']}</option>";   
            }
        }else{
           $greske.="Greska pri radu s bazom podataka. <br>"; 
        }   
  }else{
      $greske.="Fale podaci.<br>"; 
  }

  if(isset($_POST['uUtvrdenaBolest'])) {
   
         $idUtvrdenaBolest=$_GET['idUtvrdenaBolest'];
         
         
         
         if(empty($_POST['bolest'])){
          $greske.="Obavezno je odabrati bolest.<br>"; 
         }else{
           $bolest = $_POST['bolest'];  
         }
         
         if (empty($greske)) {

            $upit = "update utvrdenaBolest set popisBolesti_popisBolestiID='$bolest' where utvrdenaBolestID='$idUtvrdenaBolest'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreirana utvrđena bolest");
                 header("Location: crudUtvrdenaBolest.php");
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
 $skripta="uUtvrdenaBolest.php?idUtvrdenaBolest={$idUtvrdenaBolest}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis2', $ispis2);
 $smarty->assign('vrijednost', array("'$popisBolestiID'","'$popisBolestiNaziv'","'$idKartoteka'","'$vet'"));
 $smarty->display('predlosci/uUtvrdenaBolest.tpl');
 
 include 'footer.php';

 ?>
