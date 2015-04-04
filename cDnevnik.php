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
  dnevnik_zapis("Kreiranje dnevnika");

  if(isset($_POST['cDnevnik'])) {

         if(empty($_POST['korisnik'])){
          $greske.="Obavezan unos korisnika.<br>"; 
         }else{
           $korime = $_POST['korisnik'];  
         }
         
         if(empty($_POST['adresa'])){
          $greske.="Obavezan unos url adrese.<br>"; 
         }else{
           $adresa = $_POST['adresa'];  
         }
         
         if(empty($_POST['skripta'])){
          $greske.="Obavezan unos skripte.<br>"; 
         }else{
           $skripta = $_POST['skripta'];  
         }
         
         if(empty($_POST['tekst'])){
          $greske.="Obavezan unos tekst.<br>"; 
         }else{
           $tekst = $_POST['tekst'];  
         }
         
         if(empty($_POST['datime'])){
          $greske.="Obavezan unos datuma.<br>"; 
         }else{
           $datime = $_POST['datime'];  
         }
         
         if (empty($greske)) {

            $upit = "insert into dnevnik (korisnik,adresa,skripta,tekst,vrijeme) values ('$korime','$adresa','$skripta','$tekst','$datime')";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreiran dnevnik");
                 header("Location: crudDnevnik.php");
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
 $skripta="cDnevnik.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/cDnevnik.tpl');
 
 include 'footer.php';

 ?>
