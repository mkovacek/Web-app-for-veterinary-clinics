<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Brisanje zapisa tablice ambulanta");
    if (isset($_GET['idAmbulanta'])){
        $idAmbulanta=$_GET['idAmbulanta'];
        
        $upit="Delete from ambulanta where ambulantaID='$idAmbulanta'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Obrisan zapis u tablici ambulata");
          header('Location: crudAmbulanta.php');
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

