<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Brisanje zapisa tablice utvrdenabolest");
    
    if (isset($_GET['idUtvrdenaBolest'])){
        $idUtvrdenaBolest=$_GET['idUtvrdenaBolest'];
        
        $upit="Delete from utvrdenaBolest where utvrdenaBolestID='$idUtvrdenaBolest'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Obrisan zapis u tablici utvrđena bolest");
          header('Location: crudUtvrdenaBolest.php');
          exit();
        }
            
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

