     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Ažuriranje ambulante</h4>
                <hr>
                <form id="rAmbulanta" name="rAmbulanta" method="POST" action={$skripta} data-abide >
                    <div>    
                        <label id="imeL" for="naziv">Naziv</label>
                        <input type="text" id="naziv" name="naziv" value={$vrijednost[0]} > 
                        <small class="error obv">Unos naziva je obavezan.</small> 
                    </div>
                    <div>
                        <label id="adresaL" for="adresa">Adresa</label>
                        <input type="text" id="adresa" name="adresa"  value={$vrijednost[1]} >
                        <small class="error">Unos adrese je obavezan.</small>
                    </div>                 
                    <div>
                        <label id="gradL" for="grad">Grad</label>
                        <input type="text" id="grad" name="grad"  value={$vrijednost[2]}  >
                        <small class="error">Unos grada je obavezan.</small>
                    </div>                                           
                    <div>
                        <label id="telefonL" for="telefon">Broj telefona</label>
                        <input type="tel" id="telefon" name="telefon" value={$vrijednost[3]} >
                        <small class="error obv">Unos telefona je obavezan.</small>
                    </div>
                    <div>
                        <label id="korisnickoImeL" for="radnoVrijeme">Radno vrijeme</label>
                        <input type="text" id="radnoVrijeme" name="radnoVrijeme" value={$vrijednost[4]}  > 
                        <small class="error">Unos radnog vremena je obavezan.</small> 
                    </div><br>
                     <input type="submit" id="submit"  class="button expand" name="uAmbulanta" value="Potvrdi">
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>