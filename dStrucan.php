<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Brisanje zapisa u tablici tip stručan");
    if (isset($_GET['idStrucan'])){
        $idStrucan=$_GET['idStrucan'];
        
        $upit="Delete from strucan where strucanID='$idStrucan'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Obrisan zapis u tablici stručan");
          header('Location: crudStrucan.php');
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

