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
.divisor {
	border-top-width: 1px;
	border-top-style: dotted;
	border-top-color: #333;	
	height: 7px;
	margin-top: 7px;
	float:none;
	
}
.galeriaBox {
	background-color: #CCC;	
	margin-bottom: 10px;
	float:none;
}

.galeriaBox .galeriaFoto {
	width: 90px;
}

.galeriaBox p {
	margin: 0px;
	padding:0px;

}
.galeriaBox .titulo a {
	font-size: 14px;
	font-weight:normal;
	color:#036;
	text-decoration: none;
	
}
.galeriaBox .titulo a:hover {
	font-size: 14px;
	font-weight:normal;
	color:#036;
	text-decoration: underline;
	
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
								  <?php //include("secciones/GaleriasLista.php"); ?> 
                                  
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
					$rs = ConectarRS(GetGaleriaFotosList()); 
					$cantidad = $rs->recordCount();
					$i = 1;
					while(!$rs->Eof())
					{
						
						
						if(!$rs->Fields("imagen"))
							$foto = "images/galeria_sin_foto.gif";
						else
							$foto =  "admin/uploads/". $rs->Fields("imagen");
						
						?>
                        <div class="galeriaBox">
                       
                          <div class="fleft galeriaFoto"><img src="<?php echo $foto ?>" alt="" height="60" width="60" /></div>
                        
                        
                        <div class="fleft galeriaDetalle">
                            <p class="titulo"><a href="galeriaDetalle.php?id=<?php echo $rs->Fields("id");?>"><?php echo $rs->Fields("nombre"); ?> </a></p>
                            <p>Cantidad de elementos: <?php echo $rs->Fields("cantidad"); ?></p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php if ($cantidad != $i) { ?>
                    
                    	<div class="divisor"></div>
                        
                    <?php
					}
						
						
/*						if(!$rs->Fields("imagen"))
						{
							echo "<div class=\"noticiaBox\" ><a href=\"MostrarRecursos.php?id=".$rs->Fields("id")."\">".$rs->Fields("nombre")." <br />".$rs->Fields("cantidad")." recursos</a></div>";
						}
						else
						{
							echo "<div class=\"noticiaBox\" ><a href=\"MostrarRecursos.php?id=".$rs->Fields("id")."\"><img src=\"admin/uploads/".$rs->Fields("imagen")."\" width=\"55\" border=\"0\" height=\"55\" alt=\"\" /></a><a href=\"MostrarRecursos.php?id=".$rs->Fields("id")."\">".$rs->Fields("nombre")." <br />".$rs->Fields("cantidad")." recursos</a></div>";
						}
						echo "<br />";
*/						
						$rs->moveNext();
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