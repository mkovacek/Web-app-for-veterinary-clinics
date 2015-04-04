<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD simptomi ");
    $upitDetalji="SELECT * from simptom";
    if($podaciDetalji=$baza->selectUpiti($upitDetalji)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>Opis simptoma</th><th width='100'>ID detalja kartoteke</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciDetalji->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['simptomID']."</td>";
              $ispis.="<td>".$red['simptomOpis']."</td>";
              $ispis.="<td>".$red['kartotekaDetalji_kartotekaDetaljiID']."</td>";
              $ispis.="<td><a href='rSimptomi.php?idSimptom={$red['simptomID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uSimptomi.php?idSimptom={$red['simptomID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dSimptomi.php?idSimptom={$red['simptomID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudSimptomi.tpl');
include 'footer.php'; 

?>

