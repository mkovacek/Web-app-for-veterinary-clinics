    <div id="divForma" class="row" >
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Prijava korisnika</h4>
                <p class="text-center">Prijavite se i pristupite dodatnim sadržajima eČuko-a.</p>
                <form data-abide name="prijava" method="POST" action={$skripta}>
                    <div>
                        <label id="korisnickoImeL" for="logInKorisnickoIme">Korisničko ime:</label>
                        <input type="text" id="logInKorisnickoIme" name="logInkorisnickoIme"  required>
                        <small class="error">Unos korisničkog imena je obavezan.</small>
                    </div>
                    <div>
                        <label id="passLabel" for="lozinka1">Lozinka: </label>
                        <input type="password" id="lozinka1" name="lozinka1"  required>
                        <small class="error">Unos lozinke je obavezan.</small>
                    </div>
                        <input type="submit" id="submit"  class="button expand" name="prijava" value="Prijava">         
                </form>
                <hr>
                <p class="text-center">Niste registrirani? <a href="registracija.php"> Registrirajte se</a></p>
                <hr>
                <p class="text-center"><a href="zabLozinka.php"> Zaboravili ste lozinku?</a></p>
           </div>
        </div> 

      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
      <script>$(document).foundation();</script>