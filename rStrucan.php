<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice stručan");
    
    if (isset($_GET['idKorisnik']) && isset($_GET['idTipZivotinje']) ){
        $korisnik=$_GET['idKorisnik'];
        $idTipZivotinje=$_GET['idTipZivotinje'];
        $upitKorisnik="Select korisnikIme,korisnikaPrezime,tipZivotinjeNaziv from korisnik,strucan,tipZivotinje
                       where korisnikID=$korisnik and tipZivotinjeID=$idTipZivotinje and
                       korisnikID=korisnik_korisnikID  and tipZivotinjeID=tipZivotinje_tipZivotinjeID";
        if($podaciKorisnik = $baza->selectUpiti($upitKorisnik)){
            $redKorisnik = $podaciKorisnik->fetch_array();
            $veterinar=$redKorisnik['korisnikIme'].' '.$redKorisnik['korisnikaPrezime'];
            $tipZivotinje=$redKorisnik['tipZivotinjeNaziv']; 
        }else{
             $greske.="Greska pri radu s bazom podataka. <br>";
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
   
    include 'headerLogIn.php' ; 
   
    $smarty->assign('vrijednost', array("'$tipZivotinje'","'$veterinar'"));
    $smarty->display('predlosci/rStrucan.tpl');
    
    include 'footer.php' 
?>

