<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";


if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Odabir tipa životinje");
    $idKorisnika=$korisnik->get_id();
    $upitVeterinar="Select korisnikIme,korisnikaPrezime,korisnikAdresa,korisnikGrad from korisnik where korisnikID='$idKorisnika'";
    if($podaci = $baza->selectUpiti($upitVeterinar)){
        $red = $podaci->fetch_array();
        $ime=$red['korisnikIme'];
        $prezime=$red['korisnikaPrezime'];
        $adresa=$red['korisnikAdresa'];  
        $grad=$red['korisnikGrad']; 
    }else{
        $greske.="Greška kod rada sa bazom.<br>";
    }
    $upitStrucan="Select tipZivotinjeID,tipZivotinjeNaziv from tipZivotinje,strucan,korisnik where korisnikID=korisnik_korisnikID and tipZivotinjeID=tipZivotinje_tipZivotinjeID and korisnikID='$idKorisnika'";
    if($podaciStrucan=$baza->selectUpiti($upitStrucan)){
        if($podaciStrucan->num_rows!=0){
           $ispisStrucan="<select id='strucan' name='strucan'>";
           $ispisStrucan.="<option selected='selected' disabled='disabled'>Vrste životinja</option>";
           while($redStrucan = $podaciStrucan->fetch_array()){ 
               $ispisStrucan.="<option value='{$redStrucan['tipZivotinjeID']}' disabled='disabled'>{$redStrucan['tipZivotinjeNaziv']}</option>"; 
           }
           $ispisStrucan.="</select>";
        }else{
           $ispisStrucan="<div><input type='text'  name='strucan'  value='Nema odabranih vrsta životinja' readonly></div>"; 
        }
    }else{
        $greske.="Greška kod rada sa bazom.<br>";
    }
    
    #$upitVrste="Select tipZivotinjeID,tipZivotinjeNaziv from tipZivotinje";
    $upitVrste="SELECT tipZivotinjeID, tipZivotinjeNaziv
                FROM tipZivotinje
                where tipZivotinjeID not in (select tipZivotinje_tipZivotinjeID from strucan where korisnik_korisnikID = '$idKorisnika')";
    if($podaciVrste=$baza->selectUpiti($upitVrste)){
        if($podaciVrste->num_rows!=0){
           $ispisVrste="<select id='vrste' name='vrste'>";
           $ispisVrste.="<option selected='selected' disabled='disabled'>Vrste životinja</option>";
           while($redVrste = $podaciVrste->fetch_array()){ 
               $ispisVrste.="<option value='{$redVrste['tipZivotinjeID']}'>{$redVrste['tipZivotinjeNaziv']}</option>"; 
           }
           $ispisVrste.="</select>";
        }else{
           $ispisVrste="<div><input type='text' name='strucan'  value='Stručni ste za sve vrste životinja' readonly></div>"; 
        }
    }else{
        $greske.="Greška kod rada sa bazom.<br>";
    }
      
    if (isset($_POST['odabirVrsteZivotinja'])){
        $idKorisnikaDodaj=$_GET['idKor'];
        if(isset($_POST['vrste'])){
            $vrsta=$_POST['vrste'];
            $upitProvjera="Select *from strucan where korisnik_korisnikID='$idKorisnikaDodaj' and tipZivotinje_tipZivotinjeID='$vrsta'";
            if($rez=$baza->selectUpiti($upitProvjera)){
                if($rez->num_rows==0){
                   if($vrsta==0){
                      $greske.="Morate odabrati vrstu životinje.<br>";
                   }else{
                        $upitInsert="Insert into strucan (korisnik_korisnikID,tipZivotinje_tipZivotinjeID) values ('{$idKorisnikaDodaj}','{$vrsta}')";
                        if( !$baza->ostaliUpiti($upitInsert)){
                            $greske.="Greška kod rada sa bazom.<br>";
                        }else{
                            dnevnik_zapis("Dodana vrsta životinje");
                            header('Location: odabirTipaZivotinje.php');
                        } 
                    }   
                }
                else{
                  $greske.="Već ste stručni za tu vrstu životinje.<br>";  
                }
            }   
        }else{
            $greske.="Niste odabrali vrstu životinje.<br>";
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
    
    $skripta="odabirTipaZivotinje.php?idKor=".$idKorisnika;
    $smarty->assign('skripta', $skripta);
    $smarty->assign('vrijednost', array("'$ime'","'$prezime'","'$adresa'","'$grad'"));
    $smarty->assign('ispisStrucan', $ispisStrucan);
    $smarty->assign('ispisVrste', $ispisVrste);
    $smarty->display('predlosci/odabirTipaZivotinje.tpl');
    
    include 'footer.php' 
?>


