     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Ažuriranje simptoma</h4>
                <hr>
                <form id="uSimptomi" name="uSimptomi" method="POST" action={$skripta} data-abide>
                       <div>
                          <label  for="simptom">Opis simptoma</label>
                          <input type="text" name="simptom" required  value={$vrijednost[0]}>
                          <small class="error">Obavezno napišite opis simptoma.</small>
                       </div>
                       <div>
                          <label  for="kartoteka">Detalj kartoteke</label>
                          <input type="text" name="kartoteka" value={$vrijednost[1]} readonly>
                       </div><br> 
                     <input type="submit" id="submit"  class="button expand" name="uSimptomi" value="Potvrdi">   
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