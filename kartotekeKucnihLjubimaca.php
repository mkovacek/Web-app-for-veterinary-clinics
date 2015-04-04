<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==3){
    dnevnik_zapis("Pregled kartoteka kućnih ljubimaca");
    $idKorisnika=$korisnik->get_id();
    $upitKreiraneKartoteke="SELECT kartotekaID, zivotinjaIme, zivotinjaStarost, tipZivotinjeNaziv
                            FROM kartoteka, zivotinja, tipZivotinje, korisnik
                            WHERE korisnikID=$idKorisnika
                            AND korisnikID=korisnik_korisnikID
                            AND zivotinjaID=zivotinja_zivotinjaID
                            AND tipZivotinjeID=tipZivotinje_tipZivotinjeID";
    if($podaciKreiraneKartoteke=$baza->selectUpiti($upitKreiraneKartoteke)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>Broj</th><th width='100'>Naziv životinje</th><th width='100'>Vrsta životinje</th><th width='100'>Starost</th><th width='100'>Povijest bolesti</th></tr></thead><tbody>";
            while($red = $podaciKreiraneKartoteke->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['kartotekaID']."</td>";
              $ispis.="<td>".$red['zivotinjaIme']."</td>";
              $ispis.="<td>".$red['tipZivotinjeNaziv']."</td>";
              $ispis.="<td>".$red['zivotinjaStarost']."</td>";
              $ispis.="<td><a href='proslostLijecenja.php?idKartoteka={$red['kartotekaID']}'>Pregled</a></td>";
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
$smarty->display('predlosci/kartotekeKucnihLjubimaca.tpl');

include 'footer.php'; 

?>



