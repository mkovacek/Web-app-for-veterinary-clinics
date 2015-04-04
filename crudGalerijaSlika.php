<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD galerija slika");
    $upitGalerija="SELECT * from galerijaSlika";
    if($podaciGalerija=$baza->selectUpiti($upitGalerija)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>URL putanja</th><th width='100'>ID kartoteke</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciGalerija->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['galerijaSlikaID']."</td>";
              $ispis.="<td>".$red['galerijaSlikaUrl']."</td>";
              $ispis.="<td>".$red['kartoteka_kartotekaID']."</td>";
              $ispis.="<td><a href='rGalerijaSlika.php?idGalerija={$red['galerijaSlikaID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uGalerijaSlika.php?idGalerija={$red['galerijaSlikaID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dGalerijaSlika.php?idGalerija={$red['galerijaSlikaID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudGalerijaSlika.tpl');
include 'footer.php'; 

?>

