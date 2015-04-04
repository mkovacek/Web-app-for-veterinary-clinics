<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD kartoteka");
    $upitStrucan="SELECT * from kartoteka";
    if($podaciStrucan=$baza->selectUpiti($upitStrucan)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>ID životinje</th><th width='100'>Datum i vrijeme kreiranja</th><th width='100'>ID ambulante</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciStrucan->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['kartotekaID']."</td>";
              $ispis.="<td>".$red['zivotinja_zivotinjaID']."</td>";
              $ispis.="<td>".$red['kartotekaDatumVrijemeKreiranja']."</td>";
              $ispis.="<td>".$red['ambulanta_ambulantaID']."</td>";
              $ispis.="<td><a href='rKartoteka.php?idKartoteke={$red['kartotekaID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uKartoteka.php?idKartoteke={$red['kartotekaID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dKartoteka.php?idKartoteke={$red['kartotekaID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudKartoteka.tpl');
include 'footer.php'; 

?>

