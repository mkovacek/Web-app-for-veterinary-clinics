<div class="row" id="divForma2">
    <div class="small-12 medium-12 large-12 xlarge-12 columns">
        <span class="label" style="width: 100%; margin-top: 20px; margin-bottom: 30px"><h4 class="text-center" style="color:white">Izdani račun</h4></span> 
    </div>
</div>
<div class="row">
    <div class="small-10 small-centered medium-6 medium-centered large-6 large-centered xlarge-6 xlarge-centered columns "> 
        <ul class="pricing-table">
            <li class="title">Račun</li>
            <li class="bullet-item">Datum i vrijeme: {$datumVrijemeIzdavanja}</li>
            <li class="bullet-item">Izdao: {$veterinarNaziv}</li>
            <li class="description">Terapija: {$terapijaOpis}</li>
            <li class="price">Cijena: {$terapijaCijena}kn</li>
       </ul>
    </div>  
</div>
    
  <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="mydatatable.js"></script>
  <script>$(document).foundation();</script>