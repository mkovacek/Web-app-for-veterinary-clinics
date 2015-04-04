<?php
include_once('aplikacijskiOkvir.php'); 
include_once('vrijeme.php');
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Naplaćen račun");
    $veterinarID=$korisnik->get_id();
    $veterinarNaziv=$korisnik->get_ime_prezime();

    if (isset($_GET['idKartotekaDetalji'])){
        $detaljKartotekeID=$_GET['idKartotekaDetalji'];
    }
    if (isset($_GET['idKartoteka'])){
        $idKartoteka=$_GET['idKartoteka'];
    }
    if (isset($_GET['terapijaOpis'])){
        $terapijaOpis=$_GET['terapijaOpis'];
    }
    if (isset($_GET['terapijaCijena'])){
        $terapijaCijena=$_GET['terapijaCijena'];
    }
    $dohvatiVlasnikID="SELECT korisnikID FROM korisnik, zivotinja, kartoteka
                      WHERE kartotekaID ='$idKartoteka' AND zivotinja_zivotinjaID = zivotinjaID AND korisnikID = korisnik_korisnikID";
    if($podaci=$baza->selectUpiti($dohvatiVlasnikID)){
        $red=$podaci->fetch_array();
        $idVlasnika=$red['korisnikID'];
    }else{
        $greske.="Greska pri radu s bazom podataka.<br>";
    }
    #$datumVrijemeIzdavanja=date("Y-m-d H:i:s");
    $virtVrijeme = virtualnoVrijeme();
    $datumVrijemeIzdavanja=date('Y-m-d H:i:s',$virtVrijeme);
    $pohraniRacun="Insert into racun(racunDatumVrijeme,korisnik_klijentID,korisnik_veterinarID,kartotekaDetalji_kartotekaDetaljiID)
                   values('$datumVrijemeIzdavanja','$idVlasnika','$veterinarID','$detaljKartotekeID')";
    if(!$baza->ostaliUpiti($pohraniRacun)){
        $greske.="Greska pri radu s bazom podataka.<br>";
    }
    $promjenaStatusRacun="Update kartotekaDetalji set statusRacun=1 where kartotekaDetaljiID=$detaljKartotekeID";
    if(!$baza->ostaliUpiti($promjenaStatusRacun)){
        $greske.="Greska pri radu s bazom podataka.<br>";
    }
    
    if(!empty($greske)){
        header("Location: greske.php?e=2");
        exit();
    }
}else{
    header("Location: greske.php?e=2");
    exit();
}

include 'headerLogIn.php';

$smarty->assign('veterinarNaziv', $veterinarNaziv);
$smarty->assign('terapijaOpis', $terapijaOpis);
$smarty->assign('terapijaCijena', $terapijaCijena);
$smarty->assign('datumVrijemeIzdavanja', $datumVrijemeIzdavanja);
$smarty->display('predlosci/naplatiRacun.tpl');

include 'footer.php'; 

?>
