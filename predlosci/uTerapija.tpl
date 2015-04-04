     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Ažuriranje simptoma</h4>
                <hr>
                <form id="uTerapija" name="uTerapija" method="POST" action={$skripta} data-abide>
                       <div>
                          <label  for="terapija">Opis terapije</label>
                          <input type="text" name="terapija" required  value={$vrijednost[0]}>
                          <small class="error">Obavezno napišite opis terapije.</small>
                       </div>
                       <div>
                          <label  for="cijena">Cijena</label>
                          <input type="text" name="cijena" required value={$vrijednost[1]} >
                          <small class="error">Obavezno unesite cijenu.</small>
                      </div>
                       <div>
                          <label  for="kartoteka">Detalj kartoteke</label>
                          <input type="text" name="kartoteka" value={$vrijednost[2]} readonly>
                       </div><br> 
                     <input type="submit" id="submit"  class="button expand" name="uTerapija" value="Potvrdi">   
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