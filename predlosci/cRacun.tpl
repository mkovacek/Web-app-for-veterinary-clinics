     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje računa</h4>
                <hr>
                <form id="cRacun" name="cRacun" method="POST" action={$skripta} data-abide>
                    <div>
                         <label for="klijent">Klijent</label>
                         <select  name="klijent" required>
                            <option selected="selected" disabled="disabled">Odaberi klijenta</option>
                            {$ispis2}
                            <small class="error">Obavezno odaberi kliijenta.</small>
                         </select>
                     </div>
                      <div>
                            <label for="veterinar">Veterinar</label>
                            <select  name="veterinar" required>
                                <option selected="selected" disabled="disabled">Odaberi veterinara</option>
                                {$ispis3}
                                <small class="error">Obavezno odaberite veterinara.</small>
                            </select>
                      </div>
                     <div>  
                         <label for="kartoteka">Zapis kartoteke</label>
                         <select  name="kartoteka" required>
                            <option selected="selected" disabled="disabled">Odaberi detalj kartoteka</option>
                            {$ispis}
                            <small class="error">Obavezno odaberi detalj kartoteku.</small>
                         </select>
                     </div>
                     <br> 
                       <input type="submit" id="submit"  class="button expand" name="cRacun" value="Potvrdi">   
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