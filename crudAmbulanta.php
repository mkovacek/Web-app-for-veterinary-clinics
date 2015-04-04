<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD Ambulanta");
    $upitAmbulanta="SELECT * from ambulanta";
    if($podaciAmbulanta=$baza->selectUpiti($upitAmbulanta)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='50'>ID</th><th width='100'>Naziv</th><th width='100'>Adresa</th><th width='100'>Grad</th><th width='100'>Telefon</th><th width='100'>Radno vrijeme</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciAmbulanta->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['ambulantaID']."</td>";
              $ispis.="<td>".$red['ambulantaNaziv']."</td>";
              $ispis.="<td>".$red['ambulantaAdresa']."</td>";
              $ispis.="<td>".$red['ambulantaGrad']."</td>";
              $ispis.="<td>".$red['ambulantaTelefon']."</td>";
              $ispis.="<td>".$red['ambulantaRadnoVrijeme']."</td>";
              $ispis.="<td><a href='rAmbulanta.php?idAmbulanta={$red['ambulantaID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uAmbulanta.php?idAmbulanta={$red['ambulantaID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dAmbulanta.php?idAmbulanta={$red['ambulantaID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudAmbulanta.tpl');
include 'footer.php'; 

?>

