     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje podataka o životinji</h4>
                <hr>
                <form id="rZivotinje" name="rZivotinje" >
                    <div>    
                        <label  for="ime">Ime</label>
                        <input type="text"  name="ime" value={$vrijednost[0]} readonly >
                    </div>
                    <div>    
                        <label  for="starost">Starost</label>
                        <input type="text"  name="starost" value={$vrijednost[1]} readonly > 
                    </div>
                    <div>
                       <label  for="tipZivotinje">Tip životinje</label>
                       <input type="text" name="tipZivotinje" value={$vrijednost[2]} readonly>
                   </div>
                    <div>
                        <label  for="korisnik">Korisnik</label>
                        <input type="text" name="korisnik" value={$vrijednost[3]} readonly>
                     </div>    
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script>$(document).foundation();</script>