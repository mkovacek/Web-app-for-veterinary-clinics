<div class="row" id="divForma2">
        <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns" >
            <p>Upišite e-maila adresu koju ste koristili pri registraciji i poslat ćemo Vam lozinku.</p>
            <form name="zaboravljenaLozinka" method="POST" action={$skripta} data-abide >
                <div id="mejl">
                    <label id="emaiL" for="mail2">E-mail</label>
                    <input type="email" id="mail2" name="email" required data-abide-validator="provjeraEmailZabLoz">
                    <small class="error obv">Unos E-mail adrese je obavezan.</small>
                    <small class="error samoSlova">Krivo strukturirana E-mail adresa.</small>
                    <small class="error provjera">Nepostojeća E-mail adresa.</small>
                </div>
                <input type="submit" id="submit"  class="button expand" name="zabLozinka" value="Pošalji zahtjev">
            </form>
        </div> 
    </div>
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.reveal.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script src="validacijaKlijentFoundation.js"></script>
      <script src="validacijaKlijentJQ.js"></script>
      <script>$(document).foundation();</script>