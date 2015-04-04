<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==3){
    dnevnik_zapis("Korisnik dodaje ljubimca");
    $idKorisnika=$korisnik->get_id();
    $upit="Select * from tipZivotinje";
    if($podaci=$baza->selectUpiti($upit)){
        while($red=$podaci->fetch_array()){
          $ispis.="<option value='{$red['tipZivotinjeID']}'>{$red['tipZivotinjeNaziv']}</option>";  
        }   
    }else{
        $greske.="Greška pri radu s bazom podataka. <br>";
    }
    
    if (isset($_POST['dodajLjubimca'])){
        $idKorisnikaDodaj=$_GET['idKor'];
        if(empty($_POST['naziv'])){
        $greske.="Unos naziva je obavezan.<br>";
        }else{
          $naziv = $_POST['naziv']; 
        } 

        if(empty ($_POST['vrsta'])){
           $greske.="Odabir vrste je obavezan.<br>";
        }else{
           $vrsta = $_POST['vrsta']; 
        } 
        if(empty($_POST['starost'])){
            $greske.="Unos starosti je obavezan.<br>";
        }else{
            $starost = $_POST['starost'];  
        }
        if (empty($greske)) {
           $upitInsert="Insert into zivotinja(zivotinjaIme,zivotinjaStarost,tipZivotinje_tipZivotinjeID,korisnik_korisnikID) values ('$naziv','$starost','$vrsta',' $idKorisnikaDodaj')";
           if( !$baza->ostaliUpiti($upitInsert)){
                $greske.="Greška kod rada sa bazom.<br>";
           }else{
                dnevnik_zapis("Korisnik uspješno dodao ljubimca");
                header('Location: kucniLjubimac.php');
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
$skripta="dodajLjubimca.php?idKor=".$idKorisnika;
$smarty->assign('skripta', $skripta);
$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/dodajLjubimca.tpl');
include 'footer.php'

?>