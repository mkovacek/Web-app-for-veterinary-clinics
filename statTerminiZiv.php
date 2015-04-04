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
    dnevnik_zapis("Statistika termina po životinjskoj vrsti");
    
          $upitZivotinje="Select tipZivotinjeID,tipZivotinjeNaziv from tipZivotinje";
          if($podaciZivotinje = $baza->selectUpiti($upitZivotinje)){
              while($redZivotinje = $podaciZivotinje->fetch_array()){
                 $ispis2.="<option value='{$redZivotinje['tipZivotinjeID']}'>{$redZivotinje['tipZivotinjeNaziv']}</option>";   
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
        
        if (!isset($_POST["ziv"])) {
            $greske.="Nije odabrana životinjska vrsta. <br>";
        } else {
            $zivotinja=$_POST["ziv"];
        }
        
        $sql="Select terminDatumVrijeme,tipZivotinjeNaziv FROM termin,kartoteka,zivotinja,tipZivotinje 
              where tipZivotinjeID='$zivotinja' and tipZivotinjeID=tipZivotinje_tipZivotinjeID and
              zivotinjaID=zivotinja_zivotinjaID and kartotekaID=kartoteka_kartotekaID and terminDatumVrijeme between '$odDatuma' and '$doDatuma'";
        
        if($podaciDnevnik=$baza->selectUpiti($sql)){ 
            $ispis.="<table class='veterinariAmbulanta'><thead><tr><th width='300'>Termin</th><th width='300'>Životinjska vrsta</th></tr></thead><tbody>";
            while($red = $podaciDnevnik->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['terminDatumVrijeme']."</td>";
              $ispis.="<td>".$red['tipZivotinjeNaziv']."</td>";
              $ispis.='</tr>';
            }
            $ispis.="</tbody></table>";
            $ispisPDF="<div class='row'>
                       <div class='small-3  medium-3  large-3  xlarge-3 columns'>
                       <a href='statTerminiZiv.php?ziv={$zivotinja}&odDat={$odDatuma}&doDat={$doDatuma}' target='_blank' class='button left expand'>PDF</a>
                       </div>
                       </div>";
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
                
        #grafikon
        
        $sqlAmb="Select count(*) as broj FROM termin,kartoteka,zivotinja,tipZivotinje 
              where tipZivotinjeID='$zivotinja' and tipZivotinjeID=tipZivotinje_tipZivotinjeID and
              zivotinjaID=zivotinja_zivotinjaID and kartotekaID=kartoteka_kartotekaID and terminDatumVrijeme between '$odDatuma' and '$doDatuma'";
        $sqlSveAmb="Select count(*) as broj FROM termin,kartoteka,ambulanta 
              where ambulantaID=ambulanta_ambulantaID 
              and kartotekaID=kartoteka_kartotekaID and terminDatumVrijeme between '$odDatuma' and '$doDatuma'";
     
        if($podaciU=$baza->selectUpiti($sqlAmb)){
            $red2=$podaciU->fetch_array();
            $amb=$red2['broj'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }

        if($podaciN=$baza->selectUpiti($sqlSveAmb)){
            $redN=$podaciN->fetch_array();
            $amb2=$redN['broj'];
            $sveAmb=$amb2-$amb;
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
                    ['Odabrana vrsta zivotinje ',$amb],
                    ['Ostale vrste zivotinja',$sveAmb]
                  ]);
                   var options = {'title':'Omjer broja termina odabrane vrste zivotinja i ostalih vrsta zivotinja',
                                 'width':500,
                                 'height':400};
                  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
              }
       </script>";        
    }
    
    if(isset($_GET['ziv'])&& isset($_GET['odDat'])&&isset($_GET['doDat'])){
               #pdf
        $zivotinja2=$_GET['ziv'];
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
        $pdf->Cell(70,6,'Termini',1,0,'L',1);
        $pdf->Cell(40,6,'Zivotinjska vrsta',1,0,'L',1);

       
        $y_axis = $y_axis_initial  + $row_height;


        //initialize counter
        $i = 0;

        //Set maximum rows per page
        $max = 25;

        //Set Row Height
        $row_height = 6;

        $sqlPDF="Select terminDatumVrijeme,tipZivotinjeNaziv FROM termin,kartoteka,zivotinja,tipZivotinje 
              where tipZivotinjeID='$zivotinja2' and tipZivotinjeID=tipZivotinje_tipZivotinjeID and
              zivotinjaID=zivotinja_zivotinjaID and kartotekaID=kartoteka_kartotekaID and terminDatumVrijeme between '$odDatuma2' and '$doDatuma2'";
        
        if($podaciDnevnikPDF=$baza->selectUpiti($sqlPDF)){ 
          
            while($redPDF = $podaciDnevnikPDF->fetch_array()){             
              //If the current row is the last one, create new page and print column title
                if ($i == $max)
                {
                        $pdf->AddPage();

                        //print column titles for the current page
                        $pdf->SetY($y_axis_initial);
                        $pdf->SetX(25);
                        $pdf->Cell(70,6,'Termini',1,0,'L',1);
                        $pdf->Cell(40,6,'Zivotinjska vrsta',1,0,'L',1);

                        //Go to next row
                        $y_axis = $y_axis + $row_height;

                        //Set $i variable to 0 (first row)
                        $i = 0;
                }

                $period = $redPDF['terminDatumVrijeme'];
                $zivVrsta = $redPDF['tipZivotinjeNaziv'];
                

                $pdf->SetY($y_axis);
                $pdf->SetX(25);
                $pdf->Cell(70,6,$period,1,0,'L',1);
                $pdf->Cell(40,6,$zivVrsta,1,0,'L',1);
                

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
    $skripta="statTerminiZiv.php";
    $poc = "01." . date('m.Y');
    $zav = date('d.m.Y');
    $smarty->assign('poc', $poc);
    $smarty->assign('zav', $zav);
    $smarty->assign('ispis', $ispis);
    $smarty->assign('ispis2', $ispis2);
    $smarty->assign('ispisPDF', $ispisPDF);
    $smarty->assign('skripta', $skripta);
    $smarty->display('predlosci/statTerminiZiv.tpl');
    
    include 'footer.php' 
?>

