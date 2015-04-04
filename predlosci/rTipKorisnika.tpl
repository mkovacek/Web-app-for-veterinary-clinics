 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Čitanje tipa korisnika.</h4>
          <hr>
          <form id="tipKorisnika" name="tipKorisnika" >
              <div>    
                <label for="naziv">Naziv</label>
                <input type="text" id="naziv" name="naziv" value={$naziv} readonly>
              </div>
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>  
  <script>$(document).foundation();</script>