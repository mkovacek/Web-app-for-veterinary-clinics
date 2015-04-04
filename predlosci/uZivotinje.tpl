     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje podataka o životinji</h4>
                <hr>
                <form id="uZivotinje" name="uZivotinje" method="POST" action={$skripta} data-abide  >
                    <div>    
                        <label  for="ime">Ime</label>
                        <input type="text"  name="ime" value={$vrijednost[0]} required >
                        <small class="error">Unos imena je obavezan.</small>
                    </div>
                    <div>    
                        <label  for="starost">Starost</label>
                        <input type="text"  name="starost" value={$vrijednost[1]} required >
                        <small class="error">Unos starosti je obavezan.</small>
                    </div>
                    <div>
                       <label  for="tipZivotinje">Tip životinje</label>
                       <select name="tipZivotinje" required>
                            <option selected="selected" value={$vrijednost[2]}>{$vrijednost[3]}</option>
                            {$ispis}
                       </select>
                       <small class="error">Odabir tipa životinje je obavezan.</small>
                   </div>
                    <div>
                        <label  for="korisnik">Korisnik</label>
                        <select name="korisnik" required>
                            <option selected="selected" value={$vrijednost[4]}>{$vrijednost[5]}</option>
                            {$ispis2}
                        </select>
                        <small class="error">Odabir korisnika je obavezan.</small>
                    </div><br>
                    <input type="submit" id="submit"  class="button expand" name="uZivotinje" value="Potvrdi"> 
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>