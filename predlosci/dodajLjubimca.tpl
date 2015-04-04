 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Dodavanje kućnog ljubimca</h4>
          <p class="text-center">Unesite podatke kako biste dodali svog kućnog ljubimca.</p>
          <hr>
          <form id="dodajLjubimca" name="dodajLjubimca" method="POST" action={$skripta} data-abide>
              <div>    
                <label for="naziv">Naziv</label>
                <input type="text" id="naziv" name="naziv" required>
                <small class="error">Obavezan unos naziva.</small>
              </div>
              <div>
                <label  for="vrsta">Vrsta</label>
                <select id="vrsta" name="vrsta" required>
                    <option selected="selected" disabled="disabled">Odaberi vrstu</option>
                    {$ispis}
                    <small class="error">Obavezno odaberite vrstu.</small>
                </select>
              </div> 
              <div>
                <label for="starost">Starost</label>
                <input type="text" id="starost" name="starost" required>
                <small class="error">Obavezan unos starosti.</small>
              </div>                 
              <input type="submit" class="button expand" name="dodajLjubimca" value="Dodaj ljubimca">  
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
  
  <script>$(document).foundation();</script>