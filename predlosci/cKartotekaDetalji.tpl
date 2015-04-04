     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje detalja kartoteke</h4>
                <hr>
                <form id="cKartotekaDetalji" name="cKartotekaDetalji" method="POST" action={$skripta} data-abide>
                       <label for="kartoteka">Kartoteka</label>
                       <select  name="kartoteka" required>
                           <option selected="selected" disabled="disabled">Odaberi kartoteku</option>
                           {$ispis}
                           <small class="error">Obavezno odaberite kartoteku.</small>
                       </select>
                       <div>
                          <label  for="datetime">Datum i vrijeme pregleda</label>
                          <input type="datetime-local" name="datetime" required >
                          <small class="error">Obavezno odaberite datum.</small>
                       </div>
                       <div>
                          <label  for="status">Status završenosti</label>
                          <input type="text" name="status" required >
                          <small class="error">Obavezno upišite status.</small>
                       </div>
                       <div>
                          <label  for="statusR">Status račun</label>
                          <input type="text" name="statusR" required >
                          <small class="error">Obavezno upišite status račun.</small>
                       </div><br> 
                       <input type="submit" id="submit"  class="button expand" name="cKartotekaDetalji" value="Potvrdi">   
                 </form> 
            </div>
                      
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>