<?php
include_once('aplikacijskiOkvir.php'); 
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$ispis2="";
require('fpdf.php');

if($korisnik->get_vrsta()==1){
    dnevnik_zapis("Statistika admin");
    
      if(isset($_POST['statistika'])){    
    
        if (!isset($_POST["korisnik"]) || $_POST["korisnik"] == "") {
            $kor_ime = "%";
        } else {
            $kor_ime = $_POST["korisnik"];
        }
        
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


        $sql = "select korisnik, adresa, skripta, tekst, vrijeme FROM dnevnik " .
                "WHERE korisnik like '" . $kor_ime . "' and " .
                "vrijeme between '" . $odDatuma . "' and '" . $doDatuma . "'
                 and tekst like 'Uspješna prijava' ";
        
        if($podaciDnevnik=$baza->selectUpiti($sql)){
            $ispis="<span class='label' style='width: 100%; margin-top: 10px; margin-bottom: 10px'><h5 class='text-center' style='color:white'>Uspješne prijave</h5></span>"; 
            $ispis.="<table id='tab1' class='veterinariAmbulanta'><thead><tr><th width='70'>Korisnik</th><th width='100'>Adresa</th><th width='200'>Skripta</th><th width='100'>Tekst</th><th width='60'>Vrijeme</th></tr></thead><tbody>";
            while($red = $podaciDnevnik->fetch_array()){
              $ispis.='<tr>';
              $ispis.="<td>".$red['korisnik']."</td>";
              $ispis.="<td>".$red['adresa']."</td>";
              $ispis.="<td>".$red['skripta']."</td>";
              $ispis.="<td>".$red['tekst']."</td>";
              $ispis.="<td>".$red['vrijeme']."</td>";
              $ispis.='</tr>';
            }
            $ispis.="</tbody></table>";
            $ispisPDF="<div class='row'>
           <div class='small-3  medium-3  large-3  xlarge-3 columns'>
           <a href='statistikaAdmin.php?kor={$kor_ime}&odDat={$odDatuma}&doDat={$doDatuma}' target='_blank' class='button left expand'>PDF</a>
           </div>
           </div>";
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
        
        $sql2 = "select korisnik, adresa, skripta, tekst, vrijeme FROM dnevnik " .
        "WHERE vrijeme between '" . $odDatuma . "' and '" . $doDatuma . "'
         and tekst like 'Neuspješna prijava' ";
        
        if($podaciDnevnik2=$baza->selectUpiti($sql2)){
            $ispis2="<span class='label' style='width: 100%; margin-top: 10px; margin-bottom: 10px'><h5 class='text-center' style='color:white'>Neuspješne prijave</h5></span>"; 
            $ispis2.="<table class='veterinariAmbulanta'><thead><tr><th width='70'>Korisnik</th><th width='100'>Adresa</th><th width='200'>Skripta</th><th width='100'>Tekst</th><th width='60'>Vrijeme</th></tr></thead><tbody>";
            while($red = $podaciDnevnik2->fetch_array()){
              $ispis2.='<tr>';
              $ispis2.="<td>".$red['korisnik']."</td>";
              $ispis2.="<td>".$red['adresa']."</td>";
              $ispis2.="<td>".$red['skripta']."</td>";
              $ispis2.="<td>".$red['tekst']."</td>";
              $ispis2.="<td>".$red['vrijeme']."</td>";
              $ispis2.='</tr>';
            }
            $ispis2.="</tbody></table>";
            $ispisPDF2="<div class='row'>
           <div class='small-3  medium-3  large-3  xlarge-3 columns'>
           <a href='statistikaAdmin.php?odDat2={$odDatuma}&doDat2={$doDatuma}&kor={$red['korisnik']}' target='_blank' class='button left expand'>PDF</a>
           </div>
           </div>";
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
        
        #grafikoni
        
        $sqlUspješno="SELECT count(*) as broj FROM dnevnik WHERE tekst='Uspješna prijava'";
        $sqlNeuspješno="SELECT count(*) as broj FROM dnevnik WHERE tekst='Neuspješna prijava'";
        if($podaciU=$baza->selectUpiti($sqlUspješno)){
            $red=$podaciU->fetch_array();
            $uspješno=$red['broj'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }

        if($podaciN=$baza->selectUpiti($sqlNeuspješno)){
            $redN=$podaciN->fetch_array();
            $neuspješno=$redN['broj'];
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
                  data.addColumn('string', 'Vrsta');
                  data.addColumn('number', 'Prijave');
                  data.addRows([
                    ['Uspjesne prijave', $uspješno],
                    ['Neuspjesne prijave', $neuspješno]
                  ]);
                   var options = {'title':'Omjer uspjesnih i neuspjesnih prijava',
                                 'width':500,
                                 'height':400};
                  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
              }
       </script>";
        
        
        $sql3 = "select count(*) as br FROM dnevnik " .
                "WHERE korisnik like '" . $kor_ime . "' and " .
                "vrijeme between '" . $odDatuma . "' and '" . $doDatuma . "'
                 and tekst like 'Uspješna prijava' ";
        
        if($podaciDnevnik3=$baza->selectUpiti($sql3)){
            $red3 = $podaciDnevnik3->fetch_array();
            $broj=$red3['br'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
        
        $sql4 = "select count(*) as br FROM dnevnik " .
                "WHERE vrijeme between '" . $odDatuma . "' and '" . $doDatuma . "'
                 and tekst like 'Neuspješna prijava' ";
        
        if($podaciDnevnik4=$baza->selectUpiti($sql4)){
            $red4 = $podaciDnevnik4->fetch_array();
            $broj2=$red4['br'];
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
        
       echo "
            <script type='text/javascript'>
            google.load('visualization', '1.0', {'packages':['corechart']});
            google.setOnLoadCallback(drawChart2);
            function drawChart2() {
                var data2 = new google.visualization.arrayToDataTable([
                        ['Period', '$kor_ime','Nuspješne prijave(svi korisnici)'],
                        ['$odDatuma do $doDatuma', $broj,$broj2 ],
                        ]);
                var options = {
                   title: 'Broj prijava',
                   'width':500,
                   'height':400,
                   hAxis: {title: 'Peroid'}
                 };

                var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
                chart2.draw(data2, options);
            }
            </script>";
      }
      
       if(isset($_GET['kor'])&& isset($_GET['odDat'])&&isset($_GET['doDat'])){
               #pdf
        $kor_ime2=$_GET['kor'];
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
        $pdf->Cell(40,6,'Korisnik',1,0,'L',1);
        $pdf->Cell(60,6,'Tekst',1,0,'L',1);
        $pdf->Cell(70,6,'Vrijeme',1,0,'L',1);
       
        $y_axis = $y_axis_initial  + $row_height;


        //initialize counter
        $i = 0;

        //Set maximum rows per page
        $max = 25;

        //Set Row Height
        $row_height = 6;

        $sqlPDF="select korisnik,tekst,vrijeme FROM dnevnik " .
                "WHERE korisnik like '" .$kor_ime2. "' and " .
                "vrijeme between '" .$odDatuma2. "' and '" . $doDatuma2 . "'
                 and tekst like 'Uspješna prijava' ";    
    
    
            if($podaciDnevnikPDF=$baza->selectUpiti($sqlPDF)){ 
          
            while($redPDF = $podaciDnevnikPDF->fetch_array()){             
              //If the current row is the last one, create new page and print column title
                if ($i == $max)
                {
                        $pdf->AddPage();

                        //print column titles for the current page
                        $pdf->SetY($y_axis_initial);
                        $pdf->SetX(25);
                        $pdf->Cell(40,6,'Korisnik',1,0,'L',1);
                        $pdf->Cell(60,6,'Tekst',1,0,'L',1);
                        $pdf->Cell(70,6,'Vrijeme',1,0,'L',1);

                        //Go to next row
                        $y_axis = $y_axis + $row_height;

                        //Set $i variable to 0 (first row)
                        $i = 0;
                }

                $korisnik = $redPDF['korisnik'];
                $tekst = $redPDF['tekst'];
                $vrijeme = $redPDF['vrijeme'];

                $pdf->SetY($y_axis);
                $pdf->SetX(25);
                $pdf->Cell(40,6,$korisnik,1,0,'L',1);
                $pdf->Cell(60,6,$tekst,1,0,'L',1);
                $pdf->Cell(70,6,$vrijeme,1,0,'L',1);

                //Go to next row
                $y_axis = $y_axis + $row_height;
                $i = $i + 1;
              
              
            }
            $pdf->Output();
        }else{
            $greske.="Greska pri radu s bazom podataka. <br>";
        }
    }
    
     if(isset($_GET['odDat2'])&&isset($_GET['doDat2'])){
               #pdf
        $odDatuma3=$_GET['odDat2'];
        $doDatuma3=$_GET['doDat2'];
        
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
        $pdf->Cell(40,6,'Korisnik',1,0,'L',1);
        $pdf->Cell(60,6,'Tekst',1,0,'L',1);
        $pdf->Cell(70,6,'Vrijeme',1,0,'L',1);
       
        $y_axis = $y_axis_initial  + $row_height;


        //initialize counter
        $i = 0;

        //Set maximum rows per page
        $max = 25;

        //Set Row Height
        $row_height = 6;

        $sqlPDF="select korisnik, adresa, skripta, tekst, vrijeme FROM dnevnik " .
        "WHERE vrijeme between '" . $odDatuma3 . "' and '" . $doDatuma3 . "'
         and tekst like 'Neuspješna prijava' ";
        
        if($podaciDnevnikPDF=$baza->selectUpiti($sqlPDF)){ 
          
            while($redPDF = $podaciDnevnikPDF->fetch_array()){             
              //If the current row is the last one, create new page and print column title
                if ($i == $max)
                {
                        $pdf->AddPage();

                        //print column titles for the current page
                        $pdf->SetY($y_axis_initial);
                        $pdf->SetX(25);
                        $pdf->Cell(40,6,'Korisnik',1,0,'L',1);
                        $pdf->Cell(60,6,'Tekst',1,0,'L',1);
                        $pdf->Cell(70,6,'Vrijeme',1,0,'L',1);

                        //Go to next row
                        $y_axis = $y_axis + $row_height;

                        //Set $i variable to 0 (first row)
                        $i = 0;
                }

                $korisnik = $redPDF['korisnik'];
                $tekst = $redPDF['tekst'];
                $vrijeme = $redPDF['vrijeme'];

                $pdf->SetY($y_axis);
                $pdf->SetX(25);
                $pdf->Cell(40,6,$korisnik,1,0,'L',1);
                $pdf->Cell(60,6,$tekst,1,0,'L',1);
                $pdf->Cell(70,6,$vrijeme,1,0,'L',1);

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
    $skripta="statistikaAdmin.php";
    $poc = "01." . date('m.Y');
    $zav = date('d.m.Y');
    $smarty->assign('poc', $poc);
    $smarty->assign('zav', $zav);
    $smarty->assign('ispis', $ispis);
    $smarty->assign('ispis2', $ispis2);
    $smarty->assign('ispisPDF', $ispisPDF);
    $smarty->assign('ispisPDF2', $ispisPDF2);
    $smarty->assign('skripta', $skripta);
    $smarty->display('predlosci/statistikaAdmin.tpl');
    
    include 'footer.php' 
?>

