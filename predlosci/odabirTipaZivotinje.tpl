 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Odabir stručnosti.</h4>
          <p class="text-center">Odaberite vrstu životinje.</p>
          <hr>
          <form id="odabirVrsteZivotinja" name="odabirVrsteZivotinja" method="POST" action={$skripta} data-abide>
              <div>    
                <label id="imeL" for="ime">Ime</label>
                <input type="text" id="ime" name="ime" value={$vrijednost[0]} readonly>
              </div>
              <div>
                <label id="prezimeL" for="prezime">Prezime</label>
                <input type="text" id="prezime" name="prezime"  value={$vrijednost[1]} readonly>
             </div>  
             <div>
                <label id="adresaL" for="adresa">Adresa</label>
                <input type="text" id="adresa" name="adresa"  value={$vrijednost[2]} readonly>
             </div>                 
             <div>
                <label id="gradL" for="grad">Grad</label>
                <input type="text" id="grad" name="grad"  value={$vrijednost[3]} readonly>
            </div>
            <div>
                <label id="ambulanta" for="strucan">Stručnost</label>
                    {$ispisStrucan}    
            </div>
            <div>
                <label id="ambulanta" for="strucan">Odabir vrste životinja</label>
                   {$ispisVrste}
            </div><br>
            <input type="submit" id="submit"  class="button expand" name="odabirVrsteZivotinja" value="Dodaj stručnost">  
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
  <script>$(document).foundation();</script>