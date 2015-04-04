<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Odabir kartoteke za izdavanje računa");
    $idKorisnika=$korisnik->get_id();
    $ambulanta=$korisnik->get_ambulanta();
    $upitKreiraneKartoteke="SELECT kartotekaID, kartotekaDatumVrijemeKreiranja, zivotinjaIme, zivotinjaStarost, tipZivotinjeNaziv, korisnikIme, korisnikaPrezime
                            FROM kartoteka, zivotinja, tipZivotinje, strucan, korisnik
                            WHERE kartoteka.ambulanta_ambulantaID = '$ambulanta'
                            AND zivotinja_zivotinjaID = zivotinjaID
                            AND zivotinja.tipZivotinje_tipZivotinjeID = tipZivotinjeID
                            AND tipZivotinjeID = strucan.tipZivotinje_tipZivotinjeID
                            AND strucan.korisnik_korisnikID ='$idKorisnika'
                            AND zivotinja.korisnik_korisnikID = korisnikID";
    if($podaciKreiraneKartoteke=$baza->selectUpiti($upitKreiraneKartoteke)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>Broj</th><th width='100'>Datum i vrijeme kreiranja</th><th width='100'>Naziv životinje</th><th width='100'>Vrsta životinje</th><th width='100'>Starost</th><th width='100'>Ime vlasnika</th><th width='100'>Prezime vlasnika</th><th width='100'>Ne naplačeni pregledi</th></tr></thead><tbody>";
            while($red = $podaciKreiraneKartoteke->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['kartotekaID']."</td>";
              $ispis.="<td>".$red['kartotekaDatumVrijemeKreiranja']."</td>";
              $ispis.="<td>".$red['zivotinjaIme']."</td>";
              $ispis.="<td>".$red['tipZivotinjeNaziv']."</td>";
              $ispis.="<td>".$red['zivotinjaStarost']."</td>";
              $ispis.="<td>".$red['korisnikIme']."</td>";
              $ispis.="<td>".$red['korisnikaPrezime']."</td>";
              $ispis.="<td><a href='izdajRacun.php?idKartoteka={$red['kartotekaID']}'>Pogledaj</a></td>";
              $ispis.='</tr>';
            }
            $ispis.="</tbody></table>";
    }else{
        $greske.="Greska pri radu s bazom podataka. <br>";
    }
}else{
    header("Location: greske.php?e=2");
    exit();
}


include 'headerLogIn.php';

$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/racun.tpl');

include 'footer.php'; 

?>



