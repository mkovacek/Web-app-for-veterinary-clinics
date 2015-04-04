 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Čitanje korisnika.</h4>
          <hr>
          <form id="Korisnik" name="Korisnik" >
             <div>    
                <label  for="ime">Ime</label>
                <input type="text"  name="ime" value={$vrijednost[0]} readonly>
              </div>
              <div>
                <label  for="prezime">Prezime</label>
                <input type="text"  name="prezime"  value={$vrijednost[1]} readonly>
             </div>
             <div>
                <label  for="korime">Korisničko ime</label>
                <input type="text"  name="korime"  value={$vrijednost[2]} readonly>
             </div>                 
             <div>
                <label  for="loz">Lozinka</label>
                <input type="text"  name="loz"  value={$vrijednost[3]} readonly>
            </div>
             <div>
                <label  for="adresa">Adresa</label>
                <input type="text"  name="adresa"  value={$vrijednost[4]} readonly>
             </div>                 
             <div>
                <label  for="grad">Grad</label>
                <input type="text"  name="grad"  value={$vrijednost[5]} readonly>
            </div>
            <div>
                <label  for="email">Email</label>
                <input type="text"  name="email"  value={$vrijednost[6]} readonly>
             </div>                 
             <div>
                <label  for="tel">Telefon</label>
                <input type="text"  name="tel"  value={$vrijednost[7]} readonly>
            </div>
            <div>
                <label  for="amb">Ambulanta</label>
                <input type="text"  name="amb"  value={$vrijednost[8]} readonly>
            </div>
            <div>
                <label for="tip">Tip korisnika</label>
                <input type="text"  name="tip"  value={$vrijednost[9]} readonly>
             </div>                 
             <div>
                <label  for="datum">Datum pristupanja</label>
                <input type="text"  name="datum"  value={$vrijednost[10]} readonly>
            </div>
            <div>
                <label  for="status">Status</label>
                <input type="text"  name="status"  value={$vrijednost[11]} readonly>
             </div>                 
             <div>
                <label for="pok">Broj pokušaja</label>
                <input type="text"  name="pok"  value={$vrijednost[12]} readonly>
            </div>
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>  
  <script>$(document).foundation();</script>