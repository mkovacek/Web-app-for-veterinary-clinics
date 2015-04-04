<?php
include_once('aplikacijskiOkvir.php');
dnevnik_zapis("Prijava");
$greske="";

if (isset($_POST['prijava'])) {
    if(empty($_POST['logInkorisnickoIme'])){
        $greske.="Morate unijeti korisnicko ime.<br>";
    }else{
        $k_korIme=$_POST['logInkorisnickoIme'];
    }
    
    if(empty($_POST['lozinka1'])){
        $greske.="Morate unijeti lozinku.<br>";
    }else{
        $k_lozinka=$_POST['lozinka1'];
    }
    
    if (!empty($greske)){   
        $adresa = 'error.php?kod=';
        header("Location: $adresa".$greske);
        exit();
    }
    
    if (empty($greske)) {
        $korisnik=new Korisnik();
        $prijava=new PrijavaOdjavaKorisnika();
        $korisnik=$prijava->autentikacija($k_korIme,$k_lozinka);
        if ($korisnik->get_status() == 1) {
            $id=$korisnik->get_id();
            $kor_ime=$korisnik->get_kor_ime();
            $ime=$korisnik->get_ime();
            $prezime=$korisnik->get_prezime();
            $mail=$korisnik->get_email();
            $tip=$korisnik->get_vrsta();
            session_start();
            $_SESSION["PzaWeb"] = $korisnik;
            PrijavaOdjavaKorisnika::kreiranjeSesije($id, $kor_ime, $ime, $prezime, $mail, $tip);
            PrijavaOdjavaKorisnika::kreiranjeKolacica($id);
            dnevnik_zapis("Uspješna prijava");
            $adresa = 'pocetna.php'; 
            header("Location: $adresa");
            exit();
        } else { 
            dnevnik_zapis("Neuspješna prijava");
            $adresa = 'error.php?e=';
            header("Location: $adresa".$korisnik->get_status());
            exit();
        }
    }
}
 include 'header.php';

 $skripta="prijava.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/prijava.tpl');

 include 'footer.php'; 
 ?>
