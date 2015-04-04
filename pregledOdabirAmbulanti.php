<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$margina="";

//$upit="SELECT ambulanta.ambulantaID,ambulanta.ambulantaNaziv,ambulanta.ambulantaAdresa,ambulanta.ambulantaGrad,ambulanta.ambulantaTelefon,ambulanta.ambulantaRadnoVrijeme,korisnik.korisnikIme,korisnik.korisnikaPrezime from ambulanta left outer join korisnik on ambulanta.ambulantaID=korisnik.ambulanta_ambulantaID";
if($korisnik->get_vrsta()==3){
    dnevnik_zapis("Pregled i odabir ambulante");
    $idKorisnika=$korisnik->get_id();
    $slikeAmbulante=array("Koprivnica"=>"img/kc.jpg","Varaždin"=>"img/vz.jpg","Križevci"=>"img/kž.jpg","Ludbreg"=>"img/ludbreg.jpg","Osijek"=>"img/os.jpg","Rijeka"=>"img/ri.jpg","Zadar"=>"img/zd.jpg","Zagreb"=>"img/zg.jpg","Čakovec"=>"img/čk4.jpg", "Split"=>"img/split.jpg");
    $gradovi=array();
    $ispisNema="";
    $ispisImaPodaci="";
    $ispisImaGrid="";
    #odabrana ambulanta
    $upitProvjera="SELECT * from ambulanta,korisnik where ambulanta_ambulantaID=ambulantaID and korisnikID='$idKorisnika'";
    if($podaciProvjera=$baza->selectUpiti($upitProvjera)){
        if($podaciProvjera->num_rows!=0){
            $margina="0px";
            $redProvjera=$podaciProvjera->fetch_array();
            $ispisIma.="<div class='row'><div class='small-12 medium-12 large-12 xlarge-12 columns'><span class='label' style='width: 100%; margin-top: 120px; margin-bottom: 30px'><h4 class='text-center' style='color:white'>Odabrana ambulanta</h4></span></div></div>";
            $ispisIma.="<div class='row'><div class='small-6 small-centered medium-4 medium-centered large-3 large-centered xlarge-3 columns xlarge-centered'>";
            $ispisIma.="<div id='info{$redProvjera[ambulantaID]}' class='reveal-modal small' data-reveal>";
            $ispisIma.="<div class='row'>";
            $ispisIma.="<div class='small-12 medium-12 large-12 xlarge-12 columns'>";
            $ispisIma.="<form>";
            $ispisIma.="<label>Naziv ambulante</label><input type='text' value='$redProvjera[ambulantaNaziv]' readonly>";
            $ispisIma.="<label>Adresa</label><input type='text' value='$redProvjera[ambulantaAdresa] , $redProvjera[ambulantaGrad]' readonly>";
            $ispisIma.="<label>Telefon</label><input type='text' value='$redProvjera[ambulantaTelefon]' readonly>";
            $ispisIma.="<label>Radno vrijeme</label><input type='text' value='$redProvjera[ambulantaRadnoVrijeme]' readonly>";
            $ispisIma.="<label>Veterinari</label><input type='text' readonly value='"; #greska ako postoji ambulanta bez veterinara
            $upit2="SELECT korisnikIme,korisnikaPrezime from korisnik where ambulanta_ambulantaID={$redProvjera[ambulantaID]} and tipKorisnika_tipKorisnikaID=2";
            $rez2=$baza->selectUpiti($upit2);
            if($rez2){
                while($redProvjera2=$rez2->fetch_array()){
                    $ispisIma.=" {$redProvjera2[korisnikIme]} {$redProvjera2[korisnikaPrezime]} ";
                }
            }
            $ispisIma.="'";
            $ispisIma.="</form>";
            $ispisIma.="</div></div>";
            $ispisIma.="<a class='close-reveal-modal' href='#'>x</a>";
            $ispisIma.="</div>";
            $ispisIma.="<ul class='small-block-grid-1 medium-block-grid-1 large-block-grid-1'>";
            $ispisIma.="<li><img src={$slikeAmbulante["{$redProvjera[ambulantaGrad]}"]} alt='slika{$redProvjera[ambulantaID]}' /><a href='#' class='button expand' data-reveal-id='info{$redProvjera[ambulantaID]}'>{$redProvjera[ambulantaNaziv]}</a></li></ul>";     
            $ispisIma.="</div></div>"; 
            
            #sve ambulante
            $upit="SELECT * from ambulanta";
            $podaci=$baza->selectUpiti($upit);
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
   
        }else{
            $margina="110px";
            $ispisNema.="<p class='text-center' style='color:white; margine-top:150px;'>Nemate odabranu veterinarsku ambulantu</p>";
            $upit="SELECT * from ambulanta";
            $podaci=$baza->selectUpiti($upit);
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
                $ispisOdabirLbl.="<span class='label' style='width: 100%; margin-bottom: 10px'><h4 class='text-center' style='color:white'>Odaberite ambulantu</h4></span>";
                
                $upitAmbulante="Select ambulantaID,ambulantaNaziv from ambulanta";
                if($podaciAmbulanta = $baza->selectUpiti($upitAmbulante)){
                    $ispisOdabir.="<div><select id='ambulanta' name='ambulanta'><label id='ambulanta' for='ambulanta'></label>";
                    $ispisOdabir.="<option selected='selected' disabled='disabled'>Popis ambulanti</option>";
                    while($redAmbulanta = $podaciAmbulanta->fetch_array()){
                    $ispisOdabir.="<option value='{$redAmbulanta['ambulantaID']}'>{$redAmbulanta['ambulantaNaziv']}</option>";   
                    }
                    $ispisOdabir.="</select></div> <input type='submit' id='submit' class='button expand' name='odabirAmbulante' value='Odaberi'>";  
                }  
            }else{
                $greske.="Greska pri radu s bazom podataka. <br>";
            }
        }
    }else{
       $greske.="Greska pri radu s bazom podataka. <br>";
    }
    
    if (isset($_POST['odabirAmbulante'])){
        dnevnik_zapis("Odabrana ambulanta");
        $idKorisnikaDodaj=$_GET['idKor'];
        if(isset($_POST['ambulanta'])){
            $vrsta=$_POST['ambulanta'];
            $upitProvjera="Select * from korisnik where korisnikID='$idKorisnikaDodaj' and ambulanta_ambulantaID='$vrsta'";
            if($rez=$baza->selectUpiti($upitProvjera)){
                if($rez->num_rows==0){
                   if($vrsta==0){
                      $greske.="Morate odabrati vrstu životinje.<br>";
                   }else{
                        $upitUpdate="Update korisnik set ambulanta_ambulantaID='$vrsta' where korisnikID='$idKorisnikaDodaj'";
                        if( !$baza->ostaliUpiti($upitUpdate)){
                            $greske.="Greška kod rada sa bazom.<br>";
                        }else{
                            header('Location: pregledOdabirAmbulanti.php');
                        } 
                    }   
                }
                else{
                  $greske.="Već imate odabranu ambulantu.<br>";  
                }
            }   
        }else{
            $greske.="Niste odabrali ambulantu.<br>";
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

include 'headerLogIn.php';

$skripta="pregledOdabirAmbulanti.php?idKor=".$idKorisnika;
$smarty->assign('skripta', $skripta);
$smarty->assign('ispisNema', $ispisNema);
$smarty->assign('ispisIma', $ispisIma);
$smarty->assign('ispis', $ispis);
$smarty->assign('ispisGrid', $ispisGrid);
$smarty->assign('ispisOdabirLbl', $ispisOdabirLbl);
$smarty->assign('ispisOdabir', $ispisOdabir);
$smarty->assign('margina', $margina);
$smarty->display('predlosci/pregledOdabirAmbulanti.tpl');

include 'footer.php' 
?>



