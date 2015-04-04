<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Čitanje tablice ambulanta");
    if (isset($_GET['idAmbulanta'])){
        $idAmbulanta=$_GET['idAmbulanta'];
        
        $upit="Select * from ambulanta where ambulantaID='$idAmbulanta'";
        if($podaci = $baza->selectUpiti($upit)){
            $red = $podaci->fetch_array();
            $naziv=$red['ambulantaNaziv'];
            $adresa=$red['ambulantaAdresa'];
            $grad=$red['ambulantaGrad'];
            $telefon=$red['ambulantaTelefon'];
            $radnoVrijeme=$red['ambulantaRadnoVrijeme'];
        }else{
          $greske.="Greška kod rada sa bazom.<br>";  
        }
            
    } 
    
     if(isset($_POST['uAmbulanta'])) {  
         
        $ambulantaID=$_GET['idAmbulanta']; 
        if(empty($_POST['naziv'])){
          $greske.="Unos naziva je obavezan.<br>"; 
        }else{
          $naziv = $_POST['naziv'];  
          if (ucfirst($naziv) != $naziv){ 
            $naziv=ucfirst($naziv); 
          }
        } 

        if(empty($_POST['adresa'])){
          $greske.="Unos adrese je obavezan.<br>";
        }else{
          $k_adresa = $_POST['adresa']; 
        } 

        if(empty ($_POST['grad'])){
           $greske.="Unos grada je obavezan.<br>";
        }else{
           $k_grad = $_POST['grad']; 
        } 

        if(empty($_POST['telefon'])){
            $greske.="Unos broja telefona je obavezan.<br>";
        }else{
            $k_telefon = $_POST['telefon'];  
        }

        if(empty($_POST['radnoVrijeme'])){
            $greske.="Unos radnog vremena je obavezno.<br>";
        }else{
            $radVrijeme = $_POST['radnoVrijeme'];  
        }

        if (!empty($greske)){   
        header('Location: greske.php?kod='.$greske);
        exit();
        }

         if (empty($greske)) {
          $upit = "update ambulanta set ambulantaNaziv='$naziv',ambulantaAdresa='$k_adresa',ambulantaGrad='$k_grad',ambulantaTelefon='$k_telefon',ambulantaRadnoVrijeme='$radVrijeme' where ambulantaID='$ambulantaID'";
          if (!$baza->ostaliUpiti($upit)){
              $greske.="Greska pri radu s bazom podataka. <br>";
          }else{
              dnevnik_zapis("Uspješno ažurirana ambulanta");
              header('Location: crudAmbulanta.php');
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
    $skripta="uAmbulanta.php?idAmbulanta={$idAmbulanta}";
    $smarty->assign('skripta', $skripta);
    $smarty->assign('vrijednost', array("'$naziv'","'$adresa'","'$grad'","'$telefon'","'$radnoVrijeme'"));
    $smarty->display('predlosci/uAmbulanta.tpl');
    
    include 'footer.php' 
?>

