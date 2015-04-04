
$(document).ready(function(){
$(".veterinariAmbulanta").dataTable({
           "bSort":true,
           "bPaginate":true,
           "bFilter":true,
           "bInfo":false,
           "bLengthChange": false,
           "oLanguage": {
                    "sSearch": "Filter:",
                    "oPaginate": {
                        "sPrevious": "Prethodna",
                        "sNext": "Sljedeća"
                    }
                }
          });      
});