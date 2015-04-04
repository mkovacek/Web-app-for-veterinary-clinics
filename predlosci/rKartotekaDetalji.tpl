     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Ažuriranje detalja kartoteke</h4>
                <hr>
                <form id="rKartotekaDetalji" name="uKartotekaDetalji">
                       <div>
                          <label for="kartoteka">Kartoteka</label>
                          <input type="text" name="kartoteka" required  value={$vrijednost[0]} readonly>
                       </div>
                       <div>
                          <label  for="datetime">Datum i vrijeme pregleda</label>
                          <input type="text" name="datetime" required value={$vrijednost[1]} readonly >
                       </div>
                       <div>
                          <label  for="status">Status završenosti</label>
                          <input type="text" name="status" required  value={$vrijednost[2]} readonly>
                       </div>
                       <div>
                          <label  for="statusR">Status račun</label>
                          <input type="text" name="statusR" required value={$vrijednost[3]} readonly>
                       </div>  
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