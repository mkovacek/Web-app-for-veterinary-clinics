<?php
include_once('aplikacijskiOkvir.php'); 
include 'headerLogIn.php' ; 
?>
                
        <div class="row" style="margin-top: 150px; margin-bottom: 500px;">
            <div class="small-12 medium-12 large-12 xlarge-12 columns">
                    <div data-alert class="alert-box alert">
                        <h3>Došlo je do pogreške:</h3>
                        <?php             
                            if (isset($_GET['kod'])) {
                                $g =$_GET['kod'];
                                dnevnik_zapis("Greške: ".$g);
                                echo $g;
                            }else{
                                if(isset($_GET['e'])){
                                $e = $_GET['e'];
                                $message = "";
                                    switch ($e) {
                                        case -1: echo "Korisnik ne postoji.";  
                                                 dnevnik_zapis("Greška: Korisnik ne postoji. ");
                                                 break;
                                        case 0:  echo "Neispravno korisničko ime/lozinka.";
                                                 dnevnik_zapis("Greška: Neispravno korisničko ime/lozinka.");
                                                 break;
                                        case 2:  echo "Neautorizirani pristup.";
                                                 dnevnik_zapis("Greška: Neautorizirani pristup. ");
                                                 break;
                                        case 3:  echo "Zbog previše neuspjelih pokušaja, Vaš račun je zaključan.";
                                                 dnevnik_zapis("Greška: Zbog previše neuspjelih pokušaja, Vaš račun je zaključan.");
                                                 break;
                                        default: echo "Nepoznata pogreska.";
                                                 dnevnik_zapis("Greška: Nepoznata pogreska. ");
                                                 break;
                                    }
                                }   
                            }    
                        ?>
                        <a href="#" class="close">&times;</a>
                    </div>
            </div>
        </div>
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.alert.js"></script>
      <script>$(document).foundation();</script>
      
<?php include 'footer.php' ?>