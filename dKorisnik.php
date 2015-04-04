<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Brisanje zapisa u tablici korisnika");
    if (isset($_GET['idKorisnik'])){
        $idKorisnik=$_GET['idKorisnik'];
        
        $upit="Delete from korisnik where korisnikID='$idKorisnik'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Obrisan zapis u tablici korisnik");
          header('Location: crudKorisnik.php');
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

