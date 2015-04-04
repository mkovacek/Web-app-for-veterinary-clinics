<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Brisanje zapisa u tablici tip životinje");
    if (isset($_GET['idTipZivotinje'])){
        $idTipZivotinje=$_GET['idTipZivotinje'];
        
        $upit="Delete from tipZivotinje where tipZivotinjeID='$idTipZivotinje'";
        if(!$baza->ostaliUpiti($upit)){
            $greske.="Greška kod rada sa bazom.<br>"; 
        }else{
          dnevnik_zapis("Obrisan zapis u tablici tip korisnika");
          header('Location: crudTipZivotinje.php');
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

