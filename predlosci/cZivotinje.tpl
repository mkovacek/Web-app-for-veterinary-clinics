     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Kreiranje životinje</h4>
                <hr>
                <form id="cZivotinje" name="cZivotinje" method="POST" action={$skripta} data-abide >
                    <div>    
                        <label  for="ime">Ime</label>
                        <input type="text"  name="ime" required >
                        <small class="error">Unos imena je obavezan.</small> 
                    </div>
                    <div>    
                        <label  for="starost">Starost</label>
                        <input type="text"  name="starost" required >
                        <small class="error">Unos starosti je obavezan.</small> 
                    </div>
                    <div>
                       <label  for="tipZivotinje">Tip životinje</label>
                       <select  name="tipZivotinje" required>
                           <option selected="selected" disabled="disabled">Odaberi tip životinje</option>
                           {$ispis}
                           <small class="error">Obavezno odaberite tip životinje.</small>
                       </select>
                   </div>
                    <div>
                        <label  for="korisnik">Korisnik</label>
                        <select  name="korisnik" required>
                            <option selected="selected" disabled="disabled">Odaberi korisnika</option>
                            {$ispis2}
                            <small class="error">Obavezno odaberite korisnika.</small>
                        </select>
                     </div>  
                    <br> 
                        <input type="submit" id="submit"  class="button expand" name="cZivotinje" value="Potvrdi">   
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>