<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    
    if (isset($_GET['idKorisnik'])){
        $idKorisnik=$_GET['idKorisnik'];
        
        $upit="Update korisnik set status=3,brojPokusaja=3 where korisnikID='$idKorisnik'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Blokiran korisnički račun");
          header('Location: otkljucavanje.php');
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


