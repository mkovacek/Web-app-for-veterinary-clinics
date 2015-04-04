<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Sustav za praćenje i evidenciju klijenata veterinarskih ambulanata</title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="author" content="Matija Kovaček">
        <link rel="stylesheet"  href="../foundation-5.2.2/css/app.css">
        <link rel="stylesheet"  href="../foundation-5.2.2/css/normalize.css">
        <script src="../foundation-5.2.2/js/vendor/modernizr.js"></script>
        <style type="text/css"></style>
        <meta class="foundation-data-attribute-namespace">
        <meta class="foundation-mq-xxlarge">
        <meta class="foundation-mq-xlarge">
        <meta class="foundation-mq-large">
        <meta class="foundation-mq-medium">
        <meta class="foundation-mq-small">
        <style></style>
        <meta class="foundation-mq-topbar">
    </head>
    
    <body>
          <header>
            <p></p>
                <div class="row show-for-medium-up">
                    <div class="contain-to-grid fixed" style="height: 105px">
                        <nav class="top-bar" data-topbar >
                                <ul class="title-area">
                                    <li class="name">
                                        <a href="../index.php"><img src="../img/logonovo.png" alt="logo"></a>   
                                    </li>
                                </ul>
                        </nav>
                    </div>
               </div>
          </header>

<div class="row" style="margin-top: 110px">
    <div class="small-12 medium-12 large-12 xlarge-12 columns "> 
        {$ispis}
    </div>  
</div>

    
  <script src="../foundation-5.2.2/js/vendor/jquery.js"></script>
  <script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
  <script src="../foundation-5.2.2/js/foundation/foundation.js"></script>
  <script src="../foundation-5.2.2/js/foundation/foundation.offcanvas.js"></script>
  <script src="../foundation-5.2.2/js/foundation/foundation.orbit.js"></script>
  <script src="../mydatatable.js"></script>
  <script>$(document).foundation();</script>
    <div id="futer">
        <footer id="footer">
          <div class="row">
              
              <div class="medium-9 medium-push-3 large-8 large-push-4 columns show-for-medium-up">
                  <br><br><p>© 2014 <a id="email" href="mailto:mkovacek@foi.hr">Matija Kovaček </a>| Sva prava pridržana </p>
              </div> 
              <div class="small-12 show-for-small-only" style="font-size:small ">
                  <p class="text-center">© 2014 <a id="email" href="mailto:mkovacek@foi.hr">Matija Kovaček </a></p> 
                  <p class="text-center">Sva prava pridržana </p>
              </div>
          </div>
      </footer>
    </div>
    </body>
</html>
<script src="../futer.js"></script>