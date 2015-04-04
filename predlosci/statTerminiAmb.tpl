
<div class="row" id="divForma2">
    <div class="small-12 medium-12 large-12 xlarge-12 columns">
        <span class="label" style="width: 100%; margin-top: 20px; margin-bottom: 30px"><h4 class="text-center" style="color:white">Statistika termina po veterinarskoj ambulanti i vremenskom periodu</h4></span> 
    </div>
</div>   
<div class="row"> 
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <form method="POST" action={$skripta}  data-abide>
                    <div>
                          <label  for="odDatuma">Od</label>
                          <input type="text"  name="odDatuma" value={$poc}>
                     </div>
                     <div>  
                          <label  for="doDatuma">Do</label>
                          <input  type="text" name="doDatuma" values={$zav}>
                     </div>
                    <div>
                         <label  for="amb">Ambulanta</label>
                        <select  name="amb" required>
                            {$ispis2}
                        </select>
                        <small class="error">Obavezno odaberite ambulantu.</small>
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

<div class="row">
    <div id="chart_div" class="small-12 small-centered medium-7 medium-centered large-7 large-centered xlarge-7 xlarge-centered columns "> 
    </div>
</div> 


    
  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.abide.js"></script>
  <script src="mydatatable.js"></script>
  <script>$(document).foundation();</script>