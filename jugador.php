<?php
	include("includes/claseRecordSet.php");
  	include("includes/conexion.php");
	include("includes/queries.php");
	include("includes/multiTorneo.php");
	include("includes/preguntasPerfil.php");
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
#preguntas {
	/*background-color: #CCC;*/
	float:left;
	width: 400px;
	padding: 15px;
}



#preguntas p {
	margin: 0px;
	padding: 0px;
}

#preguntas .pregunta {
	color:#A82C16;
	background-image:url(images/arrow1.gif);
	background-repeat: no-repeat;
	background-position: left;	
	padding-left: 10px;
	
}

#preguntas .divisor {
	border-top-width: 1px;
	border-top-style: dotted;
	border-top-color: #333;	
	height: 7px;
	margin-top: 7px;
	
}


#perfil {
	/*background-color: #FFC;*/
	float:left;
	height: 100px;
	margin-left:10px;
	width: 260px;
}

#perfil p 
{
	text-align:justify;
}

#perfil .titulo {
 color:#A82C16;
 
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
                          <div>
                              <!-- title-box2 begin -->
                              <div class="title-box2">
                                 <div class="left-top-corner">
                                    <div class="right-top-corner">
                                       <div class="right-bot-corner">
                                          <div class="left-bot-corner">
                                             <div class="inner">
                                                <div class="wrapper">
                                                <h3>Perfil del jugador</h3></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- title-box2 end -->
                              <!-- box3 begin -->

								  <!-- Proxima fecha -->
								 
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
				
				<div id="preguntas">
					<?php 
					$id =  (isset($_GET['id']) ) ?  $_GET['id'] :  0;
					
					$rs = ConectarRS(GetJugadorById($id)); 

					if ($rs->Eof())
					{
						echo "No hay registros para mostrar";
						return false;
					}

					 if ($rs->Eof())
					{ ?>
						<p class="pregunta"><?php echo GetResource("preg1") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg2") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg3") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg4") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg5") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg6") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg7") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg8") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg9") ?></p>
						<p class="respuesta">&nbsp;</p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg10") ?></p>
						<p class="respuesta">&nbsp;</p>
	        		<?php 
					} else { ?>
						<p class="pregunta"><?php echo GetResource("preg1") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta1") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg2") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta2") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg3") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta3") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg4") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta4") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg5") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta5") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg6") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta6") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg7") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta7") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg8") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta8") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg9") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta9") ?></p>
						<p class="divisor"></p>
						<p class="pregunta"><?php echo GetResource("preg10") ?></p>
						<p class="respuesta"><?php echo $rs->Fields("pregunta10") ?></p>
					<?php 
					}
					?>
                </div>
                
                <div id="perfil">
					<?php if ($rs->Eof())
					{ ?>
                		<img src="admin/uploads/jugadora.gif" width="75" height="75" alt="" class="img-indent" />
					<?php 
					} else {
					?>
						<img src="admin/uploads/<?php echo $rs->Fields("fotoPreview"); ?>" width="75" height="75" alt="" class="img-indent" />
					<?php 
					}
					?>

					<?php if ($rs->Eof())
					{ ?>
						<p class="titulo">&nbsp;</p><p>&nbsp;</p>
					<?php 
					} else {
					?>
						<p class="titulo"><?php echo $rs->Fields("nombre"); ?></p><p><?php echo $rs->Fields("acercaMio"); ?></p>
					<?php 
					}
					?>					

                </div>
                
				
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