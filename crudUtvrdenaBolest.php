<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD simptomi ");
    $upitDetalji="SELECT * from utvrdenaBolest";
    if($podaciDetalji=$baza->selectUpiti($upitDetalji)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>ID detalja kartoteka</th><th width='100'>ID bolesti</th><th width='100'>Veterinar</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciDetalji->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['utvrdenaBolestID']."</td>";
              $ispis.="<td>".$red['kartotekaDetalji_kartotekaDetaljiID']."</td>";
              $ispis.="<td>".$red['popisBolesti_popisBolestiID']."</td>";
              $ispis.="<td>".$red['veterinar']."</td>";
              $ispis.="<td><a href='rUtvrdenaBolest.php?idUtvrdenaBolest={$red['utvrdenaBolestID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uUtvrdenaBolest.php?idUtvrdenaBolest={$red['utvrdenaBolestID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dUtvrdenaBolest.php?idUtvrdenaBolest={$red['utvrdenaBolestID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudUtvrdenaBolest.tpl');
include 'footer.php'; 

?>

