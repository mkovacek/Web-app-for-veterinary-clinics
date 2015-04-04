     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje termina</h4>
                <hr>
                <form id="uGalerijaSlika" name="cGalerijaSlika" method="POST" action={$skripta} data-abide>
                       <label for="kartoteka">Kartoteka</label>
                       <select  name="kartoteka" required>
                           <option selected="selected" disabled="disabled" value={$vrijednost[0]}>{$vrijednost[0]}</option>
                           {$ispis}
                           <small class="error">Obavezno odaberite kartoteku.</small>
                       </select>
                       <div>
                          <label  for="url">URL adresa</label>
                          <input type="text" name="url" required value={$vrijednost[1]}>
                          <small class="error">Obavezno upišite URL adresu do slike.</small>
                       </div><br> 
                       <input type="submit" id="submit"  class="button expand" name="uGalerijaSlika" value="Potvrdi">   
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