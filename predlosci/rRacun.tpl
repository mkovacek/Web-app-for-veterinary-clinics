     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje računa</h4>
                <hr>
                <form id="rRacun" name="rRacun">
                       <div>
                          <label  for="datetime">Datum i vrijeme kreiranja</label>
                          <input type="text" name="datetime"   value={$vrijednost[0]} readonly>
                       </div>
                       <div>
                          <label  for="klijent">Klijent</label>
                          <input type="text" name="klijent"  value={$vrijednost[1]} readonly>
                      </div>
                      <div>
                          <label  for="veteriar">Veterinar</label>
                          <input type="text" name="veterinar"  value={$vrijednost[2]} readonly>
                      </div>
                       <div>
                          <label  for="kartoteka">Detalj kartoteke</label>
                          <input type="text" name="kartoteka" value={$vrijednost[3]} readonly>
                       </div>
                 </form> 
            </div>
                      
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script>$(document).foundation();</script>