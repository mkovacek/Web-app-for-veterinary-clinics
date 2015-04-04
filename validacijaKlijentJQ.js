
$(document).ready(function(){
    
    var slova=new RegExp(/^[a-zA-ZćčšžĆČĐŠŽ]+$/);
    var minimum= new RegExp (/^(.){6,}$/);
    
    $("#ime").focusout(function(event){
        var ime=$("#ime").val();
        $(".obv").attr("style","display:none");
        $(".samoSlova").attr("style","display:none");
        if (!ime){
            $(".obv").removeAttr("style");
        }else{
            $(".samoSlova").removeAttr("style");
        }
    });
    
    $("#prezime").focusout(function(event){   
        var prezime= $("#prezime").val();
        $(".obv").attr("style","display:none");
        $(".samoSlova").attr("style","display:none");
        if (!prezime){
            $(".obv").removeAttr("style");
        }else{
            $(".samoSlova").removeAttr("style");
        }
    });
    
    $("#mail").focusout(function(event){   
        $("#mail").attr("data-abide-validator","provjeraEmail"); 
    });
    
    $("#mail2").focusout(function(event){   
        $("#mail2").attr("data-abide-validator","provjeraEmailZabLoz"); 
    });
    
    
    $("#korisnickoIme").focusout(function(event){   
        $("#korisnickoIme").attr("data-abide-validator","provjeraKorImena");  
    });
    
    
    $("#password").focusout(function(event){   
        var lozinka=$("#password").val();
        $(".obv").attr("style","display:none");
        $(".samoSlova").attr("style","display:none");
        if (!lozinka){
            $(".obv").removeAttr("style");
        }else{
            $(".samoSlova").removeAttr("style");
        }
    });
    
    $("#lozinka2").focusout(function(event){   
        var lozinka2=$("#lozinka2").val();
        $(".obv").attr("style","display:none");
        $(".samoSlova").attr("style","display:none");
        if (!lozinka2){
            $(".obv").removeAttr("style");
        }else{
            $(".samoSlova").removeAttr("style");
        }
    });
    
    $("#telefon").focusout(function(event){
        var telefon=$("#telefon").val();
        $(".obv").attr("style","display:none");
        if (!telefon){
            $(".obv").removeAttr("style");
        }
    });
    
 /*   $("#submit").click(function(event){  provjeri jos ovo,nekaj ne stima
        var ime=$("#ime").val();
        var prezime= $("#prezime").val();
        var email=$("#mail").val();
        var korime=$("#korisnickoIme").val();
        var lozinka=$("#password").val();
        var lozinka2=$("#lozinka2").val();
        $(".obv").attr("style","display:none");
        
        if(!ime && !prezime && !email && !korime && !lozinka && !lozinka2){
            $(".obv").removeAttr("style");
        }
        
    }); */
    

    
    
});


