     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Ažuriranje utvrđene bolesti</h4>
                <hr>
                <form id="uUtvrdenaBolest" name="uUtvrdenaBolest" method="POST" action={$skripta} data-abide>
                    <div>
                         <label for="bolest">Bolest</label>
                         <select  name="bolest" required>
                            <option selected="selected" disabled="disabled" value={$vrijednost[0]}>{$vrijednost[1]}</option>
                            {$ispis2}
                            <small class="error">Obavezno odaberi bolest.</small>
                         </select>
                     </div>
                     <div>  
                         <label for="kartoteka">Detalji kartoteka</label>
                         <input type="text" name="kartoteka" value={$vrijednost[2]} readonly>
                     </div>
                     <div>  
                         <label for="veterinar">Veterinar</label>
                         <input type="text" name="veterinar" value={$vrijednost[3]} readonly>
                     </div><br> 
                       <input type="submit" id="submit"  class="button expand" name="uUtvrdenaBolest" value="Potvrdi">   
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