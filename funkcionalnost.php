<?php
$greske="";
include_once('aplikacijskiOkvir.php');

#1. php datoteka
class PrijavaOdjavaKorisnika{
    
    #provjera validnosti autentikacijskih podataka
    function autentikacija($korIme,$korLozinka){
        $rezAut=-1;
        $baza=new Baza();
        $upit="select korisnikID, korisnikIme, korisnikaPrezime,korisnikEmail,korisnikaLozinka,ambulanta_ambulantaID, tipKorisnika_tipKorisnikaID, brojPokusaja from korisnik where korisnikKIme='$korIme' and status='1'";
        $rez=$baza->selectUpiti($upit);
        if(!$rez){
            $greske.="Greska kod upita!";
            $adresa = 'greske.php?kod=';
            header("Location: $adresa".$greske);
            exit();
           
        }
            $korisnik = new Korisnik();
            if($rez->num_rows==1){
                list($id, $ime, $prezime,$email,$lozinka,$ambulanta,$vrsta,$attempts)= $rez->fetch_array();
                if($korLozinka==$lozinka){
                    $korisnik->set_podaci($id, $korIme, $ime, $prezime, $korLozinka,$email, $vrsta,$ambulanta);
                    $rezAut=1;
                    //$attempts=$red['brojPokusaja'];
                    $attempts=1;
                    $upitUpdate="UPDATE korisnik set brojPokusaja='$attempts' where korisnikID='$id'";
                    if (!$baza->ostaliUpiti($upitUpdate)){
                        $greske.="Greska pri radu s bazom podataka. <br>";
                        header('Location: greske.php?kod='.$greske);
                    }
                        
                }else{
                    if($attempts==3){
                       $rezAut=3;
                       $upitZabrana="UPDATE korisnik set status='$attempts' where korisnikID='$id'";
                       if (!$baza->ostaliUpiti($upitZabrana)){
                            $greske.="Greska pri radu s bazom podataka. <br>";
                            header('Location: greske.php?kod='.$greske);
                        }
                    }else{
                      $rezAut=0;
                      $attempts=$attempts+1;
                      $upitUpdate="UPDATE korisnik set brojPokusaja='$attempts' where korisnikID='$id'";
                      if (!$baza->ostaliUpiti($upitUpdate)){
                        $greske.="Greska pri radu s bazom podataka. <br>";
                        header('Location: greske.php?kod='.$greske);
                      }  
                    }
                     
                }
            }else {
                $rezAut=-1;
            }
            
         $korisnik->set_status($rezAut);
         return $korisnik;
    }
    
    #sesije
    
    const ID = "ID";
    const MAIL = "mail";
    const KOR_IME = "username";
    const IME = "ime";
    const PREZIME = "prezime";
    const TIP = "tip";
    const SESSION_NAME = "prijava_sesija";
   
    
    
    static function kreiranjeSesije($id, $kor_ime, $ime, $prezime, $mail, $tip){
        
        session_name(self::SESSION_NAME);
        
        if(session_id() == ""){
            session_start();
        }
        
        $_SESSION[self::ID] = $id;
        $_SESSION[self::MAIL] = $mail;
        $_SESSION[self::KOR_IME] = $kor_ime;
        $_SESSION[self::IME] = $ime;
        $_SESSION[self::PREZIME] = $prezime;
        $_SESSION[self::TIP] = $tip;
        
    }
    
    static function provjeriSesiju() {
        session_name(self::SESSION_NAME);
        
        if(session_id() == ""){
            session_start();
        }

        if (isset($_SESSION[self::ID])) {
            $id = $_SESSION[self::ID];
        } else {
            return null;
        }
        return $id;
    } 
    
    
    static function brisanjeSesije(){
         
        session_name(self::SESSION_NAME);
        
        if(session_id() == ""){
            session_start();
        }
        
        session_unset();
        session_destroy();
    }
    
   #cookies 
   static function kreiranjeKolacica($value){
       if(!isset($_COOKIE["prijava_kolacic"])){
         setcookie("prijava_kolacic", $value, time()+7200);  
       }
       
   }
   
   static function provjeraKolacica() {

        if (isset($_COOKIE["prijava_kolacic"])) {
            $kuki =$_COOKIE["prijava_kolacic"];
        } else {
            return null;
        }
        return $kuki;
    }
   
   
   
   static function brisanjeKolacica(){
        if(isset($_COOKIE['prijava_kolacic'])){
         setcookie("prijava_kolacic", "", time()-3600);  
       }
    } 
}
?>