<?php
include_once('aplikacijskiOkvir.php');
include_once('vrijeme.php');
session_start();
$baza=new Baza();
$korisnik = provjeraKorisnika();

 if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Podešavanje virtualnog vremena");
    
    if(isset($_POST['pomak'])){
		$url = "http://arka.foi.hr/PzaWeb/PzaWeb2004/config/pomak.xml";      
		if(! ($fp = fopen($url,'r'))) {
		  echo "Problem: nije moguće otvoriti xml" ;
		  exit;
		}

		$xml_string = fread($fp, 10000);
		fclose($fp);

		$domdoc = new DOMDocument;
		$domdoc->loadXML($xml_string);

		$params = $domdoc->getElementsByTagName('pomak');
		$sati = 0;

		foreach ($params as $param) {
			$attributes = $param->attributes;
			foreach ($attributes as $attr => $val) {
				if($attr == "brojSati") {
				$sati = $val->value;
				}
			}
		}
		
                $sql="UPDATE vrijeme set pomak='$sati' where vrijemeID='1'";
                if(!$baza->ostaliUpiti($sql)){
                    $greske.="Greska pri radu s bazom podataka. <br>";
                }
	}
        $stvarnoVrijeme=date('Y-m-d H:i:s');
	$virtVrijeme = virtualnoVrijeme();
        $virtualnoVrijeme=date('Y-m-d H:i:s',$virtVrijeme);
    
 }else{
   header("Location: greske.php?e=2");
   exit();  
}

include 'headerLogIn.php';
$smarty->assign('stvarnoVrijeme', $stvarnoVrijeme);
$smarty->assign('virtualnoVrijeme', $virtualnoVrijeme);
$smarty->display('predlosci/virtualnoVrijeme.tpl');
include 'footer.php' 
?>
