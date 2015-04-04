<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";

if($korisnik->get_vrsta()==1){
   if (isset($_GET['datum'])){
       if(!empty($_GET['datum'])){
           $datum=$_GET['datum'];
       }else{
           $greske.="Greska,fale podaci. <br>";
       }    
   }
   if (isset($_GET['vrijeme'])){
       if(!empty($_GET['vrijeme'])){
           $vrijeme=$_GET['vrijeme'];
       }else{
           $greske.="Greska,fale podaci. <br>";
       }    
   }
   if (isset($_GET['korIme'])){
       if(!empty($_GET['korIme'])){
           $korIme=$_GET['korIme'];
       }else{
           $greske.="Greska,fale podaci. <br>";
       }    
   }
   if (isset($_GET['korPrezime'])){
       if(!empty($_GET['korPrezime'])){
           $korPrezime=$_GET['korPrezime'];
       }else{
           $greske.="Greska,fale podaci. <br>";
       }    
   }
   if (isset($_GET['zivotinja'])){
       if(!empty($_GET['zivotinja'])){
           $zivotinja=$_GET['zivotinja'];
       }else{
           $greske.="Greska,fale podaci. <br>";
       }    
   }
    if (isset($_GET['email'])){
       if(!empty($_GET['email'])){
           $email=$_GET['email'];
       }else{
           $greske.="Greska,fale podaci. <br>";
       }    
   }
   
    if (!empty($greske)){   
        header('Location: greske.php?kod='.$greske);
        exit();
    }
    
    if (empty($greske)) {
        $primatelj=$email; 
        $naslov="Obavijest-zakazani termin";
        $headerFields = array(
                        "From: info@ecuko.hr",
                        "MIME-Version: 1.0",
                        "Content-Type: text/html;charset=utf-8"
                         );
        $poruka="Poštovani $korIme $korPrezime <br/><br/> Ovim putem Vas obaviještavamo da Vaš kućni ljubimac $zivotinja, sutra ($datum) ima zakazani termin u $vrijeme h. <br><br/> Vaš ečuko ";
        mail($primatelj, $naslov, $poruka,implode("\r\n",$headerFields));
        dnevnik_zapis("Poslan email (obavijest o terminu)");
   } 
    
}else{
    header("Location: greske.php?e=2");
    exit();
}


include 'headerLogIn.php';
$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/saljiObavijest.tpl');
include 'footer.php'; 

?>




