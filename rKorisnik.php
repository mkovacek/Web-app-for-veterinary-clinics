<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice korisnik");
    if (isset($_GET['idKorisnik'])){
        $idKorisnik=$_GET['idKorisnik'];
        $upit="SELECT * FROM korisnik WHERE korisnikID='$idKorisnik'";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $ime=$red['korisnikIme'];
            $prezime=$red['korisnikaPrezime'];
            $korIme=$red['korisnikKIme'];
            $lozinka=$red['korisnikaLozinka'];
            $adresa=$red['korisnikAdresa'];
            $grad=$red['korisnikGrad'];
            $email=$red['korisnikEmail'];
            $telefon=$red['korisnikTelefon'];
            $datum=$red['datumPristupanja'];
            $status=$red['status'];
            $brojPokusaja=$red['brojPokusaja'];
            echo "imee: ".$red['korisnikIme'];
        }else{
          $greske.="Greška kod rada sa bazom.<br>";  
        }       
    }
    if (isset($_GET['idAmbulanta'])){
        if(!empty($_GET['idAmbulanta'])){
            $amb=$_GET['idAmbulanta'];
            $upitAmbulanta="Select ambulantaNaziv from ambulanta where ambulantaID=$amb";
            if($podaciAmbulanta = $baza->selectUpiti($upitAmbulanta)){
                $redAmbulanta = $podaciAmbulanta->fetch_array();
                $ambulanta=$redAmbulanta['ambulantaNaziv']; 
            }else{
              $greske.="Greška kod rada sa bazom.<br>";  
            }        
        }else{
            $ambulanta="";
        }
    }
    if (isset($_GET['idTipKorisnika'])){
        if(!empty($_GET['idTipKorisnika'])){
            $tipKor=$_GET['idTipKorisnika'];
            $upitTipKor="Select tipKorisnikaNaziv from tipKorisnika where tipKorisnikaID=$tipKor";
            if($podaciTipKor = $baza->selectUpiti($upitTipKor)){
                $redTipKor = $podaciTipKor->fetch_array();
                $tipKorisnika=$redTipKor['tipKorisnikaNaziv']; 
            }else{
              $greske.="Greška kod rada sa bazom.<br>";  
            }
        }else{
            $tipKorisnika="";
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
    
    $smarty->assign('naziv', $naziv);
    $smarty->assign('vrijednost', array("'$ime'","'$prezime'","'$korIme'","'$lozinka'","'$adresa'","'$grad'","'$email'","'$telefon'","'$ambulanta'","'$tipKorisnika'","'$datum'","'$status'","'$brojPokusaja'"));
    $smarty->display('predlosci/rKorisnik.tpl');
    
    include 'footer.php' 
?>

