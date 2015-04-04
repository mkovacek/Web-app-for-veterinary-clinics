<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Kreiranje ambulanti");
  if(isset($_POST['kreiranjeAmbulanti'])) {  
    if(empty($_POST['naziv'])){
      $greske.="Unos naziva je obavezan.<br>"; 
    }else{
      $naziv = $_POST['naziv'];  
      if (ucfirst($naziv) != $naziv){ 
        $naziv=ucfirst($naziv); 
      }
    } 

    if(empty($_POST['adresa'])){
      $greske.="Unos adrese je obavezan.<br>";
    }else{
      $k_adresa = $_POST['adresa']; 
    } 
    
    if(empty ($_POST['grad'])){
       $greske.="Unos grada je obavezan.<br>";
    }else{
       $k_grad = $_POST['grad']; 
    } 

    if(empty($_POST['telefon'])){
        $greske.="Unos broja telefona je obavezan.<br>";
    }else{
        $k_telefon = $_POST['telefon'];  
    }
    
    if(empty($_POST['radnoVrijeme'])){
        $greske.="Unos radnog vremena je obavezno.<br>";
    }else{
        $radVrijeme = $_POST['radnoVrijeme'];  
    }

    if (!empty($greske)){   
    header('Location: greske.php?kod='.$greske);
    exit();
    }

     if (empty($greske)) {
      $upit = "insert into ambulanta(ambulantaNaziv,ambulantaAdresa,ambulantaGrad,ambulantaTelefon,ambulantaRadnoVrijeme) values ('$naziv','$k_adresa','$k_grad','$k_telefon','$radVrijeme')";
      if (!$baza->ostaliUpiti($upit)){
          $greske.="Greska pri radu s bazom podataka. <br>";
          $baza->error;
          echo phpinfo();
      }else{
         dnevnik_zapis("Uspješno kreirana ambulanta");
         $pom=1;
      }
      
   }   
}
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $skripta="kreiranjeAmbulanti.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/kreiranjeAmbulanti.tpl');
 
 include 'footer.php';

 if($pom==1){
    echo '<script language="javascript">';
    echo 'alert("Kreirali ste novu ambulantu")';
    echo '</script>';
    $pom=0;
 }
 ?>