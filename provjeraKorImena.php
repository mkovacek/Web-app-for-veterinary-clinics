<?php

include_once('baza.class.php'); 
$baza=new Baza();

 // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

header("Content-Type:application/xml");
echo '<?xml version="1.0" encoding="utf-8"?><korisnici>';

if(isset($_GET['korisnik'])){
    $found = 0;
    $korisnik = $_GET['korisnik'];
    $upit = "SELECT korisnikKime FROM korisnik where korisnikKIme='$korisnik'";
    $podaci = $baza->selectUpiti($upit);
    $red = $podaci->fetch_array();
    if($red){
       $found = 1;
    }
    echo "<korisnik>$found</korisnik>";
    echo "</korisnici>";
}
?>
