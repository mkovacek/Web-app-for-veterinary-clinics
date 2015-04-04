
<div class="row" id="divForma2">
    <div class="small-12 medium-12 large-12 xlarge-12 columns">
        <span class="label" style="width: 100%; margin-top: 20px; margin-bottom: 30px"><h4 class="text-center" style="color:white">Statistika pogrešnih/ispravnih prijava po korisnicima i vremenskom periodu</h4></span> 
    </div>
</div>   
<div class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <form method="POST" action={$skripta}>
                    <div>
                          <label  for="odDatuma">Od</label>
                          <input type="text"  name="odDatuma" value={$poc}>
                     </div>
                     <div>  
                          <label  for="doDatuma">Do</label>
                          <input  type="text" name="doDatuma" values={$zav}>
                     </div>
                    <div>  
                          <label  for="korisnik">Korisničko ime</label>
                          <input type="text" name="korisnik">
                     </div>
                    <br> 
                       <input type="submit" id="submit"  class="button expand" name="statistika" value="Potvrdi">   
                 </form> 
            </div>         
        </div>
{$ispisPDF}
<div class="row">
    <div class="small-12 medium-12 large-12 xlarge-12 columns "> 
        {$ispis}
    </div>  
</div>
{$ispisPDF2}
<div class="row">
    <div class="small-12 medium-12 large-12 xlarge-12 columns "> 
        {$ispis2}
    </div>  
</div>
<div class="row">
    <div class="small-12 medium-6 large-6 xlarge-6 columns "> 
        <div id="chart_div"></div>
    </div>
    <div class="small-12 medium-6 large-6 xlarge- columns "> 
        <div id="chart_div2"></div>
    </div> 
</div> 


    
  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="mydatatable.js"></script>
  <script>$(document).foundation();</script>