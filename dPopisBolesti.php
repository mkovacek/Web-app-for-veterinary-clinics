<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Brisanje zapisa tablice popis bolesti");
    
    if (isset($_GET['idBolesti'])){
        $idBolesti=$_GET['idBolesti'];
        
        $upit="Delete from popisBolesti where popisBolestiID='$idBolesti'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Obrisan zapis u tablici popis bolesti");
          header('Location: crudPopisBolesti.php');
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

