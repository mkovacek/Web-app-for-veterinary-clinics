<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Ažuriranje tablice tip životinja");
    if (isset($_GET['idTipZivotinje']) && isset($_GET['tipZivotinjeNaziv'])) {
        $idTipZivotinje=$_GET['idTipZivotinje'];
        $tipZivotinjeNaziv=$_GET['tipZivotinjeNaziv'];
    }
    
    if (isset($_POST['uTipZivotinje'])){
        $idZivotinje=$_GET['idTipZivotinje'];
        
        if(empty($_POST['naziv'])){
         $greske.="Unos naziva je obavezan.<br>"; 
        }else{
            $naziv = $_POST['naziv'];
            
            $upitU="Update tipZivotinje set tipZivotinjeNaziv='$naziv' where tipZivotinjeID='$idZivotinje'";
            if(!$baza->ostaliUpiti($upitU)){
                $greske.="Greška kod rada sa bazom.<br>"; 
            }
            
            if (empty($greske)){  
                dnevnik_zapis("Ažurirana tablica tip životinja ");
                header('Location: crudTipZivotinje.php');
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
    $skripta="uTipZivotinje.php?idTipZivotinje={$idTipZivotinje}";
    $smarty->assign('skripta', $skripta);
    $smarty->assign('tipZivotinjeNaziv', $tipZivotinjeNaziv);
    $smarty->display('predlosci/uTipZivotinje.tpl');
    
    include 'footer.php' 
?>

