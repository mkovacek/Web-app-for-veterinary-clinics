<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD Tip korisnika");
    $upitTipKorisnika="SELECT * from tipKorisnika";
    if($podaciTipKorisnika=$baza->selectUpiti($upitTipKorisnika)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID korisnika</th><th width='100'>Tip korisnika</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciTipKorisnika->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['tipKorisnikaID']."</td>";
              $ispis.="<td>".$red['tipKorisnikaNaziv']."</td>";
              $ispis.="<td><a href='rTipKorisnika.php?idTipKorisnika={$red['tipKorisnikaID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uTipKorisnika.php?idTipKorisnika={$red['tipKorisnikaID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dTipKorisnika.php?idTipKorisnika={$red['tipKorisnikaID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudTipKorisnika.tpl');
include 'footer.php'; 

?>

