<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice ambulanta");
    if (isset($_GET['idAmbulanta'])){
        $idAmbulanta=$_GET['idAmbulanta'];
        
        $upit="Select * from ambulanta where ambulantaID='$idAmbulanta'";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $naziv=$red['ambulantaNaziv'];
            $adresa=$red['ambulantaAdresa'];
            $grad=$red['ambulantaGrad'];
            $telefon=$red['ambulantaTelefon'];
            $radnoVrijeme=$red['ambulantaRadnoVrijeme'];
        }else{
          $greske.="Greška kod rada sa bazom.<br>";  
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
   
    include 'headerLogIn.php' ; 
    
    $smarty->assign('vrijednost', array("'$naziv'","'$adresa'","'$grad'","'$telefon'","'$radnoVrijeme'"));
    $smarty->display('predlosci/rAmbulanta.tpl');
    
    include 'footer.php' 
?>

