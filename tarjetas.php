<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/equipos.php";	
	include_once "model/jugadoras.php";	
	include_once "model/resultados.php";
	include_once "model/torneos.php";
	$modulo = "tarjetas";


	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);
	
	$oObj = new Equipos();
	$aEquipos = $oObj->getTorneoCat($_POST['id']);

	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);
	$color = $oTorneo->color;
	
	$oJugadora = new Jugadoras();
	$oResultados = new Resultados();
	for($j=0;$j<count($aEquipos);$j++) {
		$aJugadoras1 = $oJugadora->getByEquipoTorneo( $aEquipos[$j]['id'], $_POST['id']);		
		for ($i=0; $i<count($aJugadoras1); $i++) {
			$tarj =  $oResultados->getTarjetasByIdJugadoraEquipo($aJugadoras1[$i][idJugadoraEquipo]);
			$arreglo[$aJugadoras1[$i][id]][amarillas] = ($tarj[0][amarillas])?$tarj[0][amarillas]:0;
			$arreglo[$aJugadoras1[$i][id]][rojas] = ($tarj[0][rojas])?$tarj[0][rojas]:0;		
		}
	}


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
	<link rel="stylesheet" href="css/tarjetas.css" type="text/css"/>
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
			width:530px;
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
	
	
	function createInstance() {
		if (window.XMLHttpRequest) {
			return new XMLHttpRequest();
		}
		else if (window.ActiveXObject) {
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	
	function cambiarResultado(idEquipo){
		var xhr;
		xhr = createInstance();
		xhr.open("POST","cargarResultado.php",false);
		xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
		var id = document.getElementById('id').value;
		var color = document.getElementById('color').value;
		xhr.send("id="+id+"&color="+color+"&idEquipo="+idEquipo);
		window.document.getElementById("resultados").innerHTML = xhr.responseText;
	}
	
	Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
	});  

	$(function(){
	     $("#encabezado").load("include/cabezal.html"); 
	});
	</script>

</head>
<body bgcolor="#FFFFFF" style=" width:100%; height:100%" >
<?php include_once "include/analyticstracking.php"; ?>
<form id="form_alta" name="form_alta" action="" method="post">
  <input name="id" id="id"  value="<?= $_POST['id'] ?>" type="hidden" />
  <input name="color" id="color"  value="<?= $color ?>" type="hidden" />
  <div id="wrap">
    <div id="encabezado"></div>
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
            <img title="<?= $aTorneos[$i][nombre]?>" width="50px" height="50px"  src="logos/<?= $aTorneos[$i][logoPrincipal]?>"  onclick="cambiar(<?= $aCategoriasMenu[0][id]?>)" style="cursor:pointer" />
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
        <br />
        <br />
        <div style="float:left; margin-left:50px; margin-top:-30px">
          <div class="detalle_tarjeta" style="clear:both; height: auto;">
            <div style="height:35px">&nbsp;</div>
            <div class="detalle_desarrollo" style="clear:both; height: auto;">
              <? if($arreglo) { 
										foreach ($arreglo as $key => $valor) {
												$aJugadora = $oJugadora->get($key);
											if (($valor[amarillas] - $aJugadora[0][amarillas]>0) || ($valor[rojas] - $aJugadora[0][rojas]>0)) {
											
											?>
              <div id="fila" style="width:247px; height:30px; padding-top:10px; float:left;">
                <div class="jugadoras1" style="height:30px;">
                  <?= $aJugadora[0]['nombre'] ?>
                </div>
                <div class="tarjetas" style=" height:30px;">
                  <?= $valor[amarillas] - $aJugadora[0][amarillas] ?>
                </div>
                <div class="tarjetas" style=" height:30px; left:25px">
                  <?= $valor[rojas] - $aJugadora[0][rojas] ?>
                </div>
                <div class="tarjetas" style=" height:30px; left:70px">
                  <?=  $aJugadora[0]['observaciones'] ?>
                </div>
              </div>
              <div class="detalle_desarrollo_linea1"  style="clear:both"></div>
              <? } 
									 }
								   }?>
            </div>
          </div>
        </div>
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