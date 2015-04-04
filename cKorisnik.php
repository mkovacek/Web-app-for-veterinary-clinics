<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
$ispis="";
$ispis2="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Kreiranje korisnika");
  
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
  
  
  if(isset($_POST['cKorisnika'])) {
      
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
          #$greske.="Unos statusa je obavezan.<br>"; 
         }else{
           $status = $_POST['status'];
         }

         if(empty($_POST['pok'])){
          $greske.="Unos broja pokušaja je obavezan.<br>"; 
         }else{
           $pok = $_POST['pok'];  
         }
        

         if (empty($greske)) {
          $upit = "insert into korisnik (korisnikIme,korisnikaPrezime,korisnikKIme,korisnikaLozinka,korisnikAdresa,korisnikGrad,korisnikEmail,korisnikTelefon,ambulanta_ambulantaID,tipKorisnika_tipKorisnikaID,datumPristupanja,status,brojPokusaja) values ('$ime','$prezime','$korIme','$loz','$adresa','$grad','$email','$tel','$amb','$tip',now(),'$status','$pok')";
          if (!$baza->ostaliUpiti($upit)){
              $greske.="Greska pri radu s bazom podataka. <br>";
          }else{
             dnevnik_zapis("Uspješno kreiran korisnik");
             header("Location: crudKorisnik.php");
          }
        }   
}
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $skripta="cKorisnik.php";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->display('predlosci/cKorisnik.tpl');
 
 include 'footer.php';

 if($pom==1){
    echo '<script language="javascript">';
    echo 'alert("Kreirali ste novi tip korisnika")';
    echo '</script>';
    $pom=0;
 }
 ?>