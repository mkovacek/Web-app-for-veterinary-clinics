<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Pregled povijesti bolesti");
    if (isset($_GET['idKartoteka'])){
        $idKartoteka=$_GET['idKartoteka'];
        $upitPovijestBolesti="SELECT kartotekaDetaljiID, datumVrijemePregleda, simptomOpis, popisBolestiNaziv, terapijaOpis, terapijaCijena
                             FROM kartotekaDetalji, simptom, utvrdenaBolest, popisBolesti, terapija
                             WHERE kartotekaID ='$idKartoteka' AND STATUS =1
                             AND kartotekaDetaljiID = simptom.kartotekaDetalji_kartotekaDetaljiID
                             AND kartotekaDetaljiID = terapija.kartotekaDetalji_kartotekaDetaljiID
                             AND kartotekaDetaljiID = utvrdenaBolest.kartotekaDetalji_kartotekaDetaljiID
                             AND popisBolesti_popisBolestiID = popisBolestiID";
        
        if($podaciPovijestBolesti=$baza->selectUpiti($upitPovijestBolesti)){ #makni iznos racuna
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='50'>Broj</th><th width='100'>Datum i vrijeme pregleda</th><th width='100'>Opis simptoma</th><th width='100'>Utvrđena bolest</th><th width='100'>Primjenjena terapija</th><th width='50'>Iznos računa</th></tr></thead><tbody>";
            while($red = $podaciPovijestBolesti->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['kartotekaDetaljiID']."</td>";
              $ispis.="<td>".$red['datumVrijemePregleda']."</td>";
              $ispis.="<td>".$red['simptomOpis']."</td>";
              $ispis.="<td>".$red['popisBolestiNaziv']."</td>";
              $ispis.="<td>".$red['terapijaOpis']."</td>";
              $ispis.="<td>".$red['terapijaCijena']."</td>";
              #$ispis.="<td><a href='unosZapisaKartoteka.php?idKartoteka={$red['kartotekaID']}'>Unos</a></td>";
              $ispis.='</tr>';
            }
            $ispis.="</tbody></table>";
        }else{
        $greske.="Greska pri radu s bazom podataka. <br>";
        }
        if (!empty($greske)){   
            header('Location: greske.php?kod='.$greske);
            exit();
        }
    }
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

include 'headerLogIn.php';

$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/povijestBolesti.tpl');

include 'footer.php'; 

?>