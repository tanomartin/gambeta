<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/equipos.php";
	include_once "model/torneos.php";
	
	$modulo = "reserva";
	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);

	$oObj = new TorneoCat();
	$id = $oObj->obtenerIdCat($_POST['id'],$oTorneo->id_torneo,$idCatPadre);

	$oObj = new Equipos();
	$aEquipos = $oObj->getTorneoCat($_POST['id']);
	
	$oObj = new TorneoCat();
	$aCategorias = $oObj->getByTorneoSub($oTorneo->id_torneo);

	$color = $oTorneo->color;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>:: Gambeta Femenina ::</title>
<meta name="author" content="gambetafemenina.com"/>
<meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física"/>
<meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres"/>
<link rel="stylesheet" href="css/home.css" type="text/css"/>
<link rel="stylesheet" href="css/menu_izq.css" type="text/css"/>
<link rel="stylesheet" href="css/paginas.css" type="text/css"/>
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
	
	#reserva {
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
		
		
	#faceytweet {
		/*background-image:url(img/home/faceytweet.jpg);*/
		background-repeat:no-repeat;
		width:232px;
/*		height:275px;*/
		margin:0 auto 0 auto;
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
	

	/* En este contenedor va todo lo que queremos mostrar. No le damos margen vertical puesto ese lo generarán los span del borde */
	div.contenido{ 
	   margin:10px;
	}
	/* Generamos los estilos de las span, los cuales contendrán las imágenes GIF */
	span.top, span.bottom{
	   width:100%;
	   height:4px; /* El alto debe ser la mitad de alto de la imagen GIF */
	   display:block;
	}
	/* A continuación viene el verdadero truco, la posición de las imágenes de fondo es importante*/
	span.top {
	   background:url(img/home/si.gif) top left no-repeat; 
	}
	span.bottom{
	   background:url(img/home/ii.gif) bottom left no-repeat;
	}
	span.top span, span.bottom span{
	   width:4px; /* De acuerdo al tamaño de la imagen GIF */
	   height:4px;/* De acuerdo al tamaño de la imagen GIF */
	   float:right;
	   font-size:4px; /* Esto es para IE6, que no respeta el height del span si el tamaño de letra es mayor a este  */
	}
	span.top span{
	   background:url(img/home/sd.gif) top right no-repeat;
	}
	span.bottom span{
	   background:url(img/home/id.gif) bottom right no-repeat;
	}
	
	.caja { 
		width: 520px; 
		background-image: url("img/home/centro.jpg"); 
		background-repeat: repeat-y; 
	} 

	.cajaarriba { 
		background-image: url("img/home/arriba.jpg"); 
		background-position: top center; 
		background-repeat: no-repeat; 
	} 

	.cajaabajo { 
		background-image: url("img/home/abajo1.jpg"); 
		background-position: bottom left; 
		background-repeat: no-repeat;
		padding-top:10px;
		padding-bottom:5px;
		margin-left:-1px	
	
	} 
	
-->
</style>
<script type="text/javascript" src="_js/funciones.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script>

function cambiar(id){
	document.getElementById('id').value=id;
	document.form_alta.submit();
}

function cambiar_menu(url){
	document.form_alta.action = url;
	document.form_alta.submit();
}

jQuery(function($){	
	$("#ingresar").click(function() {
  		$("#error").html("");
		var pwd = $("#pwd").val();
		var equipo = $("#equipo").val();
		var id = $("#id").val();
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: "reserva_control_ingreso.php",
			data: {pwd:pwd, equipo:equipo, id:id},
		}).done(function(respuesta){
			if (respuesta == 0) {
				document.form_alta.action = "reserva_menu.php";
				document.form_alta.submit();
			} else {
				$("#error").html(respuesta);
				$("#equipo").val(0);
				$("#pwd").val("");
			}
		});
	});
});

function pulsar(e) { 
  tecla = (document.all) ? e.keyCode :e.which; 
  return (tecla!=13); 
} 

</script>
<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/>
<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'></script>
<script type='text/javascript'> 
	Shadowbox.init({ 
		overlayColor: "#000", 
		overlayOpacity: "0.6", 
	});    
</script>
</head>
<body bgcolor="#FFFFFF" style=" width:100%; height:100%" >
<?php include_once "include/analyticstracking.php"; ?>
<form id="form_alta" name="form_alta" action="" method="post">
  <input name="id" id="id"  value="<?= $_POST['id'] ?>" type="hidden" />
  <input name="color" id="color"  value="<?= $color ?>" type="hidden" />
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
            <img width="50px" height="50px"   src="logos/<?= $aTorneos[$i][logoPrincipal]?>"  onclick="cambiar(<?= $aCategoriasMenu[0][id]?>)" style="cursor:pointer" />
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
						 if($aCategorias[$i][id] == $id) { 
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
        <div id="reserva">
          <div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">RESERVA DE HORARIO DE PARTIDO</div>
          <br />
          <div align="center">
            <div id="error" style="color:#FF0000; font-weight:bold"></div>
            <p>
              <select name="equipo" id="equipo">
                <option value="0" selected="selected">Seleccione Su Equipo</option>
                <? if($aEquipos != NULL) {
									 foreach ($aEquipos as $equipo) { ?>
                <option value="<? echo $equipo['id']?>"><? echo $equipo['nombre']?> </option>
                <?	}	
							  }?>
              </select>
            </p>
            <p>
              <input type="password" id="pwd" name="pwd" placeholder="Contraseña" style="text-align:center" onkeypress="return pulsar(event)"/>
            </p>
            <p>
              <input type="button" name="ingresar" id="ingresar" value="Ingresar"/>
            </p>
          </div>
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
</html>