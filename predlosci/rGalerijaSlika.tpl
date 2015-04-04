     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje termina</h4>
                <hr>
                <form id="rGalerijaSlika" name="rGalerijaSlika">
                       <div>
                          <label for="kartoteka">Kartoteka</label>
                          <input type="text" name="kartoteka" value={$vrijednost[0]} readonly>
                       </div>
                       <div>
                          <label  for="url">URL adresa</label>
                          <input type="text" name="url" value={$vrijednost[1]} readonly>
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