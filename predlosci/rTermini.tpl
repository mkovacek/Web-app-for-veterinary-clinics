     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje termina</h4>
                <hr>
                <form id="cTermin" name="rTermini" >
                    <div>
                        <label  for="datumVrijeme">Datum i vrijeme</label>
                        <input type="text"  name="datumVrijeme"  value={$vrijednost[0]} readonly>
                     </div> 
                   <div>
                       <label for="kartoteka">Kartoteka</label>
                       <input type="text" name="kartoteka" value={$vrijednost[1]} readonly >
                   </div>
                    <div>
                        <label  for="status">Status</label>
                        <input type="text" name="status" value={$vrijednost[2]} readonly >
                     </div>
                     <div>
                        <label  for="status">Veterinar</label>
                        <input type="text" name="status" value={$vrijednost[3]} readonly >
                     </div> 
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script>$(document).foundation();</script>