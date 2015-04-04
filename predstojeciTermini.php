<?php
include_once('aplikacijskiOkvir.php'); 
include_once('vrijeme.php');
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==3){
    dnevnik_zapis("Predstojeći termini");
    $virtVrijeme = virtualnoVrijeme();
    $virtualnoVrijeme=date('Y-m-d',$virtVrijeme);    
    $idKorisnika=$korisnik->get_id();
    $upitKreiraneKartoteke="SELECT zivotinjaIme, zivotinjaStarost, tipZivotinjeNaziv,terminDatumVrijeme
                            FROM kartoteka, zivotinja, tipZivotinje, korisnik,termin
                            WHERE korisnikID=$idKorisnika
                            AND korisnikID=korisnik_korisnikID
                            AND zivotinjaID=zivotinja_zivotinjaID
                            AND tipZivotinjeID=tipZivotinje_tipZivotinjeID
                            AND kartotekaID=kartoteka_kartotekaID
                            AND termin.status=1 AND DATE (terminDatumVrijeme)>='$virtualnoVrijeme'";
    
    if($podaciKreiraneKartoteke=$baza->selectUpiti($upitKreiraneKartoteke)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>Naziv životinje</th><th width='100'>Vrsta životinje</th><th width='100'>Starost</th><th width='100'>Predstojeći termin</th></tr></thead><tbody>";
            while($red = $podaciKreiraneKartoteke->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['zivotinjaIme']."</td>";
              $ispis.="<td>".$red['tipZivotinjeNaziv']."</td>";
              $ispis.="<td>".$red['zivotinjaStarost']."</td>";
              $ispis.="<td>".$red['terminDatumVrijeme']."</td>";
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
$smarty->display('predlosci/kartotekaDetalji.tpl');

include 'footer.php'; 

?>




