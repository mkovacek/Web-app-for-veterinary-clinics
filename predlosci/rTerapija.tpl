     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje terapije</h4>
                <hr>
                <form id="rTerapija" name="rTerapija">
                       <div>
                          <label  for="terapija">Opis terapije</label>
                          <input type="text" name="terapija" required  value={$vrijednost[0]} readonly>
                       </div>
                       <div>
                          <label  for="cijena">Cijena</label>
                          <input type="text" name="cijena" required value={$vrijednost[1]} readonly>
                      </div>
                       <div>
                          <label  for="kartoteka">Detalj kartoteke</label>
                          <input type="text" name="kartoteka" value={$vrijednost[2]} readonly>
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