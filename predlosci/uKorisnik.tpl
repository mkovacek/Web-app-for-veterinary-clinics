 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Ažuriranje korisnika.</h4>
          <hr>
          <form id="Korisnik" name="Korisnik" method="POST" action={$skripta} data-abide >
             <div>    
                <label  for="ime">Ime</label>
                <input type="text"  name="ime" value={$vrijednost[0]} required>
                <small class="error">Unos naziva je obavezan.</small>
              </div>
              <div>
                <label  for="prezime">Prezime</label>
                <input type="text"  name="prezime" value={$vrijednost[1]}  required>
                <small class="error">Unos prezimena je obavezan.</small>
             </div>
             <div>
                <label  for="korime">Korisničko ime</label>
                <input type="text"  name="korime" value={$vrijednost[2]}  required>
                <small class="error">Unos korisničkog imena je obavezan.</small>
             </div>                 
             <div>
                <label  for="loz">Lozinka</label>
                <input type="password"  name="loz" value={$vrijednost[3]} required>
                <small class="error">Unos lozinke je obavezan.</small>
            </div>
             <div>
                <label  for="adresa">Adresa</label>
                <input type="text"  name="adresa" value={$vrijednost[4]}  required>
                <small class="error">Unos adrese je obavezan.</small>
             </div>                 
             <div>
                <label  for="grad">Grad</label>
                <input type="text"  name="grad" value={$vrijednost[5]} required>
                <small class="error">Unos grada je obavezan.</small>
            </div>
            <div>
                <label  for="email">Email</label>
                <input type="text"  name="email" value={$vrijednost[6]} required>
                <small class="error">Unos email je obavezan.</small>
             </div>                 
             <div>
                <label  for="tel">Telefon</label>
                <input type="text"  name="tel" value={$vrijednost[7]} >
            </div>
            <div>
                 <label  for="amb">Ambulanta</label>
                <select name="amb" required>
                    <option selected="selected" value="">{$vrijednost[9]}</option>
                    {$ispis}
                </select>
                <small class="error">Obavezno odaberite ambulantu.</small>
            </div>
            <div>
                <label  for="tip">Tip korisnika</label>
                <select  name="tip" required>
                    <option selected="selected" value="">{$vrijednost[11]}</option>
                    {$ispis2}
                </select>
                <small class="error">Obavezno odaberite tip korisnika.</small>
             </div>
            <div>
                <label  for="status">Status</label>
                <input type="number"  name="status" value={$vrijednost[12]}  required >
                <small class="error">Unos statusa je obavezan.</small>
             </div>                 
             <div>
                <label for="pok">Broj pokušaja</label>
                <input type="number"  name="pok" value={$vrijednost[13]} required>
                <small class="error">Unos broja pokušaja je obavezan.</small>
             </div><br>
              <input type="submit" id="submit"  class="button expand" name="uKorisnika" value="Potvrdi">
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
  <script>$(document).foundation();</script>