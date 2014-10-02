<?php
	include("includes/claseRecordSet.php");
  	include("includes/conexion.php");
	include("includes/queries.php");
	include("includes/multiTorneo.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>.:: GAMBETA FEMENINA ::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
	<link href="ie_style.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body id="page1">
	<div id="main">
      <div id="main-width">
         <!-- header -->
         <?php include("includes/Header.php"); ?>
         <!-- content -->
         <div id="content">
            <div class="indent">
               <div class="row-1 wrapper indent1">
                  <div class="block">
                     <div class="col-1">
                        <!-- box begin -->
                        <?php include("secciones/Noticias.php"); ?>
                        <!-- box end -->
                     </div>
                  </div>
                  <div class="col-2"><a href="#"><img alt="" src="images/banner1.gif" /></a></div>
               </div>
               <div class="row-2 wrapper">
                  <div class="block">
                     <div class="col-1">
                       <div class="line-hor"></div>
                        <div class="wrapper">
                           <div class="col-1">
                              <div class="ind">
                                 <!-- title-box1 begin -->
                                 <div class="title-box1" style="width:430px;">
                                    <div class="left-top-corner">
                                       <div class="right-top-corner">
                                          <div class="right-bot-corner">
                                             <div class="left-bot-corner">
                                                <div class="inner">
                                                   <div class="wrapper">
                                                   <h3>Posiciones</h3></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- title-box1 end -->
                                 <!-- box1 begin -->
                                 <div class="box1" style="width:430px;">
                                    <div class="right-bot-corner">
                                       <div class="left-bot-corner">
                                          <div class="inner">
                                             <!-- events block begin -->
                                             <div class="box2">
                                                <div class="left-top-corner">
                                                   <div class="right-top-corner">
                                                      <div class="border-top"></div>
                                                   </div>
                                                </div>
												
											   <!-- Tabla de Posiciones Completa -->
											   <?php include("secciones/EstadisticasPosicionesDetalle.php"); ?> 
												
                                                <div class="left-bot-corner">
                                                   <div class="right-bot-corner">
                                                      <div class="border-bot"></div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- events block end -->
                                             <!-- events block begin -->
                                             <!-- events block end -->
                                             <!-- events block begin -->
                                             <!-- events block end -->
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- box1 end -->
                              </div>
                           </div>
                           <div class="col-2" style="width:290px; margin-left:70px;">
                              <!-- title-box2 begin -->
                              <div class="title-box2">
                                 <div class="left-top-corner">
                                    <div class="right-top-corner">
                                       <div class="right-bot-corner">
                                          <div class="left-bot-corner">
                                             <div class="inner">
                                                <div class="wrapper">
                                                <h3>Goleadoras</h3></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- title-box2 end -->
                              <!-- box3 begin -->

								  <!-- Proxima fecha -->
								  <?php include("secciones/EstadisticasGoleadoresDetalle.php"); ?> 
							  
                              <!-- box3 end -->
                           </div>
                        </div>
                       <div class="line-hor"></div>
                        <?php include("includes/bannersfoot.php"); ?>
                     </div>
                  </div>
                  <div class="col-2">
                     <div class="wrap">
                        <div class="indent2">
                           <!-- title-box3 begin -->
                           
                           <!-- Tabla de posiciones -->
                           <?php include("secciones/TablaPosiciones.php"); ?> 
              				<!-- Tabla de goleadores -->
                           <?php include("secciones/TablaGoleadores.php"); ?> 
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- footer -->
         <?php include("includes/foot.php"); ?>
      </div>
   </div>
</body>
</html>