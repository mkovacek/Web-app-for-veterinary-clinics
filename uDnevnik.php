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
  
  
   if(isset($_GET['idDnevnik'])){
       $idDnevnik=$_GET['idDnevnik'];
       $upit="Select *from dnevnik where dnevnikID='$idDnevnik'";
        if($podaci=$baza->selectUpiti($upit)){
            $red=$podaci->fetch_array();
            $dnevnikID=$red['dnevnikID'];
            $kime=$red['korisnik'];
            $adresa=$red['adresa'];
            $skriptaS=$red['skripta'];
            $tekst=$red['tekst'];
            $vrijeme=$red['vrijeme'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
        }
       
       
   }else{
     $greske.="Fale podaci.<br>";   
   }  

  if(isset($_POST['uDnevnik'])) {

         $idDnevnik=$_GET['idDnevnik'];
      
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

            $upit = "update dnevnik set korisnik='$korime',adresa='$adresa',skripta='$skripta',tekst='$tekst',vrijeme='$datime' where dnevnikID='$idDnevnik'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno ažuriran dnevnik");
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
 $skripta="uDnevnik.php?idDnevnik={$idDnevnik}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('vrijednost', array("'$kime'","'$adresa'","'$skriptaS'","'$tekst'","'$vrijeme'"));
 $smarty->display('predlosci/uDnevnik.tpl');
 
 include 'footer.php';

 ?>
