<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
$ispis="";
$ispis2="";
session_start();
$korisnik = provjeraKorisnika();
if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Ažuriranje stručnosti");
  
  if (isset($_GET['idKartoteke'])) {
        $idKartoteke=$_GET['idKartoteke'];

        $upit="SELECT zivotinjaID,zivotinjaIme, korisnikIme, korisnikaPrezime,ambulantaID,ambulantaNaziv
                FROM zivotinja, korisnik,ambulanta,kartoteka
                WHERE kartotekaID='$idKartoteke'
                AND korisnikID = zivotinja.korisnik_korisnikID
                AND zivotinjaID=zivotinja_zivotinjaID
                AND kartoteka.ambulanta_ambulantaID=ambulantaID";
        
        if($podaci = $baza->selectUpiti($upit)){
           $red=$podaci->fetch_array();
           $idZivotinje=$red['zivotinjaID'];
           $zivotinja=$red['zivotinjaIme'].' '.$red['korisnikIme'].' '.$red['korisnikaPrezime'];
           $idAmbulante=$red['ambulantaID'];
           $ambulanta=$red['ambulantaNaziv'];
        }else{
            $greske.="Greška kod rada sa bazom.<br>";  
        } 
        
    
        $upitZivotinje="SELECT zivotinjaID, zivotinjaIme korisnikIme, korisnikaPrezime
                  FROM zivotinja, korisnik
                  WHERE korisnikID = zivotinja.korisnik_korisnikID";
  
        if($podaciZivotinje = $baza->selectUpiti($upitZivotinje)){
            while($redZivotinje = $podaciZivotinje->fetch_array()){
               $ispis.="<option value='{$redZivotinje['zivotinjaID']}'>{$redZivotinje['zivotinjaIme']} {$redZivotinje['korisnikIme']} {$redZivotinje['korisnikaPrezime']}</option>";   
            }
        }


        $upitAmbulanta="Select ambulantaID,ambulantaNaziv from ambulanta";
        if($podaciAmbulanta = $baza->selectUpiti($upitAmbulanta)){
            while($redAmbulanta = $podaciAmbulanta->fetch_array()){
               $ispis2.="<option value='{$redAmbulanta['ambulantaID']}'>{$redAmbulanta['ambulantaNaziv']}</option>";   
            }
        }
  }else{
      $greske.="Fale podaci.<br>"; 
  }

  if(isset($_POST['uKartoteka'])) {
        $idKartoteke=$_GET['idKartoteke'];
      
        if(empty($_POST['ambulanta'])){
          $greske.="Unos starosti je obavezano.<br>"; 
        }else{
          $ambulanta = $_POST['ambulanta'];  
        }

         if(empty($_POST['zivotinja'])){
          $greske.="Obavezno je odabrati tip životinje.<br>"; 
         }else{
           $zivotinja = $_POST['zivotinja'];  
         }
         
         $provjera="Select korisnikIme from zivotinja,korisnik,ambulanta
                    where zivotinjaID='$zivotinja' and ambulantaID='$ambulanta'
                    and korisnikID=korisnik_korisnikID and ambulantaID=ambulanta_ambulantaID";
         if($podaciProvjera=$baza->selectUpiti($provjera)){
             if($podaciProvjera->num_rows==0){
                 $greske.="Vlasnik životinje nepripada odabranoj ambulanti.<br>";
             }
         }else{
            $greske.="Greska pri radu s bazom podataka. <br>"; 
         }
         
         
         if (empty($greske)) {
                #update
            $upit = "update kartoteka set zivotinja_zivotinjaID='$zivotinja',kartotekaDatumVrijemeKreiranja=now(),ambulanta_ambulantaID='$ambulanta' where kartotekaID='$idKartoteke'";
            if (!$baza->ostaliUpiti($upit)){
                 $greske.="Greska pri radu s bazom podataka. <br>";
            }else{
                 dnevnik_zapis("Uspješno kreirana kartoteka");
                 header("Location: crudKartoteka.php");
            }  
        } 
         if (!empty($greske)){   
            header('Location: greske.php?kod='.$greske);
            exit();
         }
}
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $skripta="uKartoteka.php?idKartoteke={$idKartoteke}";
 $smarty->assign('skripta', $skripta);
 $smarty->assign('ispis', $ispis);
 $smarty->assign('ispis2', $ispis2);
 $smarty->assign('vrijednost', array("'$idZivotinje'","'$zivotinja'","'$idAmbulante'","'$ambulanta'"));
 $smarty->display('predlosci/uKartoteka.tpl');
 
 include 'footer.php';

 ?>
