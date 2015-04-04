<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Pregled galerije slika životinje");
    if (isset($_GET['idKartoteka'])){
       $idKartoteka=($_GET['idKartoteka']);
    }

    $upitSlike="Select galerijaSlikaUrl from galerijaSlika where kartoteka_kartotekaID=$idKartoteka";    
    if($podaciSlike=$baza->selectUpiti($upitSlike)){
       while($red = $podaciSlike->fetch_array()){
           $ispis.="<li><a href=".$red['galerijaSlikaUrl']."><img src=".$red['galerijaSlikaUrl']."></a></li>";
       }
    }else{
        $greske.="Greska pri radu s bazom podataka. <br>";
    }
    if (!empty($greske)){   
        header('Location: greske.php?kod='.$greske);
        exit();
    }
}else{
    header("Location: greske.php?e=2");
    exit();
}


include 'headerLogIn.php';

$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/slike.tpl');

include 'footer.php'; 

?>



