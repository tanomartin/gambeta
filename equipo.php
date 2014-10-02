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
	<link href="css/ie_style.css" rel="stylesheet" type="text/css" />
<![endif]-->
<style type="text/css">
<!--
.extra-wrap p {
text-align:justify;
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
        <?php
			$equipoId =  (isset($_GET['id']) ) ?  $_GET['id'] :  0;
			if($equipoId == 0)
			{
				echo "No se ha seleccionado un equipo";
				
			}
			
			$rs = ConectarRS(GetJugadoresByEquipo($equipoId)); 
			if ($rs->Eof())
			{
				echo "No se han recuperado datos del equipo";
			}
												
		?>
        <div class="row-2 wrapper">
          <div class="block">
            <div class="col-1">
              <div class="line-hor"></div>
              <div class="wrapper">
                <div class="col-1">
                  <div class="ind">
                    <!-- title-box1 begin -->
                    <div class="title-box1">
                      <div class="left-top-corner">
                        <div class="right-top-corner">
                          <div class="right-bot-corner">
                            <div class="left-bot-corner">
                              <div class="inner">
                                <div class="wrapper">
                                  <h3><?php echo $rs->Fields("nombreEquipo")?></h3>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- title-box1 end -->
                    <!-- box1 begin -->
                    <div class="box1">
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
                              <!-- detalle del equipo -->
                              <div class="border-left">
                                <div class="border-right">
                                  <div class="inner">
                                    <div class="extra-wrap">
                                     
                                      <img src="admin/uploads/<?php echo $rs->Fields("fotoEquipo")?>" class="img-indent" width="154" height="101" alt="" /><p><?php echo $rs->Fields("descripcionEquipo")?></p></div>
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
                <div class="col-2">
                  <!-- title-box2 begin -->
                  <div class="title-box2">
                    <div class="left-top-corner">
                      <div class="right-top-corner">
                        <div class="right-bot-corner">
                          <div class="left-bot-corner">
                            <div class="inner">
                              <div class="wrapper">
                                <h3>Integrantes</h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- title-box2 end -->
                  <!-- box3 begin -->
                  <!-- Proxima fecha -->
                  <div class="box3">
                    <div class="right-bot-corner">
                      <div class="left-bot-corner">
                        <div class="inner">
                          <table class="league-table">
                            <thead>
                              <tr>
                                <td width="20%" class="cell-2"></td>
                              </tr>
                            </thead>
                            <tbody>
                             <?php
											  
											  
											  	if($rs->Eof() || !$rs->Fields("id"))
													echo "No se han recuperado jugadores";
												else
												{
													while(!$rs->Eof())
													{
														echo "<tr><td><img src=\"admin/uploads/".$rs->Fields("fotoJugador")."\" width=\"55\" height=\"55\" alt=\"\" /></td><td width=\"80%\">".$rs->Fields("nombreJugador")."<br /><a href=\"jugador.php?id=".$rs->Fields("id")."\">ficha personal</a>&nbsp;<img src=\"images/marker.gif\" width=\"15\" height=\"15\" alt=\"\" /></td></tr>";
														//echo sprintf("%s, %s %s", $rs->Fields("fotoJugador"), $rs->Fields("nombreJugador"), $rs->Fields("id"));
														
														$rs->moveNext();
													}
												}
												
											   ?>
                              
                              
                            </tbody>
                          </table>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <!-- box3 end -->
              </div>
            </div>
            <div class="line-hor"></div>
            <!-- BannerFoot -->
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