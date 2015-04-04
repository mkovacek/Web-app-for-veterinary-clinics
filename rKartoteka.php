<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice kartoteka");
    if (isset($_GET['idKartoteke'])){
       $idKartoteke=$_GET['idKartoteke'];

        $upit="SELECT zivotinjaIme,ambulantaNaziv,kartotekaDatumVrijemeKreiranja
                FROM zivotinja, korisnik,ambulanta,kartoteka
                WHERE kartotekaID='$idKartoteke'
                AND korisnikID = zivotinja.korisnik_korisnikID
                AND zivotinjaID=zivotinja_zivotinjaID
                AND kartoteka.ambulanta_ambulantaID=ambulantaID";
        
        if($podaci = $baza->selectUpiti($upit)){
           $red=$podaci->fetch_array();
           $zivotinja=$red['zivotinjaIme'];
           $vrijeme=$red['kartotekaDatumVrijemeKreiranja'];
           $ambulanta=$red['ambulantaNaziv'];
        }else{
            $greske.="Greška kod rada sa bazom.<br>";  
        }   
    }else{
        $greske.="Fale podaci.<br>"; 
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
    
    $smarty->assign('vrijednost', array("'$zivotinja'","'$vrijeme'","'$ambulanta'"));
    $smarty->display('predlosci/rKartoteka.tpl');
    
    include 'footer.php' 
?>

