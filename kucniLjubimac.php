<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==3){
    dnevnik_zapis("Korisnikovi kućni ljubimci");
    $idKorisnika=$korisnik->get_id();
    $provjeraLjubimaca="Select zivotinjaID,zivotinjaIme,zivotinjaStarost,tipZivotinjeNaziv from zivotinja,tipZivotinje where tipZivotinjeID=tipZivotinje_tipZivotinjeID and korisnik_korisnikID='$idKorisnika'";

    if($podaci=$baza->selectUpiti($provjeraLjubimaca)){
        if($podaci->num_rows==0){
             $ispisNema="<p class='text-center' style='color:white; margine-top:150px;'>Nemate odabranu veterinarsku ambulantu</p>";
        }else{
            while($red=$podaci->fetch_array()){
                $ispis.="<div id='info{$red[zivotinjaID]}' class='reveal-modal small' data-reveal>";
                $ispis.="<div class='row'>";
                $ispis.="<div class='small-12 medium-12 large-12 xlarge-12 columns'>";
                $ispis.="<form>";
                $ispis.="<label>Naziv životinje</label><input type='text' value='$red[zivotinjaIme]' readonly>";
                $ispis.="<label>Vrsta životinje</label><input type='text' value='$red[tipZivotinjeNaziv]' readonly>";
                $ispis.="<label>Starost</label><input type='text' value='$red[zivotinjaStarost]' readonly>";
                $ispis.="</form></div></div>";
                $ispis.="<a class='close-reveal-modal' href='#'>x</a>";
                $ispis.="</div>";
                $ispisGrid.="<li><img src='img/dodajLjubimca.png' alt='slika{$red[zivotinjaID]}' /><a href='#' class='button expand' data-reveal-id='info{$red[zivotinjaID]}'>{$red[zivotinjaIme]}</a></li>"; 
            }
        }    
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


    include 'headerLogIn.php' ; 
    $smarty->assign('ispis', $ispis);
    $smarty->assign('ispisNema', $ispisNema);
    $smarty->assign('ispisGrid', $ispisGrid); 
    $smarty->display('predlosci/kucniLjubimac.tpl');
    include 'footer.php'
?>