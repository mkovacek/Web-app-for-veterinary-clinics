<?php
include_once('aplikacijskiOkvir.php'); 
include_once('vrijeme.php');
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Dodaj kartoteku");
    $idKorisnika=$korisnik->get_id();
    $ambulanta=$korisnik->get_ambulanta();
    $upit="SELECT zivotinjaID, zivotinjaIme,tipZivotinjeNaziv, korisnikIme, korisnikaPrezime
           FROM zivotinja, korisnik, tipZivotinje, strucan
           WHERE korisnik.ambulanta_ambulantaID = '$ambulanta'
           AND korisnikID = zivotinja.korisnik_korisnikID
           AND zivotinja.tipZivotinje_tipZivotinjeID = tipZivotinjeID
           AND tipZivotinjeID = strucan.tipZivotinje_tipZivotinjeID
           AND strucan.korisnik_korisnikID = '$idKorisnika'
           AND zivotinjaID NOT IN (SELECT zivotinja_zivotinjaID FROM kartoteka)";
    if($podaci=$baza->selectUpiti($upit)){
        while($red=$podaci->fetch_array()){
          $ispis.="<option value='{$red['zivotinjaID']}'>{$red['zivotinjaIme']} | {$red['tipZivotinjeNaziv']} | {$red['korisnikIme']} | {$red['korisnikaPrezime']}</option>";  
        }   
    }else{
        $greske.="Greška pri radu s bazom podataka. <br>";
    }
    
    if (isset($_POST['dodajKartoteku'])){
        $virtVrijeme = virtualnoVrijeme();
        $virtualnoVrijeme=date('Y-m-d H:i:s',$virtVrijeme);
        $idAmbulante=$_GET['idAmb'];
        if(empty($_POST['naziv'])){
        $greske.="Unos naziva je obavezan.<br>";
        }else{
          $naziv = $_POST['naziv']; 
        } 
        if (empty($greske)) {
           $upitInsert="Insert into kartoteka(zivotinja_zivotinjaID,kartotekaDatumVrijemeKreiranja,ambulanta_ambulantaID) values ('$naziv', '$virtualnoVrijeme','$idAmbulante')";
           if( !$baza->ostaliUpiti($upitInsert)){
                $greske.="Greška kod rada sa bazom.<br>";
           }else{
                dnevnik_zapis("Dodana kartoteka");
                header('Location: kartoteke.php');
           } 
        }          
    }

    if (!empty($greske)){   
        header('Location: greske.php?kod='.$greske);
        exit();
     } 
}else{
   header("Location: greske.php?e=2");
   exit();  
}
include 'headerLogIn.php' ; 
$skripta="dodajKartoteku.php?idAmb=".$ambulanta;
$smarty->assign('skripta', $skripta);
$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/dodajKartoteku.tpl');
include 'footer.php'

?>
