<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Sustav za praćenje i evidenciju klijenata veterinarskih ambulanata</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="author" content="Matija Kovaček">
        <link rel="stylesheet"  href="foundation-5.2.2/css/app.css">
        <link rel="stylesheet"  href="foundation-5.2.2/css/normalize.css">
        <link rel="stylesheet"  href="http://cdn.datatables.net/plug-ins/28e7751dbec/integration/foundation/dataTables.foundation.css">
        <script src="foundation-5.2.2/js/vendor/modernizr.js"></script> 
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
           <!--php izbornik-->
              
            <div class="row show-for-medium-up">
            <div class="contain-to-grid fixed" style="height: 105px">
                <nav class="top-bar" data-topbar >
                        <ul class="title-area">
                            <li class="name">
                                <a href="indexprijavljen.php"><img src="img/logonovo.png" alt="logo"></a>   
                            </li>
                        </ul>
                    <section class="top-bar-section" style="margin-top: 50px">
                         <ul class="right" style="height: 45px">
                             <li><a href="pocetna.php">eČUKO SUSTAV</a></li>
                             <li><a href="odjava.php">ODJAVA</a></li>
                             <li><a href="dokumentacija.html">DOKUMENTACIJA</a></li>
                         </ul>
                       </section>
                </nav>
            </div>
       </div>  
                     <!--izbornik za smartphone-->   
            <div class="row show-for-small-only">
             <div class="off-canvas-wrap" data-offcanvas="open_method:overlap;">
                <div class="inner-wrap">
                    <nav class="tab-bar">
                        <section class="left-small">
                            <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
                        </section>

                        <section class="middle tab-bar-section">
                            <h1 class="title"><a href="indexprijavljen.php" style="color:#008cba">eČuko</a></h1><h3>
                        </section>
                    </nav>
                    <aside class="left-off-canvas-menu">
                        <ul class="off-canvas-list" >
                            <li><label style="color:#008cba">Izbornik</label></li>
                            <li ><a href="indexprijavljen.php.php" style="color:#008cba">Početna</a></li>
                            <li><a href="pocetna.php" style='color:#008cba'>eČUKO sustav</a></li>
                            <li><a href='odjava.php' style='color:#008cba'>Odjava</a></li>
                            <li><a href="dokumentacija.html" style="color:#008cba">Dokumentacija</a></li>
                        </ul>
                    </aside>
                    <section class="main-section">
                            <div class="orbit-container">        
                                <ul data-orbit data-options="animation:fade; navigation_arrows: false; slide_number:false; bullets:false; timer_speed:4000; resume_on_mouseout: true; pause_on_hover: false;"  style="height: 374px;">
                                    <li>
                                        <img src="img/1m.jpg" alt="slide 1" />
                                        <div class="orbit-caption">Najbolja zaštita za Vaše ljubimce.</div>
                                    </li>
                                    <li>
                                        <img src="img/4m.jpg" alt="slide 2" />
                                        <div class="orbit-caption" >S Vašim ljubimcem nešto nije uredu?</div>
                                    </li>
                                    <li>
                                        <img src="img/6m.jpg" alt="slide 3" />
                                        <div class=" orbit-caption " >Imajte uvid u prošlost liječenja Vašeg ljubimca.</div>
                                    </li>
                                    <li>
                                        <img src="img/9m.jpg" alt="slide 4" />
                                        <div class="orbit-caption" >Brzo i jednostavno odaberite ambulantu.</div>
                                    </li>
                               </ul>
                            </div>          
                    </section>
                    <a class="exit-off-canvas"></a>
                </div>
            </div>   
       </div> 
   </header>