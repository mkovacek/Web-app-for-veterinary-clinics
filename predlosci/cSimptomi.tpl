     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje simptoma</h4>
                <hr>
                <form id="cSimptomi" name="cSimptomi" method="POST" action={$skripta} data-abide>
                    <div>
                          <label  for="simptom">Opis simptoma</label>
                          <input type="text" name="simptom" required >
                          <small class="error">Obavezno unesite opis simptoma.</small>
                     </div>
                     <div>  
                         <label for="kartoteka">Detalji kartoteka</label>
                         <select  name="kartoteka" required>
                            <option selected="selected" disabled="disabled">Odaberi detalj kartoteka</option>
                            {$ispis}
                            <small class="error">Obavezno odaberi detalj kartoteku.</small>
                         </select>
                     </div><br> 
                       <input type="submit" id="submit"  class="button expand" name="cSimptomi" value="Potvrdi">   
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