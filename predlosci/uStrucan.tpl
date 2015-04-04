 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Ažuriranje stručnosti.</h4>
          <hr>
          <form id="uStrucnost" name="uStrucnost" method="POST" action={$skripta} data-abide>
              <div>    
                <label for="veterinar">Veterinar</label>
                <select name="veterinar" required>
                    <option selected="selected" value={$vrijednost[0]}>{$vrijednost[1]}</option>
                    {$ispis}
                </select>
                <small class="error">Odabir tipa veterinara je obavezan.</small>
              </div>
              <div>    
                <label for="tipZivotinje">Tip životinje</label>
                <select name="tipZivotinje" required>
                     <option selected="selected" value={$vrijednost[2]}>{$vrijednost[3]}</option>
                     {$ispis2}
                </select>
                <small class="error">Odabir tipa životinje je obavezan.</small>
              </div><br>
              <input type="submit" id="submit"  class="button expand" name="uStrucan" value="Potvrdi"> 
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>  
  <script>$(document).foundation();</script>