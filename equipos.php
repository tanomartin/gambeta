<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	include_once "model/equipos.php";
	include_once "model/jugadoras.php";
	
	$modulo = "equipos";

	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new Equipos();
	$aEquipos = $oObj->getTorneoCat($_POST['id']);
	
	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);
	$color = $oTorneo->color;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>:: Gambeta Femenina ::</title>
	<meta name="author" content="gambetafemenina.com"/>
	<meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física"/>
	<meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres"/>
	<link rel="stylesheet" href="css/home.css" type="text/css"/>
	<link rel="stylesheet" href="css/menu_izq.css" type="text/css"/>
	<link rel="stylesheet" href="css/equipos.css" type="text/css"/>
	<link rel="stylesheet" href="css/paginas.css" type="text/css"/>
	<style type="text/css">
	
		#cabezal1 {
			width:999px;
			margin:0 auto 0 auto;
		}
	
		#menu_izq1 {
			float:left;
			width:166px;
			margin-left: 55px;
			clear: both;
		}
	
		#imagen {
			float:left;		
			width:570px;
			margin-top:5px;
			margin-left:-25px;
		}
	
		#categorias {
			position:relative;		
			width:520px;
			height:54px;
			margin-left:50px
		}
	
		#titulo_principal{
			position:relative;
			width:520px;
			height:54px;
			margin-left:50px
		}
			
		#titulo_auspiciante {
			width:190px;
			height:45px;
			position:relative;
			margin:58px 0px 0px -10px;
			text-align:left;		
		}
		
		#auspiciantes {
			clear:both;
			position:relative;
			width:210px;
			margin:0 auto 0 auto;
			text-align:left;		
		}
	
	</style>
	<script type="text/javascript" src="_js/funciones.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
	<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'></script>
	<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/> 
	<script>
	function cambiar(id){
		document.getElementById('id').value=id;
		document.form_alta.submit();
	}
	
	function cambiar_menu(url){
		document.form_alta.action = url;
		document.form_alta.submit();
	}
	
	Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
	});  
	</script>
</head>
<body bgcolor="#FFFFFF" style="width:100%; height:100%" >
<?php include_once "include/analyticstracking.php"; ?>
<form id="form_alta" name="form_alta" action="" method="post">
  <input name="id" id="id"  value="<?= $_POST['id'] ?>" type="hidden" />
  <input name="color" id="color"  value="<?= $color ?>" type="hidden" />
  <div id="wrap">
 	<div id="encabezado">	  
		  <div id="cabezal">
				 <div id="gf" onclick="location.href='index.php'" style="cursor:pointer"></div>
				 <div id="facebook" style="cursor:pointer" onclick="window.open('https://www.facebook.com/gambeta.femenina');"></div>
		  		 <div id="twitter" style="cursor:pointer" onclick="window.open('https://twitter.com/GambetaFemenina');"></div>
				 <div id="instagram" style="cursor:pointer" onclick="window.open('https://instagram.com/gambetafemenina');"></div> 
				 <div id="youtube" style="cursor:pointer" onclick="window.open('https://www.youtube.com/user/gambetafemenina2012');"></div> 
				 <div id="quienes_somos"  style="cursor:pointer" onclick="window.location = 'quienes_somos.php';"></div>
                 <div id="reglamento" style="cursor:pointer"  onclick="window.location = 'reglamento.php';"></div>
                 <div id="sedes" style="cursor:pointer" onclick="window.location = 'sedes.php';"></div>
                 <div id="contacto"  style="cursor:pointer" onclick="window.location = 'contacto.php';"></div>
            </div> 
		 </div>
    <div id="cabezal1">
      <div id="menu_izq1" style="float:left"> 
      <div align="center"><img width="120px" height="120px"  src="logos/<?= $oTorneo->logoPrincipal?>" /></div>
        <? include("menu_izq.php") ?>
        </div>
      <div id="imagen" style="float:left; vertical-align:top">
        <div id="titulo_principal">
          <div  style="float:center;height:43px" align="center">
            <? for ($i = 0; $i <count( $aTorneos ); $i++) { 
                            if ( $oTorneo->id_torneo != $aTorneos[$i][id] ) {
									$aCategoriasMenu = $oObj->getByTorneo( $aTorneos[$i][id],"id_categoria");
									
								?>
            <img title="<?= $aTorneos[$i][nombre]?>" width="50px" height="50px" src="logos/<?= $aTorneos[$i][logoPrincipal]?>"  onclick="cambiar(<?= $aCategoriasMenu[0][id]?>)" style="cursor:pointer" />
            <? } 
                        } ?>
          </div>
        </div>
        <div class="titulo_pagina color_titulo_<?= $color ?>" >
          <?=  strtoupper($oTorneo->nombre) ?>
        </div>
        <div id="categorias">
          <div class="titulo_categoria color_categoria" style="float:left;">CATEGORIA</div>
          <? for ($i=0; $i<count($aCategorias);$i++) {
						 if($aCategorias[$i][id] == $_POST['id']) { 
						?>
          <div style="float:left" class="color_categoria_seleccionada_<?= $color ?>">
            <? if ( $aCategorias[$i][nombreCatPagina] != "" ) { echo strtoupper($aCategorias[$i][nombreCatPagina]). "-";} ?>
            <?= strtoupper($aCategorias[$i][nombrePagina]) ?>
          </div>
          <? } else { ?>
          <div style="float:left; cursor:pointer" class="categoria_submenu" onclick="cambiar(<?= $aCategorias[$i][id]?>)">
            <? if ( $aCategorias[$i][nombreCatPagina] != "" ) { echo strtoupper($aCategorias[$i][nombreCatPagina]). "-";} ?>
            <?= strtoupper($aCategorias[$i][nombrePagina]) ?>
          </div>
          <? }
						
							if ($i+1 < count($aCategorias)) { ?>
          <div style="float:left" class="categoria_linea_<?= $color ?>">|</div>
          <? } 
					}?>
        </div>
        <? for ($i=0; $i<count($aEquipos); $i++ ) {?>
        <div style="float:left; margin-left:50px">
          <? if($aEquipos[$i]['fotoPreview']) { ?>
          <div  style=" float:left; margin-left:-18px"><img src="thumb/phpThumb.php?src=../fotos_equipos/<?= $aEquipos[$i]['fotoPreview']?>" width="165" height="129" border="0" hspace="8" vspace="8" /></div>
          <? } else  {?>
          <div  style=" float:left; margin-left:-18px"><img src="thumb/phpThumb.php?src=../fotos_equipos/default_<?= $color ?>.jpg" width="165" height="129" border="0" hspace="8" vspace="8" /></div>
          <? } ?>
          <div style="float:right">
            <div class="titulo_equipos color_<?= $color ?>">
              <?= strtoupper ($aEquipos[$i]['nombre']) ?>
            </div>
            <? 
					   		$oObj = new Jugadoras();
							 
							 $aJugadoras = $oObj->getByEquipo($aEquipos[$i]['id']);
							 
							 $j=0;
							 
							 while ($j < count($aJugadoras)) { ?>
            <div class="jugadoras" style="width:165px; float:left">
              <?= $aJugadoras[$j]['nombre'] ?>
            </div>
            <?  $j++;
							  if ($j < count($aJugadoras)) { ?>
            <div class="jugadoras" align="left"  style="float:right; width:165px;">
              <?= $aJugadoras[$j]['nombre'] ?>
            </div>
            <? } $j++; ?>
            <br />
            <? }?>
          </div>
        </div>
        <? } ?>
      </div>
	  <div style="float:left">
		  <div id="titulo_auspiciante"><img src="img/home/titulo_auspiciante.jpg" /></div>
		  <div id="auspiciantes" style="float: right">
			<? include('auspiciantes.php'); ?>
		  </div>
       </div>
    </div>
    <div id="pie_repetir" style="float:left">
      <div id="pie"></div>
    </div>
  </div>
</form>
</body>
</html>