 <div id="divForma" class="row ">      
      <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
          <h4 class="text-center">Unos novog korisnika.</h4>
          <hr>
          <form id="Korisnik" name="Korisnik" method="POST" action={$skripta} data-abide >
             <div>    
                <label  for="ime">Ime</label>
                <input type="text"  name="ime" required>
                <small class="error">Unos naziva je obavezan.</small>
              </div>
              <div>
                <label  for="prezime">Prezime</label>
                <input type="text"  name="prezime"  required>
                <small class="error">Unos prezimena je obavezan.</small>
             </div>
             <div>
                <label  for="korime">Korisničko ime</label>
                <input type="text"  name="korime"  required>
                <small class="error">Unos korisničkog imena je obavezan.</small>
             </div>                 
             <div>
                <label  for="loz">Lozinka</label>
                <input type="password"  name="loz"  required>
                <small class="error">Unos lozinke je obavezan.</small>
            </div>
             <div>
                <label  for="adresa">Adresa</label>
                <input type="text"  name="adresa"  required>
                <small class="error">Unos adrese je obavezan.</small>
             </div>                 
             <div>
                <label  for="grad">Grad</label>
                <input type="text"  name="grad"  required>
                <small class="error">Unos grada je obavezan.</small>
            </div>
            <div>
                <label  for="email">Email</label>
                <input type="text"  name="email"  required>
                <small class="error">Unos email je obavezan.</small>
             </div>                 
             <div>
                <label  for="tel">Telefon</label>
                <input type="text"  name="tel" >
            </div>
            <div>
                 <label  for="amb">Ambulanta</label>
                <select  name="amb" required>
                    <option selected="selected" disabled="disabled">Odaberi ambulantu</option>
                    {$ispis}
                    <small class="error">Obavezno odaberite ambulantu.</small>
                </select>
            </div>
            <div>
                <label  for="tip">Tip korisnika</label>
                <select  name="tip" required>
                    <option selected="selected" disabled="disabled">Odaberi tip korisnika</option>
                    {$ispis2}
                    <small class="error">Obavezno odaberite tip korisnika.</small>
                </select>
             </div>                 
            <div>
                <label  for="status">Status</label>
                <input type="number"  name="status"  required  placeholder="0/1">
                <small class="error">Unos statusa je obavezan.</small>
             </div>                 
             <div>
                <label for="pok">Broj pokušaja</label>
                <input type="number"  name="pok"  required placeholder="1">
                <small class="error">Unos broja pokušaja je obavezan.</small>
             </div><br>
             <input type="submit" id="submit"  class="button expand" name="cKorisnika" value="Potvrdi"> 
         </form>
      </div>
  </div>

  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
  <script>$(document).foundation();</script>