 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Čitanje stručnosti.</h4>
          <hr>
          <form id="rStrucnost" name="rStrucnost" >
              <div>    
                <label for="veterinar">Veterinar</label>
                <input type="text"  name="veterinar" value={$vrijednost[1]} readonly>
              </div>
              <div>    
                <label for="tipZivotinje">Tip životinje</label>
                <input type="text"  name="tipZivotinje" value={$vrijednost[0]} readonly>
              </div>
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>  
  <script>$(document).foundation();</script>