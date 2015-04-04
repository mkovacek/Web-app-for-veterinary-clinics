        <!--forma -->
        
        <div id="divForma" class="row ">
            
            <div class="small-6 medium-5 medium-push-2 large-5 large-push-2 xlarge-5-push-2 columns">
              
                <form id="registracija" name="registracija" method="POST" action={$skripta} data-abide >
                    <div>    
                        <label id="imeL" for="ime">Ime</label>
                        <input type="text" id="ime" name="ime" required pattern="samoSlova">
                        <small class="error obv">Unos imena je obavezan.</small>
                        <small class="error samoSlova">Ime mora sadržavati samo slova.</small>  
                    </div>
                    <div>
                        <label id="prezimeL" for="prezime">Prezime</label>
                        <input type="text" id="prezime" name="prezime" required pattern="samoSlova">
                        <small class="error obv">Unos prezimena je obavezan.</small>
                        <small class="error samoSlova">Prezime mora sadržavati samo slova.</small> 
                    </div>  
                    <div>
                        <label id="adresaL" for="adresa">Adresa</label>
                        <input type="text" id="adresa" name="adresa" required >
                        <small class="error">Unos adrese je obavezan.</small>
                    </div>                 
                    <div>
                        <label id="gradL" for="grad">Grad</label>
                        <input type="text" id="grad" name="grad" required>
                        <small class="error">Unos grada je obavezan.</small>
                    </div>                  
                    <div id="mejl">
                        <label id="emaiL" for="mail">E-mail</label>
                        <input type="email" id="mail" name="email" required data-abide-validator="provjeraEmail">
                        <small class="error obv">Unos E-mail adrese je obavezan.</small>
                        <small class="error samoSlova">Krivo strukturirana E-mail adresa.</small>
                        <small class="error provjera">Email adresa je već registrirana.</small>
                    </div>                           
                    <div id="ki">
                        <label id="korisnickoImeL" for="korisnickoIme">Korisničko ime</label>
                        <input type="text" id="korisnickoIme" name="korisnickoIme" required data-abide-validator="provjeraKorImena">
                        <small class="error obv">Unos korisničkog imena je obavezan.</small>
                        <small class="error samoSlova">Korisničko ime mora sadržavati minimalno 6 znakova</small>
                        <small class="error provjera">Korisničko ime je zauzeto.</small>
                    </div>            
                    <div>
                        <label id="passLabel" for="password">Lozinka</label>
                        <input type="password" id="password" name="password" required pattern="minimum">
                        <small class="error obv">Unos lozinke je obavezan.</small>
                        <small class="error samoSlova">Lozinka mora sadržavati minimalno 6 znakova</small>
                    </div>       
                    <div>
                        <label id="passLabel2" for="lozinka2">Potvrda lozinke</label>
                        <input type="password" id="lozinka2" name="lozinka2" required data-equalto="password">
                        <small class="error obv">Unos potvrde lozinke je obavezan.</small>
                        <small class="error samoSlova">Lozinka i potvrda lozinke nisu jednake.</small>
                    </div>
                    <div>
                        <label id="telefonL" for="telefon">Broj telefona</label>
                        <input type="tel" id="telefon" name="telefon" required placeholder="xxx/xxx-xxx">   <!--  patern-->
                        <small class="error obv">Unos telefona je obavezan.</small>
                    </div>    
                        <script type="text/javascript">
                             var RecaptchaOptions = {
                                 theme : 'clean'  
                             };
                        </script>
                        
                      