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
<style type="text/css">
<!--
#cancha {
	background-image: url(images/cancha.gif);
	background-repeat: no-repeat;
	height: 400px;
	width: 630px;
	margin-left: 25px;
}

#cancha  .jugadora {
	height: 60px;
	float: left;
}

#cancha  .jugadora .foto {
	float: left;
	margin-left: 10 px;
}

#cancha  .jugadora .foto image {
	border: 1px #000 solid;
}

#cancha  .jugadora .info {
	float: left;
	margin-left: 5px;
}

#cancha  .jugadora .info h3 {
	color: #000;
	font-size:12px;
}

#cancha  .jugadora .info .nombre a {
	color: #CCC;
	font-size:11px;
	text-decoration: none;
}

#cancha  .jugadora .info .nombre a:hover {
	color: #060;
	font-size:11px;
	text-decoration: underline;
}
#cancha  .jugadora .info .equipo a {
	color: #FFF;
	font-size:11px;
	text-decoration: none;
}

#cancha  .jugadora .info .equipo a:hover{
	color: #FFF;
	font-size:11px;
	text-decoration:underline;
}




/* aca las posiciono en el canvas */
#cancha  #j1 {
	float: left;
	position:absolute;
	margin-top: 130px;
	margin-left: 20px;
	
}

#cancha  #j2 {
	float: left;
	position:absolute;
	margin-top: 35px;
	margin-left: 120px;
	
}

#cancha  #j3 {
	float: left;
	position:absolute;
	margin-top: 240px;
	margin-left: 120px;
	
}

#cancha  #j4 {
	float: left;
	position:absolute;
	margin-top: 130px;
	margin-left: 250px;
	
}

#cancha  #j5 {
	float: left;
	position:absolute;
	margin-top: 130px;
	margin-left: 440px;
	
}
-->
</style>
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
                        <div class="box">
                           <div class="border-bot">
                              <div class="left-top-corner">
                                 <div class="right-top-corner">
                                    <div class="right-bot-corner">
                                       <div class="left-bot-corner">
                                          <div class="inner">
                                             <div class="wrapper">
                                                <img class="fleft" alt="" src="images/big-banner.jpg" />
                                                <?php include("secciones/Noticias.php"); ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
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
                          <div>
                              <!-- title-box2 begin -->
                              <div class="title-box2">
                                 <div class="left-top-corner">
                                    <div class="right-top-corner">
                                       <div class="right-bot-corner">
                                          <div class="left-bot-corner">
                                             <div class="inner">
                                                <div class="wrapper">
                                                <h3>Equipo Ideal de la fecha</h3></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- title-box2 end -->
                              <div class="box2">
	<div class="left-top-corner">
	   <div class="right-top-corner">
		  <div class="border-top"></div>
	   </div>
	</div>
	<div class="border-left">
	   <div class="border-right">
		  <div class="inner">
			 
			 <div class="extra-wrap">
                              <!-- box3 begin -->
								<div id="cancha">
                                    <div id="j1" class="jugadora">
                                         <div class="foto"><img src="images/jugadora.gif" alt="" width="55" height="55"  /></div>
                                         <div class="info">
                                             <h3>Arquera</h3>
                                             <p class="nombre"><a href="jugadora.php?id=1">Cecilia Amaya</a></p>
                                             <p class="equipo"><a href="equipo.php?id=1">Las Colifas del Abasto</a></p>
                                         </div>
                                    </div>
                                    <div id="j2" class="jugadora">
                                    	 <div class="foto"><img src="images/jugadora.gif" alt="" width="55" height="55"  /></div>
                                         <div class="info">
                                             <h3>Defensora</h3>
                                             <p class="nombre"><a href="#">Cecilia "gambetita" Amaya</a></p>
                                             <p class="equipo"><a href="#">Las Colifas del Abasto</a></p>
                                         </div>
                                	</div>
                                    
                                    <div id="j3" class="jugadora">
                                    	 <div class="foto"><img src="images/jugadora.gif" alt="" width="55" height="55"  /></div>
                                         <div class="info">
                                             <h3>Defensora</h3>
                                             <p class="nombre"><a href="#">Inés Estevez</a></p>
                                             <p class="equipo"><a href="#">Las Colifas del Abasto</a></p>
                                         </div>
                                	</div>
                                    
                                    <div id="j4" class="jugadora">
                                    	 <div class="foto"><img src="images/jugadora.gif" alt="" width="55" height="55"  /></div>
                                         <div class="info">
                                             <h3>Mediocampo</h3>
                                             <p class="nombre"><a href="#">Miriam "imparable" Gambeta</a></p>
                                             <p class="equipo"><a href="#">Las Colifas del Abasto</a></p>
                                         </div>
                                	</div>
                                    
                                    <div id="j5" class="jugadora">
                                    	 <div class="foto"><img src="images/jugadora.gif" alt="" width="55" height="55"  /></div>
                                         <div class="info">
                                             <h3>Delantera</h3>
                                             <p class="nombre"><a href="#">Marisol Goleadora</a></p>
                                             <p class="equipo"><a href="#">Las Colifas del Abasto</a></p>
                                         </div>
                                	</div>
                                    
                                    
                                   
                                    
                                   
                                </div>
                                
								  <!-- Proxima fecha -->
                                  				<div class="wrapper"></div>
			</div>
			 <div class="clear"></div>
		  </div>
	   </div>
	</div>
	<div class="left-bot-corner">
	   <div class="right-bot-corner">
		  <div class="border-bot"></div>
	   </div>
	</div>
 </div>
							  
<!-- box3 end -->
                           </div>
                        </div>
                       <div class="line-hor"></div>
                        <?php include("includes/BannersFoot.php"); ?>
                     </div>
                  </div>
                  <div class="col-2">
                     <div class="wrap">
                        <div class="indent2">
                           <!-- title-box3 begin -->
                           <div class="title-box3">
                              <div class="left">
                                 <div class="right">
                                    <div class="wrapper">
                                       <a href="#" class="link5 fright">Total</a>
                                       <h2>Fechas</h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- title-box3 end -->
                           <!-- box3 begin -->
                           <div class="box3 alt">
                              <div class="right-bot-corner">
                                 <div class="left-bot-corner">
                                    <div class="inner">
                                      <table class="league-table">
                                       <thead>
                                          <tr>
                                             <td class="cell-2"></td>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td class="cell-2"><a href="#">Fecha #1 - 10/01/2010</a></td>
                                          </tr>
                                          <tr>
                                             <td class="cell-2"><a href="#">Fecha #2 - 10/01/2010</a></td>
                                          </tr>
                                          <tr>
                                             <td class="cell-2"><a href="#">Fecha #3 - 10/01/2010</a></td>
                                          </tr>
                                          <tr>
                                             <td class="cell-2"><a href="#">10/01/2010</a></td>
                                          </tr>
                                          <tr>
                                             <td class="cell-2"><a href="#">10/01/2010</a></td>
                                          </tr>
                                          <tr class="last">
                                             <td class="cell-2"><a href="#">10/01/2010</a></td>
                                          </tr>
                                       </tbody>
                                      </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- box3 end -->
                           <!-- title-box4 begin -->
                         
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