     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje tipa životinje</h4>
                <hr>
                <form id="cTipZivotinje" name="cTipZivotinje" method="POST" action={$skripta} data-abide >
                    <div>    
                        <label id="imeL" for="naziv">Naziv</label>
                        <input type="text" id="naziv" name="naziv" required >
                        <small class="error">Unos naziva je obavezan.</small> 
                    </div>
                    <br> 
                        <input type="submit" id="submit"  class="button expand" name="cTipZivotinje" value="Potvrdi">   
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>