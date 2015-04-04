<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$ispis="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==2){
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);

    if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2097152)
        && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            $greske.="Return Code: " . $_FILES["file"]["error"] . "<br>";
        }else{
            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

            if (file_exists("upload/" . $_FILES["file"]["name"])) {
              $greske.=$_FILES["file"]["name"] . " already exists. <br> ";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"],
                "upload/".$_FILES["file"]["name"]);
                $ispis.="Uspješno ste uplodali sliku. <br>";
                dnevnik_zapis("Uspješno uplodana slika");
                $url="http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_034/upload/".$_FILES["file"]["name"];

            }
       }
      }else {
        $greske.="Krivi format slike ili provjerite da li je slika manja od 2MB.<br>";
        dnevnik_zapis("Neuspješno uplodana slika");
      }

      if (isset($_GET['idKartoteka'])){
          $idKartoteka=($_GET['idKartoteka']);
      }
      if(empty($greske)){
        $upitPohrana="Insert into galerijaSlika(galerijaSlikaUrl,kartoteka_kartotekaID) values('$url','$idKartoteka')";
        if(!$baza->ostaliUpiti($upitPohrana)){
           $greske.="Greška pri radu s bazom podataka<br>";
        }else{
          $ispis.="Slika je pohranjena. <br>";
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

include 'headerLogIn.php';
$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/upload_file.tpl');
include 'footer.php'; 

?>