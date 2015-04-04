<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("CRUD korisnici");
    $upitKorisnik="SELECT * from korisnik";
    if($podaciKorisnik=$baza->selectUpiti($upitKorisnik)){
            $ispis="<table class='veterinariAmbulanta'><thead><tr><th>ID</th><th>Ime</th><th>Prezime</th><th>Korisničko ime</th><th>Lozinka</th><th>Adresa</th><th>Grad</th><th>Email</th><th>Telefon</th><th>ID ambulante</th><th>ID tip korisnika</th><th>Datum registracije</th><th>Status</th><th>Broj pokušaja</th><th>Pročitaj</th><th>Ažuriraj</th><th>Obriši</th></tr></thead><tbody>";
            while($red = $podaciKorisnik->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['korisnikID']."</td>";
              $ispis.="<td>".$red['korisnikIme']."</td>";
              $ispis.="<td>".$red['korisnikaPrezime']."</td>";
              $ispis.="<td>".$red['korisnikKIme']."</td>";
              $ispis.="<td>".$red['korisnikaLozinka']."</td>";
              $ispis.="<td>".$red['korisnikAdresa']."</td>";
              $ispis.="<td>".$red['korisnikGrad']."</td>";
              $ispis.="<td>".$red['korisnikEmail']."</td>";
              $ispis.="<td>".$red['korisnikTelefon']."</td>";
              $ispis.="<td>".$red['ambulanta_ambulantaID']."</td>";
              $ispis.="<td>".$red['tipKorisnika_tipKorisnikaID']."</td>";
              $ispis.="<td>".$red['datumPristupanja']."</td>";
              $ispis.="<td>".$red['status']."</td>";
              $ispis.="<td>".$red['brojPokusaja']."</td>";
              $ispis.="<td><a href='rKorisnik.php?idKorisnik={$red['korisnikID']}&idTipKorisnika={$red['tipKorisnika_tipKorisnikaID']}&idAmbulanta={$red['ambulanta_ambulantaID']}'>Pročitaj</a></td>";#ostali ID
              $ispis.="<td><a href='uKorisnik.php?idKorisnik={$red['korisnikID']}&idTipKorisnika={$red['tipKorisnika_tipKorisnikaID']}&idAmbulanta={$red['ambulanta_ambulantaID']}'>Ažuriraj</a></td>";
              $ispis.="<td><a href='dKorisnik.php?idKorisnik={$red['korisnikID']}'>Obriši</a></td>";
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
$smarty->display('predlosci/crudKorisnik.tpl');
include 'footer.php'; 

?>

