<?php
    include_once('aplikacijskiOkvir.php'); 


    function virtualnoVrijeme(){
            $baza=new Baza();
            $sql="SELECT pomak FROM vrijeme WHERE vrijemeID='1'";
            if($podaci=$baza->selectUpiti($sql)){
                $red=$podaci->fetch_array();
                $virtualno_vrijeme = time() + (intval($red['pomak']) * 60 * 60);
                return $virtualno_vrijeme;
            }else{
                $greske.="Greska pri radu s bazom podataka. <br>";
            }
    }
    
?>