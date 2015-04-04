<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispis2="";
$br1=0;$br2=0;$br3=0;$br4=0;$br5=0;$br6=0;$br7=0;$br8=0;$br9=0;$br10=0;$br12=0;$br13=0;$br14=0;$br15=0;$br16=0;
$br17=0;$br18=0;$br19=0;$br20=0;
require('fpdf.php');

if($korisnik->get_vrsta()==2){
    dnevnik_zapis("Statistika bolesti po ambulantama");
    
          $upitAmbulante="Select ambulantaID,ambulantaNaziv from ambulanta";
          if($podaciAmbulanta = $baza->selectUpiti($upitAmbulante)){
              while($redAmbulanta = $podaciAmbulanta->fetch_array()){
                 $ispis2.="<option value='{$redAmbulanta['ambulantaID']}'>{$redAmbulanta['ambulantaNaziv']}</option>";   
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
        
        if (!isset($_POST["amb"])) {
            $greske.="Nije odabrana ambulanta. <br>";
        } else {
            $ambulanta=$_POST["amb"];
        }

        $sql="Select popisBolestiID,popisBolestiNaziv,ambulantaNaziv, datumVrijemePregleda FROM popisBolesti,utvrdenaBolest,kartotekaDetalji,kartoteka,ambulanta 
              where ambulantaID='$ambulanta' and ambulantaID=ambulanta_ambulantaID 
              and kartoteka.kartotekaID=kartotekaDetalji.kartotekaID and kartotekaDetaljiID=kartotekaDetalji_kartotekaDetaljiID
              and popisBolesti_popisBolestiID=popisBolestiID and datumVrijemePregleda between '$odDatuma' and '$doDatuma'";
        
        if($podaciDnevnik=$baza->selectUpiti($sql)){ 
            $ispis.="<table class='veterinariAmbulanta'><thead><tr><th width='300'>Naziv</th><th width='300'>Datum i vrijeme</th><th width='300'>Ambulanta</th></tr></thead><tbody>";
            while($red = $podaciDnevnik->fetch_array()){
              $ispis.='<tr>';
              if($red['popisBolestiID']==1){
                  $br1=$br1+1;
              }elseif($red['popisBolestiID']==2){
                  $br2=$br2+1;  
              }elseif($red['popisBolestiID']==3){
                  $br3=$br3+1;  
              }elseif ($red['popisBolestiID']==4){
                  $br4=$br4+1;  
              }elseif ($red['popisBolestiID']==5){
                  $br5=$br5+1;  
              }elseif ($red['popisBolestiID']==6){
                  $br6=$br6+1;  
              }elseif ($red['popisBolestiID']==7){
                  $br7=$br7+1;  
              }elseif ($red['popisBolestiID']==8){
                  $br8=$br8+1;  
              }elseif ($red['popisBolestiID']==9){
                  $br9=$br9+1;  
              }elseif ($red['popisBolestiID']==10){
                  $br10=$br10+1;  
              }elseif ($red['popisBolestiID']==12){
                  $br12=$br12+1;  
              }elseif ($red['popisBolestiID']==13){
                  $br13=$br13+1;  
              }elseif ($red['popisBolestiID']==14){
                  $br14=$br14+1;  
              }elseif ($red['popisBolestiID']==15){
                  $br15=$br15+1;  
              }elseif ($red['popisBolestiID']==16){
                  $br16=$br16+1;  
              }elseif ($red['popisBolestiID']==17){
                  $br17=$br17+1;  
              }elseif ($red['popisBolestiID']==18){
                  $br18=$br18+1;  
              }elseif ($red['popisBolestiID']==19){
                  $br19=$br19+1;  
              }elseif ($red['popisBolestiID']==20){
                  $br20=$br20+1;  
              }
              
              
              $ispis.="<td>".$red['popisBolestiNaziv']."</td>";
              $ispis.="<td>".$red['datumVrijemePregleda']."</td>";
              $ispis.="<td>".$red['ambulantaNaziv']."</td>";
              $ispis.='</tr>';
              
            }
            $ispis.="</tbody></table>";
            $ispisPDF="<div class='row'>
                       <div class='small-3  medium-3  large-3  xlarge-3 columns'>
                       <a href='statBolestiAmb.php?amb={$ambulanta}&odDat={$odDatuma}&doDat={$doDatuma}' target='_blank' class='button left expand'>PDF</a>
                       </div>
                       </div>";
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
                  data.addColumn('string', 'Bolesti');
                  data.addColumn('number', 'Broj bolesti');
                  data.addRows([
                    ['Bjesnoca ', $br1],
                    ['Leptospiroza',$br2],
                    ['Kriptosporidioza', $br3],
                    ['Suga',$br4],
                    ['Trihineloza', $br5],
                    ['Klamidioza',$br6],
                    ['Bruceloza', $br7],
                    ['Salmoneloza',$br8],
                    ['Giardijaza', $br9],
                    ['Lajmska bolest',$br10],
                    ['Macja kuga',$br12],
                    ['Parvoviroza', $br13],
                    ['Leptospiroza',$br14],
                    ['Macja prehlada', $br15],
                    ['Macji infekcijski peritonitis',$br16],
                    ['Toksoplazmoza', $br17],
                    ['Mikrosporija',$br18],
                    ['Gliste', $br19],
                    ['Stenecak',$br20]    
                  ]);
                   var options = {'title':'Broj pojava pojedine bolesti po ambulanti',
                                 'width':500,
                                 'height':400};
                  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
              }
       </script>";   
       
    }
    
    if(isset($_GET['amb'])&& isset($_GET['odDat'])&&isset($_GET['doDat'])){
               #pdf
        $ambulanta2=$_GET['amb'];
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
        $pdf->Cell(30,6,'Naziv bolesti',1,0,'L',1);
        $pdf->Cell(60,6,'Datum i vrijeme pregleda',1,0,'L',1);
        $pdf->Cell(70,6,'Ambulanta',1,0,'L',1);

       
        $y_axis = $y_axis_initial  + $row_height;


        //initialize counter
        $i = 0;

        //Set maximum rows per page
        $max = 25;

        //Set Row Height
        $row_height = 6;

        $sqlPDF="Select popisBolestiID,popisBolestiNaziv,ambulantaNaziv, datumVrijemePregleda FROM popisBolesti,utvrdenaBolest,kartotekaDetalji,kartoteka,ambulanta 
              where ambulantaID='$ambulanta2' and ambulantaID=ambulanta_ambulantaID 
              and kartoteka.kartotekaID=kartotekaDetalji.kartotekaID and kartotekaDetaljiID=kartotekaDetalji_kartotekaDetaljiID
              and utvrdenaBolestID=popisBolestiID and datumVrijemePregleda between '$odDatuma2' and '$doDatuma2'";
        
        if($podaciDnevnikPDF=$baza->selectUpiti($sqlPDF)){ 
          
            while($redPDF = $podaciDnevnikPDF->fetch_array()){             
              //If the current row is the last one, create new page and print column title
                if ($i == $max)
                {
                        $pdf->AddPage();

                        //print column titles for the current page
                        $pdf->SetY($y_axis_initial);
                        $pdf->SetX(25);
                        $pdf->Cell(30,6,'Naziv bolesti',1,0,'L',1);
                        $pdf->Cell(60,6,'Datum i vrijeme pregleda',1,0,'L',1);
                        $pdf->Cell(70,6,'Ambulanta',1,0,'L',1);

                        //Go to next row
                        $y_axis = $y_axis + $row_height;

                        //Set $i variable to 0 (first row)
                        $i = 0;
                }

                $bolest = $redPDF['popisBolestiNaziv'];
                $period = $redPDF['datumVrijemePregleda'];
                $ambulanta = $redPDF['ambulantaNaziv'];

                $pdf->SetY($y_axis);
                $pdf->SetX(25);
                $pdf->Cell(30,6,$bolest,1,0,'L',1);
                $pdf->Cell(60,6,$period,1,0,'L',1);
                $pdf->Cell(70,6,$ambulanta,1,0,'L',1);

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
    $skripta="statBolestiAmb.php";
    $poc = "01." . date('m.Y');
    $zav = date('d.m.Y');
    $smarty->assign('poc', $poc);
    $smarty->assign('zav', $zav);
    $smarty->assign('ispis', $ispis);
    $smarty->assign('ispis2', $ispis2);
    $smarty->assign('ispisPDF', $ispisPDF);
    $smarty->assign('skripta', $skripta);
    $smarty->display('predlosci/statBolestiAmb.tpl');
    
    include 'footer.php' 
?>

