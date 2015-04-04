     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Definiranje vrste životinja</h4>
                <p class="text-center">Unesite naziv životinje kako bi definirali vrstu životinje.</p>
                <hr>
                <form id="definiranjeTipovaZivotinja" name="definiranjeTipovaZivotinja" method="POST" action={$skripta} data-abide >
                    <div id="tipZivotinja">    
                        <label for="naziv">Naziv</label>
                        <input type="text" id="tipZivotinje" name="naziv" required data-abide-validator="provjeraTipaZivotinje" >
                        <small class="error obv">Unos naziva je obavezan.</small>
                        <small class="error provjera">Vrsta životinje već postoji.</small>
                    </div><br> 
                    <input type="submit" id="submit"  class="button expand" name="definiranjeTipovaZivotinja" value="Potvrdi">   
            </form> 
        </div>
    </div>   
 
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script src="validacijaKlijentFoundation.js"></script>
      <script src="provjeraVrsteZivotinja.js"></script>
      <script>$(document).foundation();</script>