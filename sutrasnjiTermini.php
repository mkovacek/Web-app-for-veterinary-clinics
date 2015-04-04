<?php
include_once('aplikacijskiOkvir.php'); 
include_once('vrijeme.php');
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispisEmail="";
$email=array();
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Sutrašnji termini");
    $virtVrijeme = virtualnoVrijeme();
    $virtualnoVrijeme=date('Y-m-d',$virtVrijeme);
    $date=new DateTime($virtualnoVrijeme);
    $date->modify('+1 day');
    $date=$date->format('Y-m-d');
    
    $upitSutrasnjiTermini="SELECT DATE(terminDatumVrijeme)AS datum,TIME(terminDatumVrijeme) as vrijeme,korisnikIme,korisnikaPrezime,korisnikEmail,zivotinjaIme
                            FROM termin, kartoteka, zivotinja, korisnik
                            WHERE DATE( terminDatumVrijeme ) ='$date'
                            AND termin.STATUS =1
                            AND kartotekaID = kartoteka_kartotekaID
                            AND zivotinjaID = zivotinja_zivotinjaID
                            AND korisnikID = korisnik_korisnikID";
    
    if($podaciKreiraneKartoteke=$baza->selectUpiti($upitSutrasnjiTermini)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>Datum</th><th width='100'>Vrijeme</th><th width='100'>Ime vlasnika</th><th width='100'>Prezime vlasnika</th><th width='100'>Naziv životinje</th><th width='100'>Email</th><th width='100'>Obavijest</th></tr></thead><tbody>";
            while($red = $podaciKreiraneKartoteke->fetch_array()){
              array_push($email,$red['korisnikEmail']);
              
              $ispis.='<tr>';
              $ispis.="<td>".$red['datum']."</td>";
              $ispis.="<td>".$red['vrijeme']."</td>";
              $ispis.="<td>".$red['korisnikIme']."</td>";
              $ispis.="<td>".$red['korisnikaPrezime']."</td>";
              $ispis.="<td>".$red['zivotinjaIme']."</td>";
              $ispis.="<td>".$red['korisnikEmail']."</td>";
              $ispis.="<td><a href='saljiObavijest.php?datum={$red['datum']}&vrijeme={$red['vrijeme']}&korIme={$red['korisnikIme']}&korPrezime={$red['korisnikaPrezime']}&zivotinja={$red['zivotinjaIme']}&email={$red['korisnikEmail']}'>Pošalji</a></td>";
              $ispis.='</tr>';
            }
            $ispis.="</tbody></table>";
    }else{
        $greske.="Greska pri radu s bazom podataka. <br>";
    }
    if (isset($_GET['ok'])){
        foreach ($email as $email) {
        $primatelj=$email; 
        $naslov="Obavijest-zakazani termin";
        $headerFields = array(
                        "From: info@ecuko.hr",
                        "MIME-Version: 1.0",
                        "Content-Type: text/html;charset=utf-8"
                         );
        $poruka="Poštovani, <br/><br/> Ovim putem Vas obaviještavamo da Vaš kućni ljubimac sutra ima zakazani termin. <br>Detalje termina pogledajete na sustavu.<br><br/> Vaš ečuko ";
        mail($primatelj, $naslov, $poruka,implode("\r\n",$headerFields));
        }  
        dnevnik_zapis("Svima poslani email-ovi");
        $ispisEmail.="<div class='small-12 medium-12 large-12 xlarge-12 columns'>
                <div data-alert class='alert-box success'>
                    <h3 class='text-center'>Uspješno poslani email-ovi</h3>
                    <a href='#' class='close'>&times;</a>
                </div></div>";
    }
    
}else{
    header("Location: greske.php?e=2");
    exit();
}


include 'headerLogIn.php';

$smarty->assign('ispis', $ispis);
$smarty->assign('ispisEmail', $ispisEmail);
$smarty->display('predlosci/sutrasnjiTermini.tpl');

include 'footer.php'; 

?>




