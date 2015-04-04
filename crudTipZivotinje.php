<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD tip životinje");
    $upitTipZivotinje="SELECT * from tipZivotinje";
    if($podaciTipZivotinje=$baza->selectUpiti($upitTipZivotinje)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='200'>ID</th><th width='200'>Naziv</th><th width='200'>Pročitaj</th><th width='200'>Ažuriraj</th><th width='200'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciTipZivotinje->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['tipZivotinjeID']."</td>";
              $ispis.="<td>".$red['tipZivotinjeNaziv']."</td>";
              $ispis.="<td><a href='rTipZivotinje.php?tipZivotinjeNaziv={$red['tipZivotinjeNaziv']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uTipZivotinje.php?idTipZivotinje={$red['tipZivotinjeID']}&tipZivotinjeNaziv={$red['tipZivotinjeNaziv']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dTipZivotinje.php?idTipZivotinje={$red['tipZivotinjeID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudTipZivotinje.tpl');
include 'footer.php'; 

?>

