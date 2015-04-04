     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Čitanje dnevnika</h4>
                <hr>
                <form id="rDnevnik" name="rDnevnik">
                    <div>    
                        <label for="korisnik">Korisničko ime</label>
                        <input type="text"  name="korisnik"  value={$vrijednost[0]} readonly > 
                    </div>
                    <div>
                        <label for="adresa">Adresa</label>
                        <input type="text" name="adresa"  value={$vrijednost[1]} readonly >
                    </div>                 
                    <div>
                        <label for="skripta">Skripta</label>
                        <input type="text" name="skripta"  value={$vrijednost[2]} readonly >
                    </div>                                           
                    <div>
                        <label for="radnja">Radnja</label>
                        <input type="text"  name="radnja" value={$vrijednost[3]} readonly  >   
                    </div>
                    <div>
                        <label for="radnoVrijeme">Datum i vrijeme</label>
                        <input type="text"  name="radnoVrijeme" value={$vrijednost[4]} readonly  > 
                    </div> 
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script>$(document).foundation();</script>