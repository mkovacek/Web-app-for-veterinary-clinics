<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Ažuriranje tablice tip korisnika");
    if (isset($_GET['idTipKorisnika'])){
        $idTipKorisnika=$_GET['idTipKorisnika'];
        
        $upit="Select tipKorisnikaNaziv from tipKorisnika where tipKorisnikaID='$idTipKorisnika'";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $naziv=$red['tipKorisnikaNaziv'];
        }else{
          $greske.="Greška kod rada sa bazom.<br>";  
        }      
    }
    if (isset($_POST['uTipKorisnika'])){
        $idTipKorisnika=$_GET['idTipKorisnika'];
        
        if(empty($_POST['naziv'])){
         $greske.="Unos naziva je obavezan.<br>"; 
        }else{
            $naziv = $_POST['naziv'];
            
            $upitU="Update tipKorisnika set tipKorisnikaNaziv='$naziv' where tipKorisnikaID='$idTipKorisnika'";
            if(!$baza->ostaliUpiti($upitU)){
                $greske.="Greška kod rada sa bazom.<br>"; 
            }
            if (empty($greske)){  
                dnevnik_zapis("Ažurirana tablica tip korisnika");
                header('Location: crudTipKorisnika');
                exit();
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
    $skripta="uTipKorisnika.php?idTipKorisnika={$idTipKorisnika}";
    $smarty->assign('skripta', $skripta);
    $smarty->assign('naziv', $naziv);
    $smarty->display('predlosci/uTipKorisnika.tpl');
    
    include 'footer.php' 
?>

