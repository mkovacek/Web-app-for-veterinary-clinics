<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD termini");
    $upitStrucan="SELECT * from termin";
    if($podaciStrucan=$baza->selectUpiti($upitStrucan)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>Datum i vrijeme</th><th width='100'>ID kartoteke</th><th width='100'>Status</th><th width='100'>Veterinar</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciStrucan->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['terminID']."</td>";
              $ispis.="<td>".$red['terminDatumVrijeme']."</td>";
              $ispis.="<td>".$red['kartoteka_kartotekaID']."</td>";
              $ispis.="<td>".$red['status']."</td>";
              $ispis.="<td>".$red['veterinar']."</td>";
              $ispis.="<td><a href='rTermini.php?idTermin={$red['terminID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uTermini.php?idTermin={$red['terminID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dTermini.php?idTermin={$red['terminID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudTermini.tpl');
include 'footer.php'; 

?>

