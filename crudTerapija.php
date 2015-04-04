<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD simptomi ");
    $upitDetalji="SELECT * from terapija";
    if($podaciDetalji=$baza->selectUpiti($upitDetalji)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>Opis terapije</th><th width='100'>Cijena</th><th width='100'>ID detalja kartoteke</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciDetalji->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['terapijaID']."</td>";
              $ispis.="<td>".$red['terapijaOpis']."</td>";
              $ispis.="<td>".$red['terapijaCijena']."</td>";
              $ispis.="<td>".$red['kartotekaDetalji_kartotekaDetaljiID']."</td>";
              $ispis.="<td><a href='rTerapija.php?idTerapija={$red['terapijaID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uTerapija.php?idTerapija={$red['terapijaID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dTerapija.php?idTerapija={$red['terapijaID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudTerapija.tpl');
include 'footer.php'; 

?>

