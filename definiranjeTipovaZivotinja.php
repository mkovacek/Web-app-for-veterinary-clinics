<?php
include_once('aplikacijskiOkvir.php');
$baza=new Baza();
$greske="";
$pom=0;
session_start();
$korisnik = provjeraKorisnika();

if($korisnik->get_vrsta()==1){
  dnevnik_zapis("Definiranje tipova životinja");
  if(isset($_POST['definiranjeTipovaZivotinja'])) {  
    if(empty($_POST['naziv'])){
      $greske.="Unos naziva je obavezan.<br>"; 
    }else{
      $naziv = $_POST['naziv'];
      if (ucfirst($naziv) != $naziv){ 
        $naziv=ucfirst($naziv); 
      }
      $provjera="Select * from tipZivotinje where tipZivotinjeNaziv='$naziv'";
      $rezultat=$baza->selectUpiti($provjera);
      if($rezultat->num_rows!=0){
           $greske.="Ova vrsta životinje je već definirana.<br>";
      }      
    } 

    if (!empty($greske)){   
    header('Location: greske.php?kod='.$greske);
    exit();
    }

     if (empty($greske)) {
      $upit = "insert into tipZivotinje (tipZivotinjeNaziv) values ('$naziv')";
      if (!$baza->ostaliUpiti($upit)){
          $greske.="Greska pri radu s bazom podataka. <br>";
      }else{
          dnevnik_zapis("Uspješno definiran tip životinje");
          $pom=1;
      }
      
   }   
}
    
}else{
    header("Location: greske.php?e=2");
    exit();
}

 include 'headerLogIn.php';
 $skripta="definiranjeTipovaZivotinja.php";
 $smarty->assign('skripta', $skripta);
 $smarty->display('predlosci/definiranjeTipovaZivotinja.tpl');
 
 include 'footer.php';

 if($pom==1){
    echo '<script language="javascript">';
    echo 'alert("Dodali ste novu vrstu životinje.")';
    echo '</script>';
    $pom=0;
 }
 ?>


