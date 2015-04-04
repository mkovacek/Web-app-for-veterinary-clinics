<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD stručan");
    $upitStrucan="SELECT * from strucan";
    if($podaciStrucan=$baza->selectUpiti($upitStrucan)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>ID veterinara</th><th width='100'>ID tip životinje</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciStrucan->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['strucanID']."</td>";
              $ispis.="<td>".$red['korisnik_korisnikID']."</td>";
              $ispis.="<td>".$red['tipZivotinje_tipZivotinjeID']."</td>";
              $ispis.="<td><a href='rStrucan.php?idKorisnik={$red['korisnik_korisnikID']}&idTipZivotinje={$red['tipZivotinje_tipZivotinjeID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uStrucan.php?idStrucan={$red['strucanID']}&idZivotinje={$red['tipZivotinje_tipZivotinjeID']}&idKorisnik={$red['korisnik_korisnikID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dStrucan.php?idStrucan={$red['strucanID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudStrucan.tpl');
include 'footer.php'; 

?>

