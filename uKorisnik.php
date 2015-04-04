<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Ažuriranje tablice korisnik");
    
    $upitAmbulante="Select ambulantaID,ambulantaNaziv from ambulanta";
  if($podaciAmbulanta = $baza->selectUpiti($upitAmbulante)){
      while($redAmbulanta = $podaciAmbulanta->fetch_array()){
         $ispis.="<option value='{$redAmbulanta['ambulantaID']}'>{$redAmbulanta['ambulantaNaziv']}</option>";   
      }
  }
  
  $upitTipKor="Select * from tipKorisnika";
  if($podaciTipKor = $baza->selectUpiti($upitTipKor)){
      while($redTipKor = $podaciTipKor->fetch_array()){
         $ispis2.="<option value='{$redTipKor['tipKorisnikaID']}'>{$redTipKor['tipKorisnikaNaziv']}</option>";   
      }
  }
    
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
            $ambulanta="Nije odabrana";
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
    
    
      if(isset($_POST['uKorisnika'])) {
        $korisnikID=$_GET['idKorisnik'];
    
        if(empty($_POST['ime'])){
          $greske.="Unos imena je obavezan.<br>"; 
        }else{
          $ime = $_POST['ime'];  
          if (ucfirst($ime) != $ime){ 
            $ime=ucfirst($ime); 
          }
        } 
        if(empty($_POST['prezime'])){
          $greske.="Unos prezimena je obavezan.<br>"; 
        }else{
          $prezime = $_POST['prezime'];  
          if (ucfirst($prezime) != $prezime){ 
            $prezime=ucfirst($prezime); 
          }
        }

        if(empty($_POST['korime'])){
          $greske.="Unos korisničkog imena je obavezan.<br>"; 
        }else{
          $korIme = $_POST['korime'];  
        }

        if(empty($_POST['loz'])){
          $greske.="Unos lozinke je obavezan.<br>"; 
        }else{
          $loz = $_POST['loz'];  
        }

        if(empty($_POST['adresa'])){
          $greske.="Unos adresa je obavezan.<br>"; 
        }else{
          $adresa = $_POST['adresa'];  
        }

        if(empty($_POST['grad'])){
          $greske.="Unos grada je obavezan.<br>"; 
        }else{
          $grad = $_POST['grad'];  
        }

         if(empty($_POST['email'])){
          $greske.="Unos email adrese je obavezan.<br>"; 
         }else{
           $email = $_POST['email'];  
         }

         if(empty($_POST['tel'])){
           $tel="";
         }else{
           $tel = $_POST['tel'];  
         }

         if(empty($_POST['amb'])){
          $greske.="Obavezno je odabrati ambulantu.<br>"; 
         }else{
           $amb = $_POST['amb'];
         }
         if(empty($_POST['tip'])){
          $greske.="Obavezno je odabrati ambulantu.<br>"; 
         }else{
           $tip = $_POST['tip'];  
         }
         
         if(empty($_POST['status'])){
          $status=0;
         }else{
           $status = $_POST['status'];
         }

         if(empty($_POST['pok'])){
          $greske.="Unos broja pokušaja je obavezan.<br>"; 
         }else{
           $pok = $_POST['pok'];  
         }
        

         if (empty($greske)) {
          $upit2 = "Update korisnik set korisnikIme='$ime',korisnikaPrezime='$prezime',korisnikKIme='$korIme',
                    korisnikaLozinka='$loz',korisnikAdresa='$adresa',korisnikGrad='$grad',korisnikEmail='$email',
                    korisnikTelefon='$tel',ambulanta_ambulantaID='$amb',tipKorisnika_tipKorisnikaID='$tip',
                    datumPristupanja=now(),status='$status',brojPokusaja='$pok' where korisnikID='$korisnikID'";
          if (!$baza->ostaliUpiti($upit2)){
              $greske.="Greska pri radu s bazom podataka. <br>";
          }else{
             dnevnik_zapis("Uspješno ažuriran korisnik");
             header("Location: crudKorisnik.php");
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
    $skripta="uKorisnik.php?idKorisnik={$idKorisnik}";
    $smarty->assign('skripta', $skripta);
    $smarty->assign('ispis', $ispis);
    $smarty->assign('ispis2', $ispis2);
    $smarty->assign('vrijednost', array("'$ime'","'$prezime'","'$korIme'","'$lozinka'","'$adresa'","'$grad'","'$email'","'$telefon'","'$amb'","'$ambulanta'",$tipKor,"'$tipKorisnika'","'$status'","'$brojPokusaja'"));
    $smarty->display('predlosci/uKorisnik.tpl');
    
    include 'footer.php' 
?>

