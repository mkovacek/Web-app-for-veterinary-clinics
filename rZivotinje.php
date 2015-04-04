<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice životinje");
    if (isset($_GET['idZivotinje'])){
        $idZivotinje=$_GET['idZivotinje'];
        $upit="SELECT zivotinjaIme,zivotinjaStarost,korisnikIme,korisnikaPrezime,tipZivotinjeNaziv
               FROM zivotinja,korisnik,tipZivotinje WHERE zivotinjaID='$idZivotinje' and korisnikID=korisnik_korisnikID
               AND tipZivotinjeID=tipZivotinje_tipZivotinjeID ";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $naziv=$red['zivotinjaIme'];
            $starost=$red['zivotinjaStarost'];
            $zivotinja=$red['tipZivotinjeNaziv'];
            $imeprezime=$red['korisnikIme'].' '.$red['korisnikaPrezime'];
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
    
    $smarty->assign('vrijednost', array("'$naziv'","'$starost'","'$zivotinja'","'$imeprezime'"));
    $smarty->display('predlosci/rZivotinje.tpl');
    
    include 'footer.php' 
?>

