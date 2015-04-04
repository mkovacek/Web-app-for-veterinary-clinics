<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD Dnevnik");
    $upitDnevnik="SELECT * from dnevnik";
    if($podaciDnevnik=$baza->selectUpiti($upitDnevnik)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='30'>ID</th><th width='70'>Korisnik</th><th width='100'>Adresa</th><th width='200'>Skripta</th><th width='100'>Tekst</th><th width='60'>Vrijeme</th><th width='60'>Pročitaj</th><th width='60'>Ažuriraj</th><th width='60'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciDnevnik->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['dnevnikID']."</td>";
              $ispis.="<td>".$red['korisnik']."</td>";
              $ispis.="<td>".$red['adresa']."</td>";
              $ispis.="<td>".$red['skripta']."</td>";
              $ispis.="<td>".$red['tekst']."</td>";
              $ispis.="<td>".$red['vrijeme']."</td>";
              $ispis.="<td><a href='rDnevnik.php?idDnevnik={$red['dnevnikID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uDnevnik.php?idDnevnik={$red['dnevnikID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dDnevnik.php?idDnevnik={$red['dnevnikID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudDnevnik.tpl');
include 'footer.php'; 
?>

