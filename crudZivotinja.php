<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD životinje");
    $upitZivotinje="SELECT * from zivotinja";
    if($podaciZivotinje=$baza->selectUpiti($upitZivotinje)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='50'>ID</th><th width='100'>Ime</th><th width='50'>Starost</th><th width='50'>ID tip životinje</th><th width='50'>ID korisnik</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciZivotinje->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['zivotinjaID']."</td>";
              $ispis.="<td>".$red['zivotinjaIme']."</td>";
              $ispis.="<td>".$red['zivotinjaStarost']."</td>";
              $ispis.="<td>".$red['tipZivotinje_tipZivotinjeID']."</td>";
              $ispis.="<td>".$red['korisnik_korisnikID']."</td>";
              $ispis.="<td><a href='rZivotinje.php?idZivotinje={$red['zivotinjaID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uZivotinje.php?idZivotinje={$red['zivotinjaID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dZivotinje.php?idZivotinje={$red['zivotinjaID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudZivotinja.tpl');
include 'footer.php'; 

?>

