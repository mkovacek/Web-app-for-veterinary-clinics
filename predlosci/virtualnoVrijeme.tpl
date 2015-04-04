
<div class="row" id="divForma2">
    <div class="small-12 medium-12 large-12 xlarge-12 columns">
        <span class="label" style="width: 100%; margin-top: 20px; margin-bottom: 30px"><h4 class="text-center" style="color:white">Podešavanje virtualnog vremena</h4></span> 
    </div>
</div>
<div class="row">
    <div class="small-12 small-centered medium-7 medium-centered large-7 large-centerd xlarge-7 xlarge-centered columns "> 
        <form  name="pomak" method="POST" action={$skripta}>                
                <div>    
                   <a href='http://arka.foi.hr/PzaWeb/PzaWeb2004/config/vrijeme.html' target='_BLANK' class="button left expand">Postavi pomak</a>
                </div><br>
                <div>    
                    <label for="stavrnoVrijeme">Stvarno vrijeme</label>
                    <input type="text" name="stvarnoVrijeme" value="{$stvarnoVrijeme}">
                </div>
                <div>    
                    <label for="virtualnoVrijeme">Virtualno vrijeme</label>
                    <input type="text" name="virtualnoVrijeme" value="{$virtualnoVrijeme}" >
                </div>
                <input type="submit" id="submit"  class="button expand" name="pomak" value="Potvrdi">
        </form> 
    </div>  
</div>
<script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
<script src="foundation-5.2.2/js/foundation/foundation.js"></script>
<script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
<script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
<script>$(document).foundation();</script>