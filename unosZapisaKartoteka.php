<?php
include_once('aplikacijskiOkvir.php'); 
include_once('vrijeme.php');
session_start();
$greske="";
$baza=new Baza();
$korisnik = provjeraKorisnika();
$ispis="";
$simptom="";
$bolest="";
$terapijaOpis="";
$terapijaCijena="";
$termin="";
if($korisnik->get_vrsta()==2){
    $veterinar=$korisnik->get_id();
    dnevnik_zapis("Unos zapisa u kartoteku");
    if (isset($_GET['idKartoteka'])){
        $idKartoteka=$_GET['idKartoteka'];
        $provjeraUnosaStatusa="Select kartotekaDetaljiID,kartotekaID,status from kartotekaDetalji
                               where kartotekaDetaljiID=(Select MAX(kartotekaDetaljiID)from kartotekaDetalji 
                               where kartotekaID='$idKartoteka')";
        $podaci=$baza->selectUpiti($provjeraUnosaStatusa);
        if($podaci){
            if($podaci->num_rows==1){
               # echo "znaci postoji zadnji detalj kartoteke, sad samo treba ispitati status";
                $red = $podaci->fetch_array();
                $kartDetaljiID=$red['kartotekaDetaljiID'];
                $kartID=$red['kartotekaID'];
                $status=$red['status'];
                
                if($status==0){
                    dnevnik_zapis("Unos u nedovršeni zapisa kartoteke");
                  #  echo "još nije dovršen detealj kart. otvori postojeći";
                    $upitDohvatiZapisSimptom="Select simptomOpis from kartotekaDetalji,simptom where kartotekaDetaljiID='$kartDetaljiID'
                                              and kartotekaDetaljiID=kartotekaDetalji_kartotekaDetaljiID";
                    $podaciSimptom=$baza->selectUpiti($upitDohvatiZapisSimptom);
                    if($podaciSimptom){
                        if($podaciSimptom->num_rows==1){
                            $redSimptom = $podaciSimptom->fetch_array();
                            $simptom=$redSimptom['simptomOpis']; 
                            $simptomAttr="name='simptomPostoji' readonly";                         
                        }else{
                            $simptomAttr="name='simptom' required";
                            
                        }
                    }else{
                     
                      $greske.="Greška kod rada sa bazom.<br>";  
                    }
                    
                    $upitDohvatiZapisBolest="Select popisBolestiNaziv from kartotekaDetalji,utvrdenaBolest,popisBolesti
                                             where kartotekaDetaljiID='$kartDetaljiID' and kartotekaDetaljiID=kartotekaDetalji_kartotekaDetaljiID 
                                             and popisBolestiID=popisBolesti_popisBolestiID";
                    $podaciBolest=$baza->selectUpiti($upitDohvatiZapisBolest);
                    if($podaciBolest){ #drugačije pazi input/select type
                        if($podaciBolest->num_rows==1){
                            $redBolest= $podaciBolest->fetch_array();
                            $bolest=$redBolest['popisBolestiNaziv'];
                            $bolestAttr="<input type='text' id='bolest' name='bolestPostoji' value='$bolest'>";
                        }else{
                            $bolestAttr="<select id='bolest' name='bolest'><option selected='selected' disabled='disabled'>Popis bolesti</option>";
                            $upitPopisBolesti="Select * from popisBolesti";
                            $podaciPopisBolest=$baza->selectUpiti($upitPopisBolesti);
                            if( $podaciPopisBolest){
                                while ($redPopisBolesti=$podaciPopisBolest->fetch_array()){
                                   $bolestAttr.="<option value='{$redPopisBolesti['popisBolestiID']}'>{$redPopisBolesti['popisBolestiNaziv']}</option>"; 
                                }
                                $bolestAttr.="</select>";   
                            }else{
                              $greske.="Greška kod rada sa bazom.<br>";    
                            }   
                        }   
                    }else{
                      $greske.="Greška kod rada sa bazom.<br>";  
                    }
                    
                    $upitDohvatiZapisTerapija="Select terapijaOpis,terapijaCijena from kartotekaDetalji,terapija where kartotekaDetaljiID='$kartDetaljiID'
                                              and kartotekaDetaljiID=kartotekaDetalji_kartotekaDetaljiID";
                    $podaciTerapija=$baza->selectUpiti($upitDohvatiZapisTerapija);
                    if($podaciTerapija){
                        if($podaciTerapija->num_rows==1){
                            $redTerapija= $podaciTerapija->fetch_array();
                            $terapijaOpis=$redTerapija['terapijaOpis'];
                            $terapijaOpisAttr="name='terapijaOpisPostoji' readonly";
                            $terapijaCijena=$redTerapija['terapijaCijena'];
                            if($terapijaCijena==null){
                                $terapijaCijenaAttr="name='cijenaTerapija'";
                            }else{
                                $terapijaCijenaAttr="name='terapijaCijenaPostoji' readonly value=$terapijaCijena";
                            }
                            
                        }else{
                            $terapijaOpisAttr="name='terapija'";
                            $terapijaCijenaAttr="name='cijenaTerapija'";
                        }   
                    }else{
                      $greske.="Greška kod rada sa bazom.<br>";  
                    }
                    
                    $upitDohvatiZapisTermin="Select terminDatumVrijeme from kartotekaDetalji,kartoteka,termin where kartotekaDetaljiID='$kartDetaljiID'
                                             and kartoteka.kartotekaID=kartotekaDetalji.kartotekaID and kartoteka.kartotekaID=termin.kartoteka_kartotekaID and termin.status=0";
                    $podaciTermin=$baza->selectUpiti($upitDohvatiZapisTermin);
                    if($podaciTermin){ #drugacije input type je različit
                        if($podaciTermin->num_rows==1){
                            $redTermin= $podaciTermin->fetch_array();
                            $termin=$redTermin['terminDatumVrijeme'];
                            $terminAttr="name='terminPostoji' readonly value='$termin'";
                            $terminType="text";
                        }else{
                            $terminAttr="name='termin'";
                            $terminType="datetime-local";
                        }   
                    }else{
                      $greske.="Greška kod rada sa bazom.<br>";  
                    }
                }else{
                    dnevnik_zapis("Unos novog zapisa kartoteke");
                    $simptomAttr="name='simptom' required";
                    $terapijaOpisAttr="name='terapija'";
                    $terapijaCijenaAttr="name='cijenaTerapija'";
                    $terminAttr="name='termin'";
                    $terminType="datetime-local";
                    $virtVrijeme = virtualnoVrijeme();
                    $virtualnoVrijeme=date('Y-m-d H:i:s',$virtVrijeme);
                    
                    $upitKreirajDetalj="Insert into kartotekaDetalji(kartotekaID,datumVrijemePregleda) values('$kartID', '$virtualnoVrijeme')";
                    if(!$baza->ostaliUpiti($upitKreirajDetalj)){
                        $greske.="Greška kod rada sa bazom.<br>";   
                    }
                    
                    #dohvati novo kreirani ID detalja
                    $getIDdetalja="Select kartotekaDetaljiID,kartotekaID,status from kartotekaDetalji
                                   where kartotekaDetaljiID=(Select MAX(kartotekaDetaljiID)from kartotekaDetalji 
                                   where kartotekaID='$idKartoteka')";
                    $podaciID=$baza->selectUpiti($getIDdetalja);
                    $redID=$podaciID->fetch_array();
                    $kartDetaljiID=$redID['kartotekaDetaljiID'];
                    
                    $bolestAttr="<select id='bolest' name='bolest'><option selected='selected' disabled='disabled'>Popis bolesti</option>";
                    $upitPopisBolesti="Select * from popisBolesti";
                    $podaciPopisBolest=$baza->selectUpiti($upitPopisBolesti);
                    if( $podaciPopisBolest){
                        while ($redPopisBolesti=$podaciPopisBolest->fetch_array()){
                           $bolestAttr.="<option value='{$redPopisBolesti['popisBolestiID']}'>{$redPopisBolesti['popisBolestiNaziv']}</option>"; 
                        }
                        $bolestAttr.="</select>";   
                    }else{
                      $greske.="Greška kod rada sa bazom.<br>";    
                    }   
                }
            }else{
                dnevnik_zapis("Unos u nedovršeni zapisa kartoteke");
                $simptomAttr="name='simptom' required";
                $terapijaOpisAttr="name='terapija'";
                $terapijaCijenaAttr="name='cijenaTerapija'";
                $terminAttr="name='termin'";
                $terminType="datetime-local";
                $virtVrijeme = virtualnoVrijeme();
                $virtualnoVrijeme=date('Y-m-d H:i:s',$virtVrijeme);
                                                                                                            #kartID
                $upitKreirajDetalj="Insert into kartotekaDetalji(kartotekaID,datumVrijemePregleda) values('$idKartoteka', '$virtualnoVrijeme')";
                if(!$baza->ostaliUpiti($upitKreirajDetalj)){
                    $greske.="Greška kod rada sa bazom.<br>";   
                }
                
                #dohvati novo kreirani ID detalja
                    $getIDdetalja="Select kartotekaDetaljiID,kartotekaID,status from kartotekaDetalji
                                   where kartotekaDetaljiID=(Select MAX(kartotekaDetaljiID)from kartotekaDetalji 
                                   where kartotekaID='$idKartoteka')";
                    $podaciID=$baza->selectUpiti($getIDdetalja);
                    $redID=$podaciID->fetch_array();
                    $kartDetaljiID=$redID['kartotekaDetaljiID'];
                
                $bolestAttr="<select id='bolest' name='bolest'><option selected='selected' disabled='disabled'>Popis bolesti</option>";
                    $upitPopisBolesti="Select * from popisBolesti";
                    $podaciPopisBolest=$baza->selectUpiti($upitPopisBolesti);
                    if( $podaciPopisBolest){
                        while ($redPopisBolesti=$podaciPopisBolest->fetch_array()){
                           $bolestAttr.="<option value='{$redPopisBolesti['popisBolestiID']}'>{$redPopisBolesti['popisBolestiNaziv']}</option>"; 
                        }
                        $bolestAttr.="</select>";   
                    }else{
                      $greske.="Greška kod rada sa bazom.<br>";    
                    }     
            }  
        }else{
           $greske.="Greška kod rada sa bazom.<br>";    
        }
    }
    if (isset($_POST['unosZapisaKartoteka'])){
        $idKartotekaDetalj=$_GET['idkartDet'];
        $idKartotekaT=$_GET['idKartoteka'];
        if(isset($_POST['simptom'])){
            if(!empty($_POST['simptom'])){
                $simptomUnos=$_POST['simptom'];
                $simptomUnosUpit="Insert into simptom(simptomOpis,kartotekaDetalji_kartotekaDetaljiID) values('$simptomUnos','$idKartotekaDetalj')";
                if(!$baza->ostaliUpiti($simptomUnosUpit)){
                    $greske.="Greška kod rada sa bazom.<br>";
                }else{
                    dnevnik_zapis("Unosen simptom");
                }  
            }
            
        }
        if(isset($_POST['bolest'])){
            if(!empty($_POST['bolest'])){
                #$veterinar=$korisnik->get_id();
                $bolestUnos=$_POST['bolest'];
                $bolestUnosUpit="Insert into utvrdenaBolest(kartotekaDetalji_kartotekaDetaljiID,popisBolesti_popisBolestiID,veterinar) values('$idKartotekaDetalj','$bolestUnos','$veterinar')";
                if(!$baza->ostaliUpiti($bolestUnosUpit)){
                    $greske.="Greška kod rada sa bazom.<br>";
                }else{
                    dnevnik_zapis("Unesena bolest");
                }    
            } 
        }
        if(isset($_POST['terapija'])){
            if(!empty($_POST['terapija'])){
                $terapijaUnos=$_POST['terapija'];
                $upitProvjeraTerapija="Select kartotekaDetalji_kartotekaDetaljiID from terapija where kartotekaDetalji_kartotekaDetaljiID='$idKartotekaDetalj'";
                if($podaciProvjeraTerapija=$baza->selectUpiti($upitProvjeraTerapija)){
                    if($podaciProvjeraTerapija->num_rows==1){
                        #update
                        $terapijaUnosUpit="Update terapija set terapijaOpis='$terapijaUnos' where kartotekaDetalji_kartotekaDetaljiID='$idKartotekaDetalj'";
                        if(!$baza->ostaliUpiti($terapijaUnosUpit)){
                            $greske.="Greška kod rada sa bazom.<br>";
                        }else{
                            dnevnik_zapis("Unosen opis terapije");
                        }      
                    }else{
                        #insert
                        $terapijaUnosUpit="Insert into terapija(terapijaOpis,kartotekaDetalji_kartotekaDetaljiID) values ('$terapijaUnos','$idKartotekaDetalj')";
                        if(!$baza->ostaliUpiti($terapijaUnosUpit)){
                            $greske.="Greška kod rada sa bazom.<br>";
                        }else{
                            dnevnik_zapis("Unosen opis terapije");
                        }  
                    }
                }
            }
        }
        if(isset($_POST['cijenaTerapija'])){
            if(!empty($_POST['cijenaTerapija'])){
                $terapijaCijenaUnos=$_POST['cijenaTerapija'];
                $upitProvjeraCijenaTerapija="Select kartotekaDetalji_kartotekaDetaljiID from terapija where kartotekaDetalji_kartotekaDetaljiID='$idKartotekaDetalj'";
                    if($podaciProvjeraCijenaTerapija=$baza->selectUpiti($upitProvjeraCijenaTerapija)){
                        if($podaciProvjeraCijenaTerapija->num_rows==1){
                            #update
                            $terapijaCijenaUnosUpit="Update terapija set terapijaCijena='$terapijaCijenaUnos' where kartotekaDetalji_kartotekaDetaljiID='$idKartotekaDetalj'";
                            if(!$baza->ostaliUpiti($terapijaCijenaUnosUpit)){
                                $greske.="Greška kod rada sa bazom.<br>";
                            }else{
                                dnevnik_zapis("Unosena cijena terapije");
                            }      
                        }else{
                            #insert
                            $terapijaCijenaUnosUpit="Insert into terapija(terapijaCijena,kartotekaDetalji_kartotekaDetaljiID) values ('$terapijaCijenaUnos','$idKartotekaDetalj')";
                            if(!$baza->ostaliUpiti($terapijaCijenaUnosUpit)){
                                $greske.="Greška kod rada sa bazom.<br>";
                            }else{
                                dnevnik_zapis("Unosena cijena terapije");
                            }  
                        }
                    }
            }        
        }
        
                
        if(isset($_POST['termin'])){
            if(!empty($_POST['termin'])){
               #$veterinar=$korisnik->get_id();
                $terminUnos=$_POST['termin'];
                $terminUnosUpit="Insert into termin(terminDatumVrijeme,kartoteka_kartotekaID,veterinar) values('$terminUnos','$idKartotekaT','$veterinar')";
                if(!$baza->ostaliUpiti($terminUnosUpit)){
                    $greske.="Greška kod rada sa bazom.<br>";
                }else{
                  dnevnik_zapis("Unosena termin");
                } 
            }
            
        }
        
        
        if(isset($_POST['status'])){
            if(!empty($_POST['status'])){
                $statusUnos=$_POST['status'];
                if($statusUnos==1){
                   $statusUnosUpit="Update kartotekaDetalji set status='$statusUnos' where kartotekaDetaljiID='$idKartotekaDetalj'";
                   if(!$baza->ostaliUpiti($statusUnosUpit)){
                    $greske.="Greška kod rada sa bazom.<br>";
                   }else{
                       dnevnik_zapis("Završen unos zapisa u kartoteku");
                   }
                   $statusTermin="UPDATE termin SET status = 1 where kartoteka_kartotekaID='$idKartoteka' ORDER BY terminID DESC LIMIT 1";
                   if(!$baza->ostaliUpiti($statusTermin)){
                    $greske.="Greška kod rada sa bazom.<br>";
                   }
                }
            }
            
        }

       
        if(empty($greske)){
             header('Location:kartotekaDetalji.php');
        }
        else{   
        header('Location: greske.php?kod='.$greske);
        exit();
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


include 'headerLogIn.php';
$smarty->assign('simptomAttr', $simptomAttr);
$smarty->assign('simptom', $simptom);
$smarty->assign('bolestAttr', $bolestAttr);
$smarty->assign('terapijaOpisAttr', $terapijaOpisAttr);
$smarty->assign('terapijaOpis', $terapijaOpis);
$smarty->assign('terapijaCijenaAttr', $terapijaCijenaAttr);
$smarty->assign('terminAttr', $terminAttr);
$smarty->assign('terminType',$terminType);

$skripta="unosZapisaKartoteka.php?idkartDet={$kartDetaljiID}&idKartoteka={$idKartoteka}";
$smarty->assign('skripta',$skripta);

$smarty->assign('ispis', $ispis);
$smarty->display('predlosci/unosZapisaKartoteka.tpl');

include 'footer.php'; 

?>