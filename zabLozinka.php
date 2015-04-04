<?php
include_once('aplikacijskiOkvir.php');
$greske="";
$baza=new Baza();
dnevnik_zapis("Zaboravljena lozinka");
if (isset($_POST['zabLozinka'])) {
    if(empty($_POST['email'])){
        $greske.="Morate unijeti E-mail adresu.<br>";
    }else{
        $k_email=$_POST['email'];
        $upit="select * from korisnik where korisnikEmail='$k_email'";
        if($baza->selectUpiti($upit)){
             $podaci=$baza->selectUpiti($upit);
             if($podaci->num_rows==1){
                    $znakovi="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $duljina=6;
                    $pass=substr(str_shuffle($znakovi),0,$duljina);
                    $upitpass="UPDATE korisnik set korisnikaLozinka='$pass' where korisnikEmail='$k_email'";
                    if($baza->ostaliUpiti($upitpass)){ 
                        $red=$podaci->fetch_array();
                        $k_ime=$red['korisnikIme'];
                        $k_prezime=$red['korisnikaPrezime'];
                        $primatelj=$k_email; 
                        $naslov="Zahtjev za lozinkom";
                        $headerFields = array(
                        "From: tehnicka.podrska@ecuko.hr",
                        "MIME-Version: 1.0",
                        "Content-Type: text/html;charset=utf-8"
                         );
                        $poruka="Postovani $k_ime $k_prezime <br/><br/> Na temelju zaprimljenog zahtjeva Vaša lozinka za prijavu je sljedeća $pass <br><br/> Vaš ečuko";
                        mail($primatelj, $naslov, $poruka,implode("\r\n",$headerFields));
                        dnevnik_zapis("Poslan odgovor na zahtjev za lozinkom");
                        header('Location: index.php');
                    }else{
                       $greske.="Greška pri radu s bazom podataka,nije došlo do promjene e-maila.<br>";  
                    }
             }else{
              $greske.="Nepostojeća E-mail adresa.<br>";
              dnevnik_zapis("Zahtjev za lozinkom-ne postojeći email");
             }
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
       
        
    }
}
if (!empty($greske)){   
    header('Location: greske.php?kod='.$greske);
    exit();
}


 include 'header.php';
 
 $skripta="zabLozinka.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/zabLozinka.tpl');
    

 include 'footer.php'; ?>