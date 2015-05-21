<?	include_once "include/config.inc.php";
	include_once "include/fechas.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	include_once "model/fechas.php";
	include_once "model/fixture.php";
	
	$modulo = "fixture";

	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new Fechas();
	$aFechas = $oObj->getIdTorneoCat($_POST['id'],'fechaIni');

	$fecha = $oObj->getFechaActual($_POST['id'],'fechaIni');

	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);
	$color = $oTorneo->color;
	
	if ( $_POST['id'] == $_POST['idActual'])
			$fecha =(isset($_POST['fecha']))? $_POST['fecha']: $fecha;
	
	$idFecha = $fecha - 1;

	$oObj1 = new Fixture();
	$aFixture = $oObj1->getByFecha($aFechas[$idFecha]['id']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:: Gambeta Femenina ::</title>
<meta name="author" content="gambetafemenina.com">
<meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física">
<meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres">
<link rel="stylesheet" href="css/home.css" type="text/css">
<link rel="stylesheet" href="css/menu_izq.css" type="text/css">
<link rel="stylesheet" href="css/fixture.css" type="text/css">
<link rel="stylesheet" href="css/paginas.css" type="text/css">
<link rel="stylesheet" href="js/thickbox.css" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<style type="text/css">
	<!--

	#wrap { margin:0 auto 0 auto; width:100%; height:100%  }
	
	#encabezado { margin:0 auto 0 auto; width:100%; height:242px;
			background-image:url(img/home/costados1.jpg);
			background-repeat:repeat-x;
   }

	#cabezal {
		background-image:url(img/home/cabezal.jpg);
		background-repeat:no-repeat;
		width:999px;
		height:242px;
		margin:0 auto 0 auto;
	}
	
	
	#quienes_somos {
		position: relative;
		left: 790px;
		top: 20px; /*442*/
		width: 170px;
		height: 25px;
		/*background-color:#F00;*/
	}	
	
	#reglamento { 
		position: relative;
		left: 790px;
		top: 35px; /*442*/ 
		width: 170px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00;*/
	}	

	#sedes { 
		position: relative;
		left: 790px;
		top: 50px; /*442*/ 
		width: 170px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00;*/
	}	

	#contacto { 
		position: relative;
		left: 790px;
		top:  65px; /*442*/ 
		width: 170px; 
		height: 25px;
		text-align:left;
		/*background-color:#F00;*/
	}		
	
	#menu { 
		position: relative;
		left: 50px; 
		top: 90px; /*442*/ 
		text-align:left;
	/*	background-color:#F00*/
	}	


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
		
		
	#faceytweet {
		/*background-image:url(img/home/faceytweet.jpg);*/
		background-repeat:no-repeat;
		width:232px;
/*		height:275px;*/
		margin:0 auto 0 auto;
		z-index:0;
		
	}


	#campo_tiempo { 
		position: relative;
		left: 37px; 
		top:  25px; /*442*/ 
		width: 90px; 
		height: 90px;
		text-align:left;
	}	
	#facebook { 
		position: relative;
		left: 35px; 
		top: 80px; /*442*/ 
		width: 190px; 
		height: 90px;
		text-align:left;
	}

	#twitter { 
		position: relative;
		left: 110px; 
		top: -10px; /*442*/ 
		width: 190px; 
		height: 90px;
		text-align:left;
	}

	#fecha { 
		position: relative;
		left: 30px; 
		top: -280px; /*442*/ 
		width: 190px; 
		height: 10px;
		text-align:left;
	}


	#titulo_auspiciante {
		width:190px;
		height:45px;
		position:relative;
		margin:60px 0px 0px 12px;
		text-align:left;		
	}


	#auspiciantes {
		clear:both;
		position:relative;
		width:210px;
		margin:0 auto 0 auto;
		text-align:left;		
	}

	#gf{ 
		position: absolute;
		left:522px; 
		top: 7px; /*442*/ 
		width: 300px; 
		height: 200px;
		text-align:left;
	/*	background-color:#F00*/
	}


	#pie_repetir { margin:0 auto 0 auto; width:100%; height:44px;
			background-image:url(img/home/pie1.jpg);
			background-repeat:repeat-x;
   }

	#pie{
		background-image:url(img/home/pie.jpg);
		background-repeat:no-repeat;
		width:999px;
		height:44px;
		margin:0 auto 0 auto;
	}
	a#link_fixture { text-decoration:none;}
	a#link_fixture:link { color: inherit; }
	a#link_fixture:hover { color: inherit; }
	a#link_fixture:visited { color: inherit; }	
	a#link_fixture:active { color: inherit; }		
	a#link_fixture:focus { color: inherit; }			

-->
</style>
<script type="text/javascript" src="_js/funciones.js"></script>
<script>
function cambiar(id){
	document.getElementById('id').value=id;
	document.form_alta.submit();
}

function cambiar_menu(url){
	document.form_alta.action = url;
	document.form_alta.submit();
}

function paginar(id){
	document.getElementById('fecha').value=id;
	document.form_alta.submit();
}
</script>
<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/>
<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'/>
</script>
<script type='text/javascript'> 
	Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
	});    
</script>
</head>
<body align="center" bgcolor="#FFFFFF" border=0 style=" width:100%; height:100%" >
<?php include_once "include/analyticstracking.php"; ?>
<form id="form_alta" name="form_alta" action="" method="post">
  <input name="id" id="id"  value="<?= $_POST['id'] ?>" type="hidden" />
  <input name="fecha" id="fecha"  value="<?= $fecha ?>" type="hidden" />
  <input name="idActual" id="idActual"  value="<?= $_POST['id'] ?>" type="hidden" />
  <div id="wrap">
    <div id="encabezado">
      <div id="cabezal">
        <div id="quienes_somos"  style="cursor:pointer" onclick="window.location = 'quienes_somos.php';"></div>
        <div id="reglamento" style="cursor:pointer"  onclick="window.location = 'reglamento.php';"></div>
        <div id="sedes" style="cursor:pointer" onclick="window.location = 'sedes.php';"></div>
        <div id="contacto"  style="cursor:pointer" onclick="window.location = 'contacto.php';"></div>
      </div>
    </div>
    <div id="cabezal1">
      <div id="menu_izq1" style="float:left"> <img  src="logos/<?= $oTorneo->logoPagina?>" />
        <? include("menu_izq.php") ?>
      </div>
      <div id="imagen" style="float:left; vertical-align:top">
        <div id="titulo_principal">
          <div  style="float:center; height:43px">
            <? for ($i = 0; $i <count( $aTorneos ); $i++) { 
                            if ( $oTorneo->id_torneo != $aTorneos[$i][id] ) {
									$aCategoriasMenu = $oObj->getByTorneo( $aTorneos[$i][id],"id_categoria");
									
								?>
            <img  src="logos/<?= $aTorneos[$i][logoMenu]?>"  onclick="cambiar(<?= $aCategoriasMenu[0][id]?>)" style="cursor:pointer" />
            <? } 
                        } ?>
          </div>
        </div>
        <div class="titulo_pagina color_titulo_<?= $color ?>" >
          <?=  strtoupper($oTorneo->nombre_pagina) ?>
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
        <div id="fixture_<?= $color ?>">
          <div  id="fixture_titulo" class="fixture_titulo1 fixture_color_<?= $color ?>">
		  		<?= strtoupper ($aFixture[0]['nombreFecha']) ?>
		  </div>
		</div>
		<div id="fixture_<?= $color ?>" style="margin-top:-17px">
          <div id="fixture_paginas"  class="fixture_paginado fixture_color_<?= $color ?>">
            <?  $total =count($aFechas);
				for ($i=1; $i<= $total; $i++ ) { if ($i != $fecha) echo '<a style="cursor:pointer" onclick="paginar('.$i.')">'.$i.'</a>';  if (($i != $total && $i != $fecha && $fecha != $total) || ($fecha == $total && $i+1<$fecha)) echo " - " ;}?>
          </div>
        </div>
        <? for ($p=0; $p<count($aFixture); $p++) {?>
        <a id="link_fixture" href="detalleFixture.php?color=<?= $color ?>&idEquipo1=<?= $aFixture[$p][idEquipo1]?>&idEquipo2=<?= $aFixture[$p][idEquipo2]?>&id=<?= $aFixture[$p][id]?>&keepThis=true&TB_iframe=true&height=600&width=600" title="" class="thickbox">
        <div id="partido_<?= $color ?>">
          <div id="fixture_nro_partido"><? echo $p+1; ?></div>
          <div id="fixture_sede"><? echo strtoupper ($aFixture[$p]['sede']); ?></div>
          <div id="fixture_cancha"><? echo strtoupper ($aFixture[$p]['cancha']); ?></div>
          <div id="fixture_equipo1"><? echo strtoupper ($aFixture[$p]['equipo1']); ?></div>
          <? $class = "fixture_color_".$color;
						if ($aFixture[$p]['golesEquipo1']<$aFixture[$p]['golesEquipo2']) { $class = "fixture_color_gris"; }
                   	if ($aFixture[$p]['golesEquipo1'] >9) { ?>
          <div id="fixture_resultado10" class="<?= $class ?>">
            <?= ($aFixture[$p]['golesEquipo1']>-1)?$aFixture[$p]['golesEquipo1']:""; ?>
          </div>
          <? } else {?>
          <div id="fixture_resultado1" class="<?= $class ?>">
            <?= ($aFixture[$p]['golesEquipo1']>-1)?$aFixture[$p]['golesEquipo1']:""; ?>
          </div>
          <? } ?>
          <div id="fixture_horaPartido"><? echo strtoupper ($aFixture[$p]['horaPartido']); ?></div>
          <div id="fixture_fechaPartido" class="fixture_color_<?= $color ?>"><? echo cambiaf_a_normal($aFixture[$p]['fechaPartido']); ?></div>
          <div id="fixture_equipo2"><? echo strtoupper ($aFixture[$p]['equipo2']); ?></div>
          <? $class = "fixture_color_".$color;
						if ($aFixture[$p]['golesEquipo2']<$aFixture[$p]['golesEquipo1']) { $class = "fixture_color_gris"; }
                   	if ($aFixture[$p]['golesEquipo2'] >9) { ?>
          <div id="fixture_resultado20" class="<?= $class ?>">
            <?= ($aFixture[$p]['golesEquipo2']>-1)?$aFixture[$p]['golesEquipo2']:""; ?>
          </div>
          <? } else {?>
          <div id="fixture_resultado2" class="<?= $class ?>">
            <?= ($aFixture[$p]['golesEquipo2']>-1)?$aFixture[$p]['golesEquipo2']:""; ?>
          </div>
          <? } ?>
        </div>
        </a>
        <? } ?>
        <div>
          <? if ($fecha != 1){?>
          <div  id="fixture_ant_<?= $color?>" onclick="paginar(<?= $fecha - 1 ?>)" style="cursor:pointer"></div>
          <? } ?>
          <? if ($fecha != $total){?>
          <div  id="fixture_sig_<?= $color?>" onclick="paginar(<?= $fecha + 1 ?>)" style="cursor:pointer"></div>
          <? } ?>
        </div>
      </div>
	  <div id="faceytweet" style="float:left">
		  <div id="titulo_auspiciante"><img src="img/home/titulo_auspiciante.jpg" /></div>
		  <div id="auspiciantes" style="float: right">
			<? include('auspiciantes.php'); ?>
		  </div>
       </div>
    </div>
    
    <div id="gf" onclick="location.href='index.php'" style="cursor:pointer"></div>
    <div id="pie_repetir" style="float:left">
      <div id="pie"></div>
    </div>
  </div>
</form>
</body>
