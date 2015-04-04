<div id="divForma" class="row"> 
    <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
        <h4 class="text-center">Unos zapisa u kartoteku</h4>
        <p class="text-center">Unesite podatke kako biste unijeli zapis u kartoteku.</p>
        <hr>
        <p class="text-justify">Ukoliko ne unesete sve podatke, važno je prije potvrde staviti da je zapis nedovršen, kako bi se kasnije mogao dovršiti.</p>
        <hr>
        <form id="unosZapisaKartoteka" name="unosZapisaKartoteka" method="POST" action={$skripta}>
            <p class="text-center">Simptomi</p>
            <div>    
                <label for="simptom">Opis simptoma</label>
                <textarea rows="5" id="simptom" {$simptomAttr}>{$simptom}</textarea>
            </div>
            <p class="text-center">Bolest</p>
            <div>
                <label for="bolest">Bolest</label>
                {$bolestAttr}
            </div>
            <p class="text-center">Terapija</p>
            <div>
                <label for="terapija">Terapija</label>
                <textarea rows="5" id="terapija" {$terapijaOpisAttr}>{$terapijaOpis}</textarea>
            </div>                 
            <div>
                <label for="cijenaTerapije">Cijena terapije</label>
                <input type="text" id="cijenaTerapije" {$terapijaCijenaAttr}> 
            </div> 
            <div>
                <label for="termin">Sljedeći termin(po potrebi)</label> 
                <input type={$terminType} id="termin" {$terminAttr}> 
            </div> 
            <div>
                <label>Dovršen zapis</label>
                <input type="radio" name="status" value="1"><label for="status">Da</label>
                <input type="radio" name="status" value="0"><label for="status">Ne</label>
            </div>
            <br> 
                <input type="submit" id="submit"  class="button expand" name="unosZapisaKartoteka" value="Potvrdi">   
        </form> 
    </div>
</div>   

<script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
<script src="foundation-5.2.2/js/foundation/foundation.js"></script>
<script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
<script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
<script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
<script>$(document).foundation();</script>