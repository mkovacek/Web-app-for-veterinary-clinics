<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Kreiranje tpa korisnika");
  
  if(isset($_POST['cTipKorisnika'])) {  
    if(empty($_POST['naziv'])){
      $greske.="Unos naziva je obavezan.<br>"; 
    }else{
      $naziv = $_POST['naziv'];  
      if (ucfirst($naziv) != $naziv){ 
        $naziv=ucfirst($naziv); 
      }
    } 
    
     if (empty($greske)) {
      $upit = "insert into tipKorisnika(tipKorisnikaNaziv) values ('$naziv')";
      if (!$baza->ostaliUpiti($upit)){
          $greske.="Greska pri radu s bazom podataka. <br>";
      }else{
         dnevnik_zapis("Uspješno kreiran tip korisnika");
          header('Location: crudTipKorisnika.php');
      }
      
   }   
}
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $skripta="cTipKorisnika.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/cTipKorisnika.tpl');
 
 include 'footer.php';

 ?>