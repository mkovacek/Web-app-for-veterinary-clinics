<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Brisanje zapisa u tablici kartoteka");
    if (isset($_GET['idKartoteke'])){
        $idKartoteke=$_GET['idKartoteke'];
        
        $upit="Delete from kartoteka where kartotekaID='$idKartoteke'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Obrisan zapis u tablici kartoteka");
          header('Location: crudKartoteka.php');
          exit();
        }       
    }else{
       $greske.="Greška.<br>"; 
    }    
    if (!empty($greske)){   
    header('Location: greske.php?kod='.$greske);
    exit();
    }
}else{
    header("Location: greske.php?e=2");
    exit();
}

?>

