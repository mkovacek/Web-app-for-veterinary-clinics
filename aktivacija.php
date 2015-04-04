<?php
include 'baza.class.php';
include_once('vrijeme.php');
$baza=new Baza();
$greske="";
$poruka="";

if (isset($_GET['kod'])) {
    
    $k_email=$_GET['kod'];
    $dohvatiEmail = "SELECT * FROM korisnik where korisnikEmail='$k_email'" ;
    $rezultat=$baza->selectUpiti($dohvatiEmail);

    if ($rezultat->num_rows != 0) {
	$dohvatiStatus="SELECT * FROM korisnik where korisnikEmail='$k_email' and status='0'" ;
        $rezultat2=$baza->selectUpiti($dohvatiStatus);
	if ($rezultat2->num_rows != 0) {
		$upitDatumPristupa="SELECT datumPristupanja FROM korisnik where korisnikEmail='$k_email' and status='0'";
                $datumPristupa=$baza->selectUpiti($upitDatumPristupa);
                $datumPristupaRed=$datumPristupa->fetch_array();
	        #$sada = date('Y-m-d H:i:s'); 
                $t2=virtualnoVrijeme();
		$t1=strtotime($datumPristupaRed['datumPristupanja']);
		#$t2=strtotime($sada);
		if(($t2-$t1)<86400){
			$azuriraj="UPDATE korisnik SET status='1' WHERE korisnikEmail='$k_email'";
			if($baza->ostaliUpiti($azuriraj)){
                    		$poruka.="Uspjesno ste aktivirali korisnicki racun.";
                	}
		}else{	
			$azuriraj2="UPDATE korisnik SET status='2' WHERE korisnikEmail='$k_email'";
                        if(!$baza->ostaliUpiti($azuriraj2)){
                    		$greske.="Nije azuriran status korisnika da je racun neaktivan!";
                        }
                        $greske.="Nemozete aktivirati racun jer je proslo 24h od vase registracije.";
                 }
         }else{
	    $greske.="Racun je vec aktiviran";
	 }
    }else{
        $greske.="Nepostojeci email";
    }
   
    
    
    if (!empty($greske)){
    header('Location: greske.php?kod='.$greske);
    exit();
    }
    header('refresh:1; url=index.php'); 

  }

include 'header.php';

$smarty->assign('poruka', $poruka);
$smarty->display('predlosci/aktivacija.tpl');


include 'footer.php'; 
?>

      
        

      



