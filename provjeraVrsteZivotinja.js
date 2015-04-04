$(document).ready(function(){    
    $("tipZivotinje" ).focusout(function(event){   
        $("tipZivotinje").attr("data-abide-validator","provjeraTipaZivotinje"); 
    });
});
