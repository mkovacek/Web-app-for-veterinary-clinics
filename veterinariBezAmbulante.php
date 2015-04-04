<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
session_start();
$korisnik = provjeraKorisnika();

$upit="Select korisnikID,korisnikIme,korisnikaPrezime, korisnikGrad from korisnik where tipKorisnika_tipKorisnikaID='2' and ambulanta_ambulantaID IS NULL";
$ispis="<table class='veterinariAmbulanta'><thead><tr><th width='250'>Ime</th><th width='250'>Prezime</th><th width='250'>Grad</th><th width='250'>Ambulanta</th></tr></thead><tbody>";
if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Dodavanje veterinara ambulantama");
    $podaci=$baza->selectUpiti($upit);  
    if($podaci){
      while($red = $podaci->fetch_array()){
          $ispis.='<tr>';
          $ispis.="<td>".$red['korisnikIme']."</td>";
          $ispis.="<td>".$red['korisnikaPrezime']."</td>";
          $ispis.="<td>".$red['korisnikGrad']."</td>";
          $ispis.="<td><a href=\"dodjelaAmbulanteVeterinaru.php?id={$red['korisnikID']}\">Dodaj ambulantu</a></td>";
          $ispis.='</tr>';
      }
      $ispis.="</tbody></table>";
        
    }else{
        $greske.="Greška pri radu s bazom podataka.<br>";
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
    $smarty->display('predlosci/veterinariBezAmbulante.tpl');
    include 'footer.php' 
?>

