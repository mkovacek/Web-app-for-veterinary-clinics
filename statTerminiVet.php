<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispis2="";
require('fpdf.php');

if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Statistika termina po veterinarima");
    
          $upitVeterinari="Select korisnikID,korisnikIme,korisnikaPrezime from korisnik where tipKorisnika_tipKorisnikaID=2";
          if($podaciVeterinari = $baza->selectUpiti($upitVeterinari)){
              while($redVeterinari = $podaciVeterinari->fetch_array()){
                 $ispis2.="<option value='{$redVeterinari['korisnikID']}'>{$redVeterinari['korisnikIme']} {$redVeterinari['korisnikaPrezime']}</option>";   
              }
          }
    
      if(isset($_POST['statistika'])){    
    
        
        if (!isset($_POST["odDatuma"])) {
            $greske.="Nije upisan datum. <br>";
        } else {
            $pd = date_create_from_format("d.m.Y", $_POST["odDatuma"]);
            $odDatuma = date_format($pd, "Y.m.d 00:00:00");
        }
        if (!isset($_POST["doDatuma"]) || empty($_POST["doDatuma"])) {
            $doDatuma = date("Y.m.d 23:55:55");
        } else {
            $pd = date_create_from_format("d.m.Y", $_POST["doDatuma"]);
            $doDatuma = date_format($pd, "Y.m.d 23:55:55");
        }
        
        if (!isset($_POST["vet"])) {
            $greske.="Nije odabran veterinar. <br>";
        } else {
            $veterinar=$_POST["vet"];
        }
        
        $sql="Select terminDatumVrijeme,korisnikIme,korisnikaPrezime FROM termin,korisnik 
              where korisnikID='$veterinar' and veterinar='$veterinar' and terminDatumVrijeme between '$odDatuma' and '$doDatuma'";
        
        if($podaciDnevnik=$baza->selectUpiti($sql)){ 
            $ispis.="<table class='veterinariAmbulanta'><thead><tr><th width='200'>Termin</th><th width='200'>Ime</th><th width='200'>Prezime</th></tr></thead><tbody>";
            while($red = $podaciDnevnik->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['terminDatumVrijeme']."</td>";
              $ispis.="<td>".$red['korisnikIme']."</td>";
              $ispis.="<td>".$red['korisnikaPrezime']."</td>";
              $ispis.='</tr>';
            }
            $ispis.="</tbody></table>";
            $ispisPDF="<div class='row'>
           <div class='small-3  medium-3  large-3  xlarge-3 columns'>
           <a href='statTerminiVet.php?vet={$veterinar}&odDat={$odDatuma}&doDat={$doDatuma}' target='_blank' class='button left expand'>PDF</a>
           </div>
           </div>";
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
                
        #grafikon
        
        $sqlAmb="Select count(*) as broj FROM termin,korisnik 
              where korisnikID='$veterinar' and veterinar='$veterinar' and terminDatumVrijeme between '$odDatuma' and '$doDatuma'";
        $sqlSveAmb="Select count(*) as broj FROM termin 
              where veterinar!='$veterinar' and terminDatumVrijeme between '$odDatuma' and '$doDatuma'";
             
        if($podaciU=$baza->selectUpiti($sqlAmb)){
            $red2=$podaciU->fetch_array();
            $amb=$red2['broj'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }

        if($podaciN=$baza->selectUpiti($sqlSveAmb)){
            $redN=$podaciN->fetch_array();
            $sveAmb=$redN['broj'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
    
        echo " <script type='text/javascript' src='https://www.google.com/jsapi'></script>
                <script type='text/javascript'>
                google.load('visualization', '1.0', {'packages':['corechart']});
                google.setOnLoadCallback(drawChart);
                 function drawChart() {

                  // Create the data table.
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Termini');
                  data.addColumn('number', 'Broj termina');
                  data.addRows([
                    ['Odabrani veterinar ', $amb],
                    ['Ostali veterinari', $sveAmb]
                  ]);
                   var options = {'title':'Omjer broja termina odabranog veterinara i ostalih veterinara',
                                 'width':500,
                                 'height':400};
                  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
              }
       </script>";        
    }
    
    if(isset($_GET['vet'])&& isset($_GET['odDat'])&&isset($_GET['doDat'])){
               #pdf
        $veterinar2=$_GET['vet'];
        $odDatuma2=$_GET['odDat'];
        $doDatuma2=$_GET['doDat'];
        
        $pdf=new FPDF();
      #  $pdf->SetMargins(25,65,25);
        $pdf->SetTopMargin(50);
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        //set initial y axis position per page
        $y_axis_initial = 25;

        //print column titles
        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','',12);
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(25);
        $pdf->Cell(60,6,'Termini',1,0,'L',1);
        $pdf->Cell(30,6,'Ime',1,0,'L',1);
        $pdf->Cell(30,6,'Prezime',1,0,'L',1);
       
        $y_axis = $y_axis_initial  + $row_height;


        //initialize counter
        $i = 0;

        //Set maximum rows per page
        $max = 25;

        //Set Row Height
        $row_height = 6;

       /* $sqlPDF="Select terminDatumVrijeme,korisnikIme,korisnikaPrezime FROM termin,kartoteka,ambulanta,korisnik 
              where korisnikID='$veterinar2' and ambulantaID=kartoteka.ambulanta_ambulantaID and
              ambulantaID=korisnik.ambulanta_ambulantaID and kartotekaID=kartoteka_kartotekaID and terminDatumVrijeme between '$odDatuma2' and '$doDatuma2'"; */
        $sqlPDF="Select terminDatumVrijeme,korisnikIme,korisnikaPrezime FROM termin,korisnik 
              where korisnikID='$veterinar2' and veterinar='$veterinar2' and terminDatumVrijeme between '$odDatuma2' and '$doDatuma2'";
        
        if($podaciDnevnikPDF=$baza->selectUpiti($sqlPDF)){ 
          
            while($redPDF = $podaciDnevnikPDF->fetch_array()){             
              //If the current row is the last one, create new page and print column title
                if ($i == $max)
                {
                        $pdf->AddPage();

                        //print column titles for the current page
                        $pdf->SetY($y_axis_initial);
                        $pdf->SetX(25);
                        $pdf->Cell(60,6,'Termini',1,0,'L',1);
                        $pdf->Cell(30,6,'Ime',1,0,'L',1);
                        $pdf->Cell(30,6,'Prezime',1,0,'L',1);

                        //Go to next row
                        $y_axis = $y_axis + $row_height;

                        //Set $i variable to 0 (first row)
                        $i = 0;
                }

                $termini = $redPDF['terminDatumVrijeme'];
                $ime = $redPDF['korisnikIme'];
                $prezime = $redPDF['korisnikaPrezime'];

                $pdf->SetY($y_axis);
                $pdf->SetX(25);
                $pdf->Cell(60,6,$termini,1,0,'L',1);
                $pdf->Cell(30,6,$ime,1,0,'L',1);
                $pdf->Cell(30,6,$prezime,1,0,'L',1);

                //Go to next row
                $y_axis = $y_axis + $row_height;
                $i = $i + 1;
              
              
            }
            $pdf->Output();
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
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
    $skripta="statTerminiVet.php";
    $poc = "01." . date('m.Y');
    $zav = date('d.m.Y');
    $smarty->assign('poc', $poc);
    $smarty->assign('zav', $zav);
    $smarty->assign('ispis', $ispis);
    $smarty->assign('ispis2', $ispis2);
    $smarty->assign('ispisPDF', $ispisPDF);
    $smarty->assign('skripta', $skripta);
    $smarty->display('predlosci/statTerminiVet.tpl');
    
    include 'footer.php' 
?>

