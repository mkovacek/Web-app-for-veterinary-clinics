     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje ambulante</h4>
                <hr>
                <form id="rAmbulanta" name="rAmbulanta">
                    <div>    
                        <label id="imeL" for="naziv">Naziv</label>
                        <input type="text" id="naziv" name="naziv"  value={$vrijednost[0]} readonly > 
                    </div>
                    <div>
                        <label id="adresaL" for="adresa">Adresa</label>
                        <input type="text" id="adresa" name="adresa"  value={$vrijednost[1]} readonly >
                    </div>                 
                    <div>
                        <label id="gradL" for="grad">Grad</label>
                        <input type="text" id="grad" name="grad"  value={$vrijednost[2]} readonly >
                    </div>                                           
                    <div>
                        <label id="telefonL" for="telefon">Broj telefona</label>
                        <input type="tel" id="telefon" name="telefon" value={$vrijednost[3]} readonly  >   
                    </div>
                    <div>
                        <label id="korisnickoImeL" for="radnoVrijeme">Radno vrijeme</label>
                        <input type="text" id="radnoVrijeme" name="radnoVrijeme" value={$vrijednost[4]} readonly  > 
                    </div> 
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>