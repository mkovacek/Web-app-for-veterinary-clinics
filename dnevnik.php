<?php

function dnevnik_zapis($tekst) {
    include_once('vrijeme.php');
    $virtVrijeme = virtualnoVrijeme();
    $virtualnoVrijeme=date('Y-m-d H:i:s',$virtVrijeme);
    
    $korisnik = isset($_SESSION["PzaWeb"]) ? $_SESSION["PzaWeb"]->get_kor_ime() : "";
    $adresa = $_SERVER["REMOTE_ADDR"];
    $skripta = $_SERVER["REQUEST_URI"];
    
    
    $baza=new Baza();

    $sql = "insert into dnevnik (korisnik, adresa, skripta, tekst,vrijeme) values " .
            "('$korisnik', '$adresa', '$skripta', '$tekst','$virtualnoVrijeme')";

    $rs = $baza->ostaliUpiti($sql);
    if (!$rs) {
        trigger_error("Problem kod upisa u bazu podataka!" . $baza->error, E_USER_ERROR);
    }

    
}

?>