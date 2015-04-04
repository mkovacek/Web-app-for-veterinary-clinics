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
  dnevnik_zapis("Kreiranje popisa bolesti");
  
  if(isset($_POST['cPopisBolesti'])) {

         if(empty($_POST['naziv'])){
          $greske.="Obavezno je napisati naziv bolesti.<br>"; 
         }else{
           $naziv = $_POST['naziv'];  
         }
         
         
         if (empty($greske)) {

            $upit = "insert into popisBolesti (popisBolestiNaziv) values ('$naziv')";
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
 $skripta="cPopisBolesti.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/cPopisBolesti.tpl');
 
 include 'footer.php';

 ?>
