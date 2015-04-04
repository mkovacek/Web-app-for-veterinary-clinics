<?php   
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
dnevnik_zapis("Registracija");
if(isset($_POST['registracija'])) {
    
    if(empty($_POST['ime'])){
      $greske.="Unos imena je obavezan.<br>"; 
    }else{
      $k_ime = $_POST['ime'];  
      if (!preg_match("/^[a-zA-ZćčšžĆČĐŠŽ]+$/", $k_ime)){
        $greske.= "Ime mora sadrzavati samo slova.<br>";
      }
      else if (ucfirst($k_ime) != $k_ime){
        $k_ime=ucfirst($k_ime); 
      }
    } 
    
    if(empty($_POST['prezime'])){
        $greske.="Unos prezimena je obavezan.<br>";
    }else{
        $k_prezime = $_POST['prezime'];
        if (!preg_match("/^[a-zA-ZćčšžĆČĐŠŽ]+$/", $k_prezime)){
           $greske.= "Prezime mora sadrzavati samo slova.<br>";
        }
        else if (ucfirst($k_prezime) != $k_prezime){
            $k_prezime=ucfirst($k_prezime);
        }
     }
     
    if(empty($_POST['adresa'])){
      $greske.="Unos adrese je obavezan.<br>";
    }else{
      $k_adresa = $_POST['adresa']; 
    } 
    
    if(empty ($_POST['grad'])){
       $greske.="Unos grada je obavezan.<br>";
    }else{
       $k_grad = $_POST['grad']; 
    } 

    
       
    if(empty($_POST['email'])){
       $greske.="Unos email adrese je obavezan.<br>";
    }else{
       $k_email =$_POST['email'];
       
       $upitZauzeto = "select * from korisnik where korisnikEmail = '$k_email'";
       $rezultatZauzeto = $baza->selectUpiti($upitZauzeto);
       if ($rezultatZauzeto->num_rows != 0){
         $greske.= "Zauzeta email adresa.<br>";
       }
       else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $k_email)){ 
         $greske.= "Netocno strukturirana email adresa.<br>";
       }
    }
    
    if(empty($_POST['korisnickoIme'])){
       $greske.="Unos korisnickog imena je obavezan.<br>";
    }else{
       $k_korIme=$_POST['korisnickoIme']; 
    }
    
    if(empty($_POST['password'])){
       $greske.="Unos lozinke je obavezan.<br>";
    }
    else{
       $k_lozinka = $_POST['password']; 
    }
    
    if(empty($_POST['lozinka2'])){
       $greske.="Unos potvrde lozinke je obavezan.<br>";
    }else{
       $k_lozinkaP = $_POST['lozinka2'];
    }
    
    if(strcmp($k_lozinka, $k_lozinkaP) != 0){
        $greske.= "Lozinke nisu jedanke.<br>";
    }   
    
    if(empty($_POST['telefon'])){
        $greske.="Unos broja telefona je obavezan.<br>";
    }else{
        $k_telefon = $_POST['telefon'];  
    }

    
    require_once('recaptcha/recaptchalib.php'); 
    $privatekey = "6Lcl4_ISAAAAALR4nGhTpMp7sohDoFQoVa6jdczr"; 
    $resp = recaptcha_check_answer ($privatekey,
                                    $_SERVER["REMOTE_ADDR"],
                                    $_POST["recaptcha_challenge_field"],
                                    $_POST["recaptcha_response_field"]);                      
    if (!$resp->is_valid) {
       $greske.="Krivi captcha unos: {$resp->error} <br>";
      
    }
    
    if (!empty($greske)){   
    header('Location: error.php?kod='.$greske);
    exit();
    }

     if (empty($greske)) {
      $upit = "insert into korisnik (korisnikIme,korisnikaPrezime,korisnikKIme,korisnikaLozinka,korisnikAdresa,korisnikGrad,korisnikEmail,korisnikTelefon,ambulanta_ambulantaID,tipKorisnika_tipKorisnikaID,datumPristupanja,status,brojPokusaja) values ('$k_ime','$k_prezime','$k_korIme','$k_lozinka','$k_adresa','$k_grad','$k_email','$k_telefon',null,'3',now(),'0','1')";
      if ($baza->ostaliUpiti($upit)){
        dnevnik_zapis("Uspješna registracija");
        $pom=1;
        $primatelj=$k_email; 
        $naslov="Aktivacija korisnickog racuna";
        $headerFields = array(
                        "From: info@ecuko.hr",
                        "MIME-Version: 1.0",
                        "Content-Type: text/html;charset=utf-8"
                         );
        $poruka="Postovani $k_ime $k_prezime <br/><br/> Molimo Vas da u roku 24h aktivirate svoj korisnicki racun klikom na <a href='http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_034/aktivacija.php?kod=$k_email'>link</a> <br><br/> Vaš ečuko.";
        mail($primatelj, $naslov, $poruka,implode("\r\n",$headerFields));
      }else{
        $greske.="Greska pri radu s bazom podataka. <br>";
      }
   }   
}


 include 'header.php';
        
 $skripta="registracija.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/registracija1.tpl');

 require_once('recaptcha/recaptchalib.php');
 $publickey = '6Lcl4_ISAAAAAM4BKLzNaJsogtIV5w4n89jcdokt';
 echo recaptcha_get_html($publickey);
 
 $smarty->display('predlosci/registracija2.tpl');
  
 include 'footer.php';

        if($pom==1){
            echo '<script language="javascript">';
            echo 'alert("Uspješno ste se registrirali,da bi aktivirali svoj račun pogledajte svoj email.")';
            echo '</script>';
            $pom=0;
        }
?>


