     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje kartoteke</h4>
                <hr>
                <form id="rKartoteka" name="rKartoteka"  >
                    <div>
                        <label for="zivotinja">Životinja</label>
                        <input type="text"  name="zivotinja" value={$vrijednost[0]} readonly>
                    </div>
                    <div>
                         <label  for="vrijem">Vrijeme i datum kreiranja</label>
                         <input type="text"  name="vrijeme"  value={$vrijednost[1]} readonly>
                     </div>  
                     <div>
                         <label  for="ambulanta">Ambulanta</label>
                         <input type="text"  name="ambulanta"  value={$vrijednost[2]} readonly>
                     </div>    
                 </form> 
            </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script>$(document).foundation();</script>