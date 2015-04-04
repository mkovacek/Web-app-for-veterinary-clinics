     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Ažuriranje termina</h4>
                <hr>
                <form id="cTermin" name="uTermini" method="POST" action={$skripta} data-abide >
                    <div>
                        <label  for="datumVrijeme">Datum i vrijeme</label>
                        <input type="text"  name="datumVrijeme" required value={$vrijednost[0]} >
                        <small class="error">Obavezno upišite datum i vrijeme.</small>
                     </div> 
                   <div>
                       <label for="kartoteka">Kartoteka</label>
                       <select  name="kartoteka" required>
                           <option selected="selected" value={$vrijednost[1]}>{$vrijednost[1]}</option>
                           {$ispis}
                           <small class="error">Obavezno odaberite kartoteku.</small>
                       </select>
                   </div>
                    <div>
                        <label  for="status">Status</label>
                        <input type="text" name="status" required placeholder="0/1" value={$vrijednost[2]}  >
                        <small class="error">Obavezno upišite status.</small>
                     </div>
                     <div>
                       <label for="veterinar">Veterinar</label>
                       <select  name="veterinar" required>
                           <option selected="selected" value={$vrijednost[3]}>{$vrijednost[3]}</option>
                           {$ispis2}
                           <small class="error">Obavezno odaberite veterinara.</small>
                       </select>
                   </div> 
                    <br> 
                        <input type="submit" id="submit"  class="button expand" name="uTermini" value="Potvrdi">   
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>