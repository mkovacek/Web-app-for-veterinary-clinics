<?php
include 'aplikacijskiOkvir.php';
$baza=new Baza();
dnevnik_zapis("Početna stranica");
//$upit="SELECT ambulanta.ambulantaID,ambulanta.ambulantaNaziv,ambulanta.ambulantaAdresa,ambulanta.ambulantaGrad,ambulanta.ambulantaTelefon,ambulanta.ambulantaRadnoVrijeme,korisnik.korisnikIme,korisnik.korisnikaPrezime from ambulanta left outer join korisnik on ambulanta.ambulantaID=korisnik.ambulanta_ambulantaID";
$upit="SELECT * from ambulanta";

$podaci=$baza->selectUpiti($upit);
$slikeAmbulante=array("Koprivnica"=>"img/kc.jpg","Varaždin"=>"img/vz.jpg","Križevci"=>"img/kž.jpg","Ludbreg"=>"img/ludbreg.jpg","Osijek"=>"img/os.jpg","Rijeka"=>"img/ri.jpg","Zadar"=>"img/zd.jpg","Zagreb"=>"img/zg.jpg","Čakovec"=>"img/čk4.jpg", "Split"=>"img/split.jpg");
$gradovi=array();
if ($podaci){
    while($red=$podaci->fetch_array()){
            $ispis.="<div id='info{$red[ambulantaID]}' class='reveal-modal small' data-reveal>";
            $ispis.="<div class='row'>";
            $ispis.="<div class='small-12 medium-12 large-12 xlarge-12 columns'>";
            $ispis.="<form>";
            $ispis.="<label>Naziv ambulante</label><input type='text' value='$red[ambulantaNaziv]' readonly>";
            $ispis.="<label>Adresa</label><input type='text' value='$red[ambulantaAdresa] , $red[ambulantaGrad]' readonly>";
            $ispis.="<label>Telefon</label><input type='text' value='$red[ambulantaTelefon]' readonly>";
            $ispis.="<label>Radno vrijeme</label><input type='text' value='$red[ambulantaRadnoVrijeme]' readonly>";
            $ispis.="<label>Veterinari</label><input type='text' readonly value='"; #greska ako postoji ambulanta bez veterinara
            $upit="SELECT korisnikIme,korisnikaPrezime from korisnik where ambulanta_ambulantaID={$red[ambulantaID]} and tipKorisnika_tipKorisnikaID=2";
            $rez=$baza->selectUpiti($upit);
            if($rez){
                while($red2=$rez->fetch_array()){
                    $ispis.=" {$red2[korisnikIme]} {$red2[korisnikaPrezime]} ";
                }
            }
            $ispis.="'";
            $ispis.="</form>";
            $ispis.="</div></div>";
            $ispis.="<a class='close-reveal-modal' href='#'>x</a>";
            $ispis.="</div>";
            $ispisGrid.="<li><img src={$slikeAmbulante["{$red[ambulantaGrad]}"]} alt='slika{$red[ambulantaID]}' /><a href='#' class='button expand' data-reveal-id='info{$red[ambulantaID]}'>{$red[ambulantaNaziv]}</a></li>"; 
    
    }
    $ispisGrid.="</ul>";
}else{
    $greske.="Greska pri radu s bazom podataka. <br>";
}

if (!empty($greske)){   
    header('Location: error.php?kod='.$greske);
    exit();
}


include 'header.php';

$smarty->assign('ispis', $ispis);
$smarty->assign('ispisGrid', $ispisGrid);
$smarty->display('predlosci/index.tpl');

include 'footer.php' 
?>



