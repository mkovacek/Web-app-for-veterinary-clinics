     <div id="divForma" class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <h4 class="text-center">Upload slika</h4>
                <p class="text-center">Uplodajte slike zaprimljenog ljubimca.</p>
                <hr>
                <form id="unosSlike" name="unosSlike" method="POST" enctype="multipart/form-data" action={$skripta}>
                    <div>    
                        <label id="imeL" for="file">Upload slike</label>
                        <input type="file" id="file" name="file" required >
                    </div>
                    <input type="submit" id="submit"  class="button expand" name="submit" value="Potvrdi">   
            </form> 
        </div>
    </div>   
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>  
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script>$(document).foundation();</script>