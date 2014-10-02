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
<style type="text/css">
		@import url(css/milkbox/milkbox.css);/* Milkbox css */
		
		#galerias h1 {
			color: #666;
			}
	</style>

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
                          <div>
                              <!-- title-box2 begin -->
                              <div class="title-box2">
                                 <div class="left-top-corner">
                                    <div class="right-top-corner">
                                       <div class="right-bot-corner">
                                          <div class="left-bot-corner">
                                             <div class="inner">
                                                <div class="wrapper">
                                                <h3>Galería de recursos</h3></div>
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
				<div id="galerias">
				
                    <?php 
                        function GetImageRow($fotoPreview, $fotoLarge)
                        {
                            $row = sprintf("<td><a href=\"admin/uploads/%s\" rel=\"milkbox[gall1]\"><img src=\"admin/uploads/%s\"  width=\"154\" height=\"101\" alt=\"\" /></a></td>", $fotoLarge, $fotoPreview);
                            return $row;
                        }
                    ?>                
                    <?php
                    $galeriaId =  (isset($_GET["id"]) ) ?  $_GET["id"] :  "0";
                    
                    
                    
                    $rs = ConectarRS(GetFotosList($galeriaId)); 
                    if ($rs->Eof())
                    {
                        echo "<br /><p style=\"margin-left:20px;\">No hay elementos que mostrar.<p>";
                    }
                    else
                    {
                    ?>
                    	<?php if( $rs->Fields("esFoto") == "1") { ?>
                    	<h1>Fotos</h1>
                        <table  border="0" cellspacing="10" cellpadding="10">
                        <?php
                        while(!$rs->Eof())
                        {
                        ?>
                            <tr>
                                <td><?php if(! $rs->Eof() && $rs->Fields("esFoto") == "1") echo GetImageRow($rs->Fields("fotoPreview"), $rs->Fields("fotoLarge")); $rs->moveNext();?></td>
                                <td><?php if(! $rs->Eof() && $rs->Fields("esFoto") == "1") echo GetImageRow($rs->Fields("fotoPreview"), $rs->Fields("fotoLarge")); $rs->moveNext();?></td>
                                <td><?php if(! $rs->Eof() && $rs->Fields("esFoto") == "1") echo GetImageRow($rs->Fields("fotoPreview"), $rs->Fields("fotoLarge")); $rs->moveNext();?></td>
                                <td><?php if(! $rs->Eof() && $rs->Fields("esFoto") == "1") echo GetImageRow($rs->Fields("fotoPreview"), $rs->Fields("fotoLarge")); $rs->moveNext();?></td>
                            </tr>
                         <?php } //fin del while ?>
                         </table>
                     <?php } //fin del if galeria fotos
					 else 
					 { ?>
					<h1>Videos</h1>
               <div style="margin-left:20px; margin-top:20px;">
               <?php 
			    while(!$rs->Eof())
                {
					echo $rs->Fields("video");
					$rs->moveNext();
				}
 
			   ?>
               <!-- <object width="425" height="344"><param name="movie" value="http://www.youtube.com/v/38g1Q5x2L3U&hl=es_ES&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/38g1Q5x2L3U&hl=es_ES&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed></object>-->
               
                </div>
					<?php 
					 } //fin de es video
					} //fin del if hay registros
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
   <script type="text/javascript" src="js/mootools-1.2.3.1-assets.js"></script> 
	<script type="text/javascript" src="js/milkbox.js"></script>
</body>
</html>