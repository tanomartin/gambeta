<?  include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/equipos.php";
	include_once "model/torneos.php";
	include_once "model/categorias.php";
	include_once "model/fechas.php";
	
	$oObj = new Torneos();
	$oTorneo = $oObj->getByTorneoCat($_SESSION['id']);
	
	$idTorneo = $oTorneo->id_torneo;
	$idZona = $oTorneo->id_categoria;
	$idCategoria = $oTorneo->id_padre;

	$oEquipo = new Equipos();
	$equipo = $oEquipo->getById($_SESSION['equipo']);

	$torneo = $oObj->get($idTorneo);
	$oCategoria = new Categorias();
	$zona = $oCategoria->get($idCategoria);
	$categoria = $oCategoria->get($idZona);
	
	$oFechas = new Fechas();
	$fecha_activa = $oFechas->getFechaActiva($_SESSION['id']);
	if ($fecha_activa!=NULL) {
		$horas_fecha = $oFechas->getHorasCancha( $fecha_activa["id"]);
	} else {

	}
	$color = $oTorneo->color;
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
	<link rel="stylesheet" href="css/paginas.css" type="text/css">
	<link rel="stylesheet" href="css/equipos.css" type="text/css">
    
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
		background-image:url(img/home/faceytweet.jpg);
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
		text-align:left;		
	}
	
	#auspiciantes {
		clear:both;
		position:relative;
		width:210px;
		margin:0 auto 0 auto;
		border-left: 2px solid #CCC;
		text-align:left;		
	}

	#gf{
		position: relative;
		left: 480px;
		top: -230px;
		width: 300px;
		height: 200px;
		text-align:left;
		/*background-color: #000000;*/
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
</script>
</head>
   
<body align="center" bgcolor="#FFFFFF" border=0 style=" width:100%; height:100%" >
<form id="carga_reserva" name="carga_reserva" action="" method="post">
	<input name="id" id="id"  value="<?= $id ?>" type="hidden" />
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
  			<div id="menu_izq1" style="float:left"><img  src="logos/<?= $oTorneo->logoPagina?>" /></div>
			<div id="imagen" style="float:left; vertical-align:top">
            	<div id="titulo_principal" class="titulo_pagina color_titulo_<?= $color ?>">
                    <div  style="float:left; bottom:0px; position:absolute;" ><?=  strtoupper($oTorneo->nombre_pagina)." - ".$zona[0]["nombreLargo"]." - ".$categoria[0]["nombreLargo"] ?></div>
                </div>
				<br>
			   <div id="reserva">	
					<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;"><font color="#000000"><?= strtoupper ($equipo->nombre) ?></font> | <? echo $fecha_activa["nombre"] ?></div>
					<br /><br />
					<div class="titulo_reserva" style="float:left;">Horarios Disponibles</div>
					<br /><br />
					<div style="text-align:left">
						<?  
							foreach ($horas_fecha as $hora) {
								print("<input type='checkbox' value='".$hora["id"]."'> ".$hora["descripcion"]."</input>");
								print("<br>");
						} ?>
					</div>
					<br /><br />
					<div style="text-align:left"><input type='checkbox' value='libre'>Fecha Libre </input></div>
					<br /><br />
					<div class="titulo_reserva" style="float:left;">Observacion</div>
					<textarea name="observacion" id="observacion"  cols="50" rows="4" style="float:left"></textarea>
			    </div>
			</div>
        </div>    
		   
        <div id="gf" onclick="location.href='index.php'" style="cursor:pointer"></div>      
    </div>   
    </form>
	<div id="pie_repetir" style="float:left">
		<div id="pie"></div>
    </div> 
</body>