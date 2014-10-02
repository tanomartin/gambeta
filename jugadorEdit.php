<?php
	session_start(); // Initialize session data
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
	<link href="css/ie_style.css" rel="stylesheet" type="text/css" />
<![endif]-->
<style type="text/css">
<!--
fieldset
{
	margin-bottom: 25px;
	padding: 10px;
	border: 1px solid #999;
}

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
#perfil .titulo {
	color:#A82C16;
}
-->
</style>
<script type="text/javascript">
function Validar()
{
	if(window.document.getElementById("passwd1").value != window.document.getElementById("passwd2").value)
	{
		alert("Las contraseñas ingresadas son distintas.");
	} else {
		window.document.getElementById("frmPerfil").submit();
	}
}
</script>
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
                                <h3>Perfil del jugador</h3>
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
                  <form name="frmPerfil" id="frmPerfil" action="jugadorSave.php" method="post">
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
							<?php 
							$id =  ($_SESSION[userId] ) ?  $_SESSION[userId] :  0;
							$msgEdit =  ($_SESSION[msgEdit] ) ?  $_SESSION[msgEdit] :  "";
							
							if($msgEdit != "")
								echo "Perfil modificado con éxito!";
							
							$_SESSION[msgEdit] = "";
							
							$rs = ConectarRS(GetJugadorById($id)); 
		
							if ($id == 0)
							{
								echo "No hay registros para modificar";
							} else {?>
                            <div id="preguntas">
                              <p class="pregunta"><?php echo GetResource("preg1") ?></p>
                              <p class="respuesta">
                                <textarea name="preg1" id="preg1" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta1"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg2") ?></p>
                              <p class="respuesta">
                                <textarea name="preg2" id="preg12" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta2"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg3") ?></p>
                              <p class="respuesta">
                                <textarea name="preg3" id="preg3" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta3"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg4") ?></p>
                              <p class="respuesta">
                                <textarea name="preg4" id="preg4" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta4"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg5") ?></p>
                              <p class="respuesta">
                                <textarea name="preg5" id="preg5" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta5"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg6") ?></p>
                              <p class="respuesta">
                                <textarea name="preg6" id="preg6" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta6"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg7") ?></p>
                              <p class="respuesta">
                                <textarea name="preg7" id="preg7" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta7"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg8") ?></p>
                              <p class="respuesta">
                                <textarea name="preg8" id="preg8" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta8"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg9") ?></p>
                              <p class="respuesta">
                                <textarea name="preg9" id="preg9" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta9"); ?></textarea>
                              </p>
                              <p class="divisor"></p>
                              <p class="pregunta"><?php echo GetResource("preg10") ?></p>
                              <p class="respuesta">
                                <textarea name="preg10" id="preg10" style="width:350px;" cols="70" rows="2" ><?php echo  $rs->Fields("pregunta10"); ?></textarea>
                              </p>
                            </div>
                            <div id="perfil"><p class="titulo"><?php echo  $rs->Fields("nombre"); ?></p> <img src="admin/uploads/<?php echo  $rs->Fields("fotoPreview"); ?>" width="75" height="75" alt="" />
                              
                              <br />
                              <p>Acerca de mi...</p>
                              <p>
                                <textarea name="acerca" id="acerca" style="width:250px;" cols="70" rows="15" ><?php echo trim(ereg_replace("<br />","\n", $rs->Fields("acercaMio"))); ?></textarea>
                              </p>
                              <p>
                              <fieldset>
                                <legend>Contraseña</legend>
                                <table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td>Nueva contraseña</td>
                                  </tr>
                                  <tr>
                                    <td><input name="passwd1" id="passwd1" type="password" /></td>
                                  </tr>
                                  <tr>
                                  <tr>
                                    <td>Repetir nueva contraseña</td>
                                  </tr>
                                  <tr>
                                    <td><input name="passwd2" id="passwd2"  type="password" /></td>
                                  </tr>
                                  <tr>
                                </table>
                              </fieldset>
                              <p> 
                            </div>
							<?php } ?>
	
                            <div class="wrapper"></div>
                          </div>

                          <div style="text-align:center">
						  <?php if ($id > 0)
						  {?>
                          <input name="Aceptar" type="button" value="Aceptar" onclick="javascript: Validar();" />
						  <?php } ?>
                          <input name="Aceptar" type="reset" value="Limpiar" />
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
                  </form>
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