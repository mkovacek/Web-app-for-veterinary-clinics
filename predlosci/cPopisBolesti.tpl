     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje bolesti</h4>
                <hr>
                <form id="cPopisBolesti" name="cPopisBolesti" method="POST" action={$skripta} data-abide>
                    <div>
                          <label  for="naziv">Naziv</label>
                          <input type="text" name="naziv" required >
                          <small class="error">Obavezno unesite naziv bolesti.</small>
                     </div><br> 
                       <input type="submit" id="submit"  class="button expand" name="cPopisBolesti" value="Potvrdi">   
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