<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispis2="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Otključavanje/blokiranje korisničkog računa");
    
        $sql = "Select korisnikID ,korisnikIme,korisnikaPrezime,korisnikAdresa,korisnikGrad,korisnikEmail from korisnik where status=3 ";
        
        if($podaciDnevnik=$baza->selectUpiti($sql)){
            $ispis="<span class='label' style='width: 100%; margin-top: 10px; margin-bottom: 10px'><h5 class='text-center' style='color:white'>Blokirani korisnici</h5></span>"; 
            $ispis.="<table class='veterinariAmbulanta'><thead><tr><th width='70'>Ime</th><th width='100'>Prezime</th><th width='100'>Adresa</th><th width='100'>Grad</th><th width='100'>Email</th><th width='100'>Otključavanje</th></tr></thead><tbody>";
            while($red = $podaciDnevnik->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['korisnikIme']."</td>";
              $ispis.="<td>".$red['korisnikaPrezime']."</td>";
              $ispis.="<td>".$red['korisnikAdresa']."</td>";
              $ispis.="<td>".$red['korisnikGrad']."</td>";
              $ispis.="<td>".$red['korisnikEmail']."</td>";
              $ispis.="<td><a href='otkljucaj.php?idKorisnik={$red['korisnikID']}'>Otključaj</a></td>";
              $ispis.='</tr>';
            }
            $ispis.="</tbody></table>";
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
        
        
        $sql2 = "Select korisnikID ,korisnikIme,korisnikaPrezime,korisnikKIme,korisnikAdresa,korisnikGrad,korisnikEmail from korisnik";
        
        if($podaciDnevnik2=$baza->selectUpiti($sql2)){
            $ispis2="<span class='label' style='width: 100%; margin-top: 10px; margin-bottom: 10px'><h5 class='text-center' style='color:white'>Ne blokirani korisnici</h5></span>"; 
            $ispis2.="<table class='veterinariAmbulanta'><thead><tr><th width='70'>Ime</th><th width='100'>Prezime</th><th width='100'>Korisničko ime</th><th width='100'>Adresa</th><th width='100'>Grad</th><th width='100'>Email</th><th width='100'>Blokiranje</th></tr></thead><tbody>";
            while($red2 = $podaciDnevnik2->fetch_array()){
              $ispis2.='<tr>';
              $ispis2.="<td>".$red2['korisnikIme']."</td>";
              $ispis2.="<td>".$red2['korisnikaPrezime']."</td>";
              $ispis2.="<td>".$red2['korisnikKIme']."</td>";
              $ispis2.="<td>".$red2['korisnikAdresa']."</td>";
              $ispis2.="<td>".$red2['korisnikGrad']."</td>";
              $ispis2.="<td>".$red2['korisnikEmail']."</td>";
              $ispis2.="<td><a href='blokiraj.php?idKorisnik={$red2['korisnikID']}'>Blokiraj</a></td>";
              $ispis2.='</tr>';
            }
            $ispis2.="</tbody></table>";
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
    $smarty->assign('ispis2', $ispis2);
    $smarty->display('predlosci/otkljucavanje.tpl');
    
    include 'footer.php' 
?>

