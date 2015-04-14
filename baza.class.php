<?php

class Baza{
    const server="server";
    const baza="db";
    const korisnik="user";
    const lozinka="pass";

    
    function spojiBP(){  
      $mysqli=new mysqli(self::server, self::korisnik, self::lozinka , self::baza); 
      if($mysqli->connect_errno)
      {
         echo "Nuspjesno spajanje na bazu: {$mysqli->connect_errno}, {$mysqli->connect_error}";
      }
      //$mysqli->set_charset('utf8');  
      return $mysqli;    
    }
    
    function prekidBP($veza){
        $prekid=$veza->close();
        return $prekid;
        
    }
   
    function selectUpiti($upit){
       $veza=self::spojiBP(); 
       $veza->query("SET NAMES 'utf8'");
       $veza->query("SET CHARACTER_SET 'utf8'");
       $rezultat=$veza->query($upit)or trigger_error("Greška kod upita: {$upit} - Greška: ".$veza->erorr.''.E_USER_ERORR);
       if(!$rezultat){
           $rezultat=null;
       }
       $veza->close();
       return $rezultat;
    }
    
     function ostaliUpiti($upit){
       $veza= self::spojiBP(); 
       $veza->query("SET NAMES 'utf8'");
       $veza->query("SET CHARACTER_SET 'utf8'");
       if($rezultat=$veza->query($upit)){
          $veza->close();
       }
       else{
         echo "Pogreska: ".$veza->error;
       }
       return  $rezultat;
     } 
     

}
?>
