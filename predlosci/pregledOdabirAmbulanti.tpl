        
        {$ispisIma}
        <div class="row">
            <div class="small-12 medium-12 large-12 xlarge-12 columns">
                <span class="label" style="width: 100%; margin-top:{$margina}; margin-bottom: 30px">
                    <h4 class="text-center" style="color:white">Veterinarske ambulante</h4>
                    {$ispisNema}
                </span> 
            </div>    
        </div>
        <div  class="row ">      
            <div class="small-12 medium-7 medium-centered large-7 large-centered xlarge-7 large-centered columns">
                <form  method="POST" action={$skripta}>{$ispisOdabir}</form>
            </div>
        </div>
        <div class="row">
            <div class="small-12 medium-12 large-12 xlarge-12 columns">
                   {$ispis}
                <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">         
                   {$ispisGrid}
                </ul>
            </div>     
        </div>

       
      <script src="foundation-5.2.2/js/vendor/jquery.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
      <script src="foundation-5.2.2/js/foundation/foundation.reveal.js"></script>
      <script>$(document).foundation();</script>