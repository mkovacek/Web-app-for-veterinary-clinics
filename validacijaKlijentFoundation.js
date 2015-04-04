$(document).foundation({
  abide : {
    patterns : {
        samoSlova: /^[a-zA-ZćčšžĆČĐŠŽ]+$/,
        mail : /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/,
        minimum: /^(.){6,}$/
    },
    validators:{
        provjeraKorImena:
                function(el, required, parent){
                    var prazno= new RegExp (/^$/);
                    var minimum= new RegExp (/^(.){6,}$/);
                    $(".obv").attr("style","display:none");
                    $(".samoSlova").attr("style","display:none");
                    $(".provjera").attr("style","display:none");
                    $("#korisnickoIme").attr("data-abide-validator","provjeraKorImena");
                    var korIme=$("#korisnickoIme").val();
                    var valid=false;

                    if(prazno.test(korIme)){
                        if(required){
                            $(".obv").removeAttr("style");
                            console.log("Nije valid: Korisnicko ime" + korIme);
                            console.log("Nije valid:prazno polje" + korIme);  
                        }else{
                            valid=true;
                            console.log("Valid: nije prazno polje");
                        }
                    }else{
                        if(!minimum.test(korIme)){
                           console.log("Nije valid: manje od 6 znakova");
                           $(".samoSlova").removeAttr("style");  
                        }
                        else{ 
                         console.log("Valid:6 ili vise znakova,ajax..");
                         $.when(
                           $.ajax({
                                type: "GET",
                                url: "http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_034/provjeraKorImena.php",
                                dataType: "XML",
                                data:{
                                    'korisnik':korIme
                                },
                                success: function(data){
                                    $(data).find('korisnici').each(function(){
                                         zauzeto = $(this).find('korisnik').text();
                                    });

                                    if(zauzeto==1)
                                    {                                         
                                        $(".provjera").removeAttr("style");
                                        console.log("Korisnicko ime je zauzeto " +zauzeto + valid);   
                                    } 
                                    else{
                                       valid=true;
                                       console.log("Korisnicko ime je slobodno " +zauzeto + valid);
                                    }
                                  
                                 },

                                error: function( data ) {
                                   console.log("Greška kod prijenosa podataka.");
                                }
                            })
                            ).then(
                                function(){
                                  console.log("valid poslije ajaxa " +valid);
                                  console.log("valid: "+valid);
                                  if(valid){
                                    $("#korisnickoIme").removeAttr("data-invalid");
                                    $("#korisnickoIme").removeAttr("data-abide-validator");
                                    $("#ki").removeAttr("class");  
                                  } 
                                  
                                  return valid;
                                }
                            );
                           
                            
                            
                        }
                    }
                    
              },
         provjeraEmail:
                    function(el, required, parent){
                    var prazno= new RegExp (/^$/);
                    var struktura= new RegExp (/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/);
                    $(".obv").attr("style","display:none");
                    $(".samoSlova").attr("style","display:none");
                    $(".provjera").attr("style","display:none");
                    $("#mail").attr("data-abide-validator","provjeraEmail");
                    var email=$("#mail").val();
                    var valid=false;
                    
                    
                    if(prazno.test(email)){
                        if(required){
                            $(".obv").removeAttr("style");
                            console.log("Nije valid:prazno polje");
                            
                        }else{
                            valid=true;
                            console.log("Valid: nije prazno polje");
                        }
                    }else{
                        if(!struktura.test(email)){
                           console.log("Nije valid: krivo strukturirano");
                           $(".samoSlova").removeAttr("style");  
                        }
                        else{ 
                         console.log("Valid: Dobro strukturirano");
                         $.when(
                           $.ajax({
                                type: "GET",
                                url: "http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_034/provjeraEmail.php",
                                dataType: "XML",
                                data:{
                                    'korisnik':email
                                },
                                success: function(data){
                                    $(data).find('korisnici').each(function(){
                                         zauzeto = $(this).find('korisnik').text();
                                    });

                                    if(zauzeto==1)
                                    {                                         
                                        $(".provjera").removeAttr("style");
                                        console.log("Email postoji " +zauzeto + valid);   
                                    } 
                                    else{
                                       valid=true;
                                       console.log("Email slobodan " +zauzeto + valid);
                                    }
                                  
                                 },

                                error: function( data ) {
                                   console.log("Greška kod prijenosa podataka.");
                                }
                            })
                            ).then(
                                function(){
                                  console.log("valid poslije ajaxa " +valid);
                                  console.log("valid: "+valid);
                                  if(valid){
                                    $("#mail").removeAttr("data-invalid");
                                    $("#mail").removeAttr("data-abide-validator");
                                    $("#mejl").removeAttr("class");  
                                  } 
                                  
                                  return valid;
                                }
                            );
                           
                            
                            
                        }
                    }
                    
              },
         provjeraEmailZabLoz:
                    function(el, required, parent){
                    var prazno= new RegExp (/^$/);
                    var struktura= new RegExp (/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/);
                    $(".obv").attr("style","display:none");
                    $(".samoSlova").attr("style","display:none");
                    $(".provjera").attr("style","display:none");
                    $("#mail2").attr("data-abide-validator","provjeraEmailZabLoz");
                    var email=$("#mail2").val();
                    var valid=false;
                    
                    
                    if(prazno.test(email)){
                        if(required){
                            $(".obv").removeAttr("style");
                            console.log("Nije valid:prazno polje");
                            
                        }else{
                            valid=true;
                            console.log("Valid: nije prazno polje");
                        }
                    }else{
                        if(!struktura.test(email)){
                           console.log("Nije valid: krivo strukturirano");
                           $(".samoSlova").removeAttr("style");  
                        }
                        else{ 
                         console.log("Valid: Dobro strukturirano");
                         $.when(
                           $.ajax({
                                type: "GET",
                                url: "http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_034/provjeraEmail.php",
                                dataType: "XML",
                                data:{
                                    'korisnik':email
                                },
                                success: function(data){
                                    $(data).find('korisnici').each(function(){
                                         zauzeto = $(this).find('korisnik').text();
                                    });

                                    if(zauzeto==1)
                                    {                                         
                                        valid=true;
                                        console.log("Email postoji " +zauzeto + valid);   
                                    } 
                                    else{
                                        
                                       $(".provjera").removeAttr("style");
                                       console.log("Email slobodan " +zauzeto + valid);
                                    }
                                  
                                 },

                                error: function( data ) {
                                   console.log("Greška kod prijenosa podataka.");
                                }
                            })
                            ).then(
                                function(){
                                  console.log("valid poslije ajaxa " +valid);
                                  console.log("valid: "+valid);
                                  if(valid){
                                    $("#mail2").removeAttr("data-invalid");
                                    $("#mail2").removeAttr("data-abide-validator");
                                    $("#mejl").removeAttr("class");  
                                  } 
                                  
                                  return valid;
                                }
                            );
                           
                            
                            
                        }
                    }     
                },
         provjeraTipaZivotinje:
                    function(el, required, parent){
                    var prazno= new RegExp (/^$/);
                    $(".obv").attr("style","display:none");
                    $(".provjera").attr("style","display:none");
                    $("#tipZivotinje").attr("data-abide-validator","provjeraTipaZivotinje");
                    var valid=false;
                    var vrsta=$("#tipZivotinje").val();

                    if(prazno.test(vrsta)){
                        if(required){
                            $(".obv").removeAttr("style");
                            console.log("Nije valid:prazno polje");
                            
                        }else{
                            valid=true;
                            console.log("Valid: nije prazno polje");
                        }
                    }else{
                        
                         console.log("Valid: Dobro strukturirano");
                         $.when(
                           $.ajax({
                                type: "GET",
                                url: "http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_034/provjeraVrsteZivotinja.php",
                                dataType: "XML",
                                data:{
                                    'naziv':vrsta
                                },
                                success: function(data){
                                    $(data).find('vrsteZivotinja').each(function(){
                                         zauzeto = $(this).find('naziv').text();
                                    });

                                    if(zauzeto==1)
                                    {                                         
                                        $(".provjera").removeAttr("style");
                                        console.log("Vrsta zauzeta " +zauzeto + valid);   
                                    } 
                                    else{
                                       valid=true;
                                       console.log("Vrsta slobodna " +zauzeto + valid);
                                    }
                                  
                                 },

                                error: function( data ) {
                                   console.log("Greška kod prijenosa podataka.");
                                }
                            })
                            ).then(
                                function(){
                                  console.log("valid poslije ajaxa " +valid);
                                  console.log("valid: "+valid);
                                  if(valid){
                                    $("#tipZivotinje").removeAttr("data-invalid");
                                    $("#tipZivotinje").removeAttr("data-abide-validator");
                                    $("#tipZivotinja").removeAttr("class");  
                                  } 
                                  
                                  return valid;
                                }
                            );
    
                    }
                    
              }       
    }
 }
});
