     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje utvrđene bolesti</h4>
                <hr>
                <form id="rUtvrdenaBolest" name="rUtvrdenaBolest">
                    <div>
                         <label for="bolest">Bolest</label>
                         <input type="text" name="bolest" value={$vrijednost[0]} readonly>
                     </div>
                     <div>  
                         <label for="kartoteka">Detalji kartoteka</label>
                         <input type="text" name="kartoteka" value={$vrijednost[1]} readonly>
                     </div>
                     <div>
                        <label  for="status">Veterinar</label>
                        <input type="text" name="status" value={$vrijednost[2]} readonly >
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