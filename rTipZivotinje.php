<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice tip životinja");
    if (isset($_GET['tipZivotinjeNaziv'])){
        $tipZivotinjeNaziv=$_GET['tipZivotinjeNaziv'];            
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
   
    include 'headerLogIn.php' ; 
    
    $smarty->assign('tipZivotinjeNaziv', $tipZivotinjeNaziv);
    $smarty->display('predlosci/rTipZivotinje.tpl');
    
    include 'footer.php' 
?>

