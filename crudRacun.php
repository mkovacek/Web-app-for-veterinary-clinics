<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD računi ");
    $upitDetalji="SELECT * from racun";
    if($podaciDetalji=$baza->selectUpiti($upitDetalji)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>Datum i vrijeme izdavanja</th><th width='100'>ID klijent</th><th width='100'>ID veterinar</th><th width='100'>ID detalja kartoteke</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciDetalji->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['racunID']."</td>";
              $ispis.="<td>".$red['racunDatumVrijeme']."</td>";
              $ispis.="<td>".$red['korisnik_klijentID']."</td>";
              $ispis.="<td>".$red['korisnik_veterinarID']."</td>";
              $ispis.="<td>".$red['kartotekaDetalji_kartotekaDetaljiID']."</td>";
              $ispis.="<td><a href='rRacun.php?idRacun={$red['racunID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uRacun.php?idRacun={$red['racunID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dRacun.php?idRacun={$red['racunID']}'>Obriši</a></td>";
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
    
}else{
    header("Location: greske.php?e=2");
    exit();
}


include 'headerLogIn.php';
$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/crudRacun.tpl');
include 'footer.php'; 

?>

