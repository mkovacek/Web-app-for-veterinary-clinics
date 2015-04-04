<?php
include_once('../aplikacijskiOkvir.php'); 
$greske="";
$baza=new Baza();
$ispis="";
require_once '../Smarty-3.1.18/libs/Smarty.class.php';
$smarty = new Smarty();


    $upitKorisnik="SELECT korisnikID, korisnikIme,korisnikaPrezime,korisnikKIme,korisnikaLozinka,tipKorisnikaNaziv from korisnik,tipKorisnika where tipKorisnikaID=tipKorisnika_tipKorisnikaID";
    if($podaciKorisnik=$baza->selectUpiti($upitKorisnik)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th width='100'>ID</th><th width='100'>Ime</th><th width='100'>Prezime</th><th width='100'>Korisničko ime</th><th width='100'>Lozinka</th><th width='100'>Tip korisnika</th></tr></thead><tbody>";
            while($red = $podaciKorisnik->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['korisnikID']."</td>";
              $ispis.="<td>".$red['korisnikIme']."</td>";
              $ispis.="<td>".$red['korisnikaPrezime']."</td>";
              $ispis.="<td>".$red['korisnikKIme']."</td>";
              $ispis.="<td>".$red['korisnikaLozinka']."</td>";
              $ispis.="<td>".$red['tipKorisnikaNaziv']."</td>";
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

$smarty->assign('ispis', $ispis);
$smarty->display('../predlosci/korisnici.tpl');

?>

