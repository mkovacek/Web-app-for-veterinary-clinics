     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje dnevnika</h4>
                <hr>
                <form id="cDnevnik" name="cDnevnik" method="POST" action={$skripta} data-abide >
                    <div>    
                        <label  for="korisnik">Korisnik</label>
                        <input type="text"  name="korisnik" required >
                        <small class="error">Unos korisnika je obavezan.</small> 
                    </div>
                    <div>    
                        <label for="adresa">Adresa</label>
                        <input type="text"  name="adresa" required >
                        <small class="error">Unos adrese je obavezan.</small> 
                    </div>
                    <div>    
                        <label for="skripta">Skripta</label>
                        <input type="text" name="skripta" required >
                        <small class="error">Unos skripte je obavezan.</small> 
                    </div>
                    <div>    
                        <label for="tekst">Tekst</label>
                        <input type="text"  name="tekst" required >
                        <small class="error">Unos teksta je obavezan.</small> 
                    </div>
                    <div>    
                        <label id="imeL" for="datime">Datum i vrijeme</label>
                        <input type="datetime-local" name="datime" required >
                        <small class="error">Unos datuma i vrmena je obavezan.</small> 
                    </div>
                    <br> 
                        <input type="submit" id="submit"  class="button expand" name="cDnevnik" value="Potvrdi">   
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>