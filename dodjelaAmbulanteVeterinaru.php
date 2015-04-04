<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Dodjela ambulante veterinaru");
    if (isset($_GET['id'])){
        $idKorisnika=$_GET['id'];
        $upit="Select korisnikIme,korisnikaPrezime,korisnikAdresa,korisnikGrad from korisnik where korisnikID='$idKorisnika'";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $ime=$red['korisnikIme'];
            $prezime=$red['korisnikaPrezime'];
            $adresa=$red['korisnikAdresa'];  
            $grad=$red['korisnikGrad'];  
        }else{
          $greske.="Greška kod rada sa bazom.<br>";  
        }
        $upitAmbulante="Select ambulantaID,ambulantaNaziv from ambulanta";
        if($podaciAmbulanta = $baza->selectUpiti($upitAmbulante)){
            #$ispis="<select id='ambulanta' name='ambulanta'>";
            while($redAmbulanta = $podaciAmbulanta->fetch_array()){
                $ispis.="<option value='{$redAmbulanta['ambulantaID']}'>{$redAmbulanta['ambulantaNaziv']}</option>";   
            }
           #$ispis.="</select>";
        }       
    }
    if (isset($_POST['dodajAmbulantu'])){
        $idKorisnikaPromjena=$_GET['idKor'];
        if(isset($_POST['ambulanta'])){
            $ambulanta=$_POST['ambulanta'];
            if($ambulanta==0){
                $greske.="Morate odabrati ambulantu.<br>";
            }
            else{
               $upitUp="UPDATE korisnik set ambulanta_ambulantaID='$ambulanta' where korisnikID='$idKorisnikaPromjena'";
               if( !$baza->ostaliUpiti($upitUp)){
                    $greske.="Greška kod rada sa bazom.<br>";
               }else{
                   dnevnik_zapis("Uspješno dodana ambulanta veterinaru");
                   header('Location: veterinariBezAmbulante.php');
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
   
    include 'headerLogIn.php' ; 
    
    $skripta="dodjelaAmbulanteVeterinaru.php?idKor=".$idKorisnika;
    $smarty->assign('skripta', $skripta);
    $smarty->assign('vrijednost', array("'$ime'","'$prezime'","'$adresa'","'$grad'"));
    $smarty->assign('ispis', $ispis);
    $smarty->display('predlosci/dodjelaAmbulanteVeterinaru.tpl');
    
    include 'footer.php' 
?>

