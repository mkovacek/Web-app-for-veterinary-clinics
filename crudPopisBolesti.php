<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD simptomi ");
    $upitDetalji="SELECT * from popisBolesti";
    if($podaciDetalji=$baza->selectUpiti($upitDetalji)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>Naziv</th><th width='100'>Pročitaj</th><th width='100'>Ažuriraj</th><th width='100'>Obriši</th></tr></thead><tbody>";
            while($red = $podaciDetalji->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['popisBolestiID']."</td>";
              $ispis.="<td>".$red['popisBolestiNaziv']."</td>";
              $ispis.="<td><a href='rPopisBolesti.php?idBolesti={$red['popisBolestiID']}'>Pročitaj</a></td>";
              $ispis.="<td><a href='uPopisBolesti.php?idBolesti={$red['popisBolestiID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dPopisBolesti.php?idBolesti={$red['popisBolestiID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudPopisBolesti.tpl');
include 'footer.php'; 

?>

