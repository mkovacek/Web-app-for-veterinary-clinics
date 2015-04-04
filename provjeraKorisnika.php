<?php

include_once('korisnik.php');

function provjeraKorisnika() {
    $korisnik = null;

    session_start();
    if (!isset($_SESSION["PzaWeb"])) {
        header("Location: error.php?e=2");
        exit();
    } else {
        $korisnik = $_SESSION["PzaWeb"];
        if ($korisnik->get_status() != 1) {
            header("Location: error.php?e=2");
            exit();
        } 
        if($korisnik->get_adresa() != $_SERVER["REMOTE_ADDR"]) {
            header("Location: error.php?e=2");
            exit();
        }
    }
    return $korisnik;
}

function provjeraUloge($uloga) {
    session_start();
    $korisnik = isset($_SESSION["PzaWeb"]) ? $_SESSION["PzaWeb"] : "";
    if ($korisnik == "" || $korisnik->get_status() != 1 || $korisnik->get_vrsta() != $uloga) {
        header("Location: greske.php?e=2");
        exit();
    }
    
}
?>