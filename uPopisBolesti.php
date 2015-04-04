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
  dnevnik_zapis("Ažuriranje popisa bolesti");
   
  if (isset($_GET['idBolesti'])) {
      
      $idBolesti=$_GET['idBolesti'];
        $upit="Select * from popisBolesti where popisBolestiID=$idBolesti";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $popisBolestiID=$red['popisBolestiID'];
            $nazivBolesti=$red['popisBolestiNaziv'];
        }
      
  }else{
      $greske.="Fale podaci.<br>";
  }
  
  
  if(isset($_POST['uPopisBolesti'])){
          
         $idBolesti=$_GET['idBolesti'];
      
         if(empty($_POST['naziv'])){
          $greske.="Obavezno je napisati naziv bolesti.<br>"; 
         }else{
           $naziv = $_POST['naziv'];  
         }
         
         
         if (empty($greske)) {

            $upit = "update popisBolesti set popisBolestiNaziv='$naziv' where popisBolestiID='$idBolesti'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreiran popis bolesti");
                 header("Location: crudPopisBolesti.php");
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
 $skripta="uPopisBolesti.php?idBolesti={$idBolesti}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('vrijednost', array("'$nazivBolesti'"));
 $smarty->display('predlosci/uPopisBolesti.tpl');
 
 include 'footer.php';

 ?>
