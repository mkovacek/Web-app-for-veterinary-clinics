<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice tip korisnika");
    if (isset($_GET['idTipKorisnika'])){
        $idTipKorisnika=$_GET['idTipKorisnika'];
        
        $upit="Select tipKorisnikaNaziv from tipKorisnika where tipKorisnikaID='$idTipKorisnika'";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $naziv=$red['tipKorisnikaNaziv'];
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
    
    $smarty->assign('naziv', $naziv);
    $smarty->display('predlosci/rTipKorisnika.tpl');
    
    include 'footer.php' 
?>

