 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Kreiranje nove kartoteke</h4>
          <p class="text-center">Unesite podatke kako biste kreirali novu kartoteku.</p>
          <hr>
          <form id="dodajKartoteku" name="dodajKartoteku" method="POST" action={$skripta} data-abide>
              <div>
                <label  for="naziv">Podaci</label>
                <select id="vrsta" name="naziv" required>
                    <option selected="selected" disabled="disabled">Odaberi vrstu</option>
                    {$ispis}
                    <small class="error">Obavezno odaberite životinju.</small>
                </select>
              </div>                
              <input type="submit" class="button expand" name="dodajKartoteku" value="Kreiraj kartoteku">  
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
  
  <script>$(document).foundation();</script>