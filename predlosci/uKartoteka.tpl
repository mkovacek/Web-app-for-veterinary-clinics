     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Ažuriranje kartoteke</h4>
                <hr>
                <form id="uKartoteka" name="uKartoteka" method="POST" action={$skripta} data-abide >
                   <div>
                       <label for="zivotinja">Životinja</label>
                       <select  name="zivotinja" required>
                           <option selected="selected"  value={$vrijednost[0]}>{$vrijednost[1]}</option>
                           {$ispis}
                           <small class="error">Obavezno odaberite životinju.</small>
                       </select>
                   </div>
                    <div>
                        <label  for="ambulanta">Ambulanta</label>
                        <select  name="ambulanta" required>
                            <option selected="selected" value={$vrijednost[2]}>{$vrijednost[3]}</option>
                            {$ispis2}
                            <small class="error">Obavezno odaberite ambulantu.</small>
                        </select>
                     </div>  
                    <br> 
                        <input type="submit" id="submit"  class="button expand" name="uKartoteka" value="Potvrdi">   
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>