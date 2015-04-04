<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD kartoteka detalji");
    $upitDetalji="SELECT * from kartotekaDetalji";
    if($podaciDetalji=$baza->selectUpiti($upitDetalji)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>ID kartoteke</th><th width='100'>Datum i vrijeme pregleda</th><th width='100'>Status dovršenosti</th><th width='100'>Status računa</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciDetalji->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['kartotekaDetaljiID']."</td>";
              $ispis.="<td>".$red['kartotekaID']."</td>";
              $ispis.="<td>".$red['datumVrijemePregleda']."</td>";
              $ispis.="<td>".$red['status']."</td>";
              $ispis.="<td>".$red['statusRacun']."</td>";
              $ispis.="<td><a href='rKartotekaDetalji.php?idDetalji={$red['kartotekaDetaljiID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uKartotekaDetalji.php?idDetalji={$red['kartotekaDetaljiID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dKartotekaDetalji.php?idDetalji={$red['kartotekaDetaljiID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudKartotekaDetalji.tpl');
include 'footer.php'; 

?>

