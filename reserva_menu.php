<?  include_once "include/config.inc.php";
	include_once "include/fechas.php";
	include_once "model/torneos.categorias.php";
	include_once "model/equipos.php";
	include_once "model/torneos.php";
	include_once "model/categorias.php";
	include_once "model/fechas.php";
	include_once "model/reservas.php";
	include_once "model/fixture.php";
	include_once "model/sedes.php";
	
	if(!session_is_registered("equipo")){
		header("Location: index.php");
		exit;
	}
	
	//OBTENGO EL TORENO CON SU ZONA Y CATETEGORIA
	$oObj = new Torneos();
	$oTorneo = $oObj->getByTorneoCat($_SESSION['id']);
	$idTorneo = $oTorneo->id_torneo;
	$idZona = $oTorneo->id_categoria;
	$idCategoria = $oTorneo->id_padre;
	$torneo = $oObj->get($idTorneo);
	$oCategoria = new Categorias();
	$zona = $oCategoria->get($idCategoria);
	$categoria = $oCategoria->get($idZona);

	//OBTENGO EL EQUIPO
	$oEquipo = new Equipos();
	$equipo = $oEquipo->getById($_SESSION['equipo']);
	
	//OBTENGO LA FECHA ACTIVA
	$oFechas = new Fechas();
	$fecha_activa = $oFechas->getFechaActiva($_SESSION['id']);
	
	//CONTROLO QUE EXISTA UNA FECHA ACITVA
	if ($fecha_activa!=NULL) {
		//VEO SI YA EXISTE PARTIDO
		$oFixture = new Fixture();
		$partido = $oFixture->getByEquipo($_SESSION['id'],$_SESSION['equipo']);
		//VEO SI EXISTE UNA RESERVA PARA ESTE EQUIPO
		if ($partido == NULL) {	
			$idReserva = $oEquipo->tieneReserva($fecha_activa["id"],$_SESSION['equipo']);
			if ($idReserva == 0) {
				//OBETENGO HORAS Y SI EL EQUIPO YA PIDIO FECHA LIBRE PARA ESTE TORNEO
				$horas_fecha = $oFechas->getHorasCancha($fecha_activa["id"]);
				$fechaLibre = $oEquipo->tieneFechaLibre($_SESSION['id'],$_SESSION['equipo']);
			} else {
				//OBTENGO LA RESERVA
				$oReserva = new Reservas();
				$reserva = $oReserva->getReservaById($idReserva);
				if ($reserva->fecha_libre == 0) {
					//OBTENGO EL DETALLE DE LA RESERVA
					$detalleReserva = $oReserva->getDetalleReservaById($idReserva);
				}
			}
		}
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
	<link rel="stylesheet" href="css/fixture.css" type="text/css">
	
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

function controlLibre() {
 	var grupo = document.getElementById("carga_reserva").horas;
	var controlCheck = 0;
	for (i = 0; lcheck = grupo[i]; i++) {
        if (lcheck.checked) {
            controlCheck = 1;
        }
    }
	if (controlCheck == 1) {
		document.getElementById("libre").disabled = true;
	} else {
		document.getElementById("libre").disabled = false;
	}
}

function controlHoras() {
	var libre = document.getElementById("libre");
	var grupo = document.getElementById("carga_reserva").horas;
	var total = grupo.length;
	if (libre.checked) { 	
		if (total == null) {
			grupo.disabled = true;
		} else {
			for (i = 0; lcheck = grupo[i]; i++) {
				lcheck.disabled = true;
			}
		}
	 } else {
	 	if (total == null) {
			grupo.disabled = false;
		} else {
			for (i = 0; lcheck = grupo[i]; i++) {
				lcheck.disabled = false;
			}
		}
	 }
}

function validar(formulario) {
	var libre = document.getElementById("libre");
	var grupo = document.getElementById("carga_reserva").horas;
	if (libre != null) {
		if (libre.checked) { 	
			return true;
		} else {
			var controlCheck = 0;
			for (i = 0; lcheck = grupo[i]; i++) {
				if (lcheck.checked) {
					controlCheck++;
				}
			}
			if (controlCheck < 4) {
				alert("Debe seleccionar como mínimo 4 horas");
				return false;
			} else {
				return true;
			}
		}	
	} else {
		var controlCheck = 0;
		for (i = 0; lcheck = grupo[i]; i++) {
			if (lcheck.checked) {
				controlCheck++;
			}
		}
		if (controlCheck < 4) {
			alert("Debe seleccionar como mínimo 4 horas");
			return false;
		} else {
			return true;
		}
	}
}

function confirmarPartido(idPartido) {
	var direccion = "reserva_confirma_partido.php?idPartido="+idPartido;
	location.href=direccion;
}


</script>
</head>
   
<body align="center" bgcolor="#FFFFFF" border=0 style=" width:100%; height:100%" >
<form id="carga_reserva" name="carga_reserva" onsubmit="return validar(this)" action="reserva_guardar.php" method="post">
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
					<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;"><font color="#000000"><?= strtoupper ($equipo->nombre) ?></font> | <? echo $fecha_activa["nombre"] ?></div><br /><br />
					<? if ($fecha_activa != NULL && $idReserva == 0 && $partido == NULL) {	?>
						<input type="text" id="id_fecha" name="id_fecha" value="<?= $fecha_activa["id"] ?>" style="visibility:hidden"/>
						<div class="titulo_reserva" style="float:left;">Horarios Disponibles</div>
						<br /><br />
						<div style="text-align:left; width:500px">
							<?  
								foreach ($horas_fecha as $hora) {
									print("<input type='checkbox' id='horas' name='hora".$hora["id_horas_cancha"]."' value='".$hora["id_horas_cancha"]."' onclick='controlLibre()'> ".$hora["descripcion"]." | </input>");
								} 
							?>
						</div>
						<br />
							<? if (!$fechaLibre) { ?>
								<div class="titulo_reserva" style="float:left;">Fecha Libre <input type='checkbox' name='libre' id='libre' value='libre' onclick='controlHoras()'></input></div>
							<? } else { ?>
								<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">El equipo ya pidio fecha libre</div>
							<? } ?> 
						<br /><br />
						<div style="float:left;">
							<textarea name="observacion" id="observacion" placeholder="Observacion" cols="62" rows="4" style="float:left;"></textarea>
						</div>
						<br /><br /><br /><br />
						<div style="float:left;">
							<input type="submit" name="reservar" value="Reservar" />
						</div>
					<? } else { 
							if ($fecha_activa == NULL) {?>
								<div class="titulo_reserva" style="float:center;">No hay fecha activa para el torneo en el cual estan inscriptas</div>
						 <? } else { 
						 		if($partido == NULL) {  ?>	
									<div style="text-align:left; width:500px">
									<? if ($reserva->fecha_libre == 1) { ?>
											<div class="titulo_reserva color_titulo_reserva_<?= $color ?>" style="float:left;">El equipo pidio Fecha Libre</div><br />
									<? } else {?>
											<div class="titulo_reserva" style="float:left;">Horarios Pedidos</div><br /><br />
										<?	foreach ($detalleReserva as $horas) {
												print("<li>".$horas["descripcion"]."</li>");
											} 
										} ?>
										</div>
										<br />
										<div class="titulo_reserva" style="float:left;">
											Observación: <?= $reserva->observacion ?>
										</div>
							 <? } else { ?>
							 		<div class="titulo_reserva" style="float:left;">Confirmarción de Partido</div>
							 	<? for ($p=0; $p<count($partido); $p++) {?>	
									<div id="partido_<?= $color ?>" style="margin-left:-25px">
										<div id="fixture_nro_partido"><?="X" ?></div>
										<div id="fixture_sede"><? $oSedes = new Sedes(); $sede = $oSedes->getById($partido[$p]['idSede']); echo strtoupper($sede->nombre) ?></div>
										<div id="fixture_cancha"><?= strtoupper ($partido[$p]['cancha']); ?></div>
										<div id="fixture_equipo1"><?= strtoupper ($partido[$p]['equipo1']); ?></div>
										
										<? 	
											$confirmado = $oFixture->partidoConfirmado($partido[$p]['id'],$_SESSION['equipo']);
											if(!$confirmado) { ?>
											<div id="fixture_resultado1" style="margin-left:-55px"> <input type="button" name="confirmar" id="confirmar" value="Confirmar" onclick="confirmarPartido(<?= $partido[$p]['id'] ?>)" /></div>
										<? } else { ?>
											<div id="fixture_resultado1" style="margin-left:-55px; font-size:12px; color:#009900">Confirmado</div>
										<? } ?> 		
										<div id="fixture_horaPartido" style="margin-left:15px"><?= strtoupper ($partido[$p]['horaPartido']); ?></div>
										<div id="fixture_fechaPartido" class="fixture_color_<?= $color ?>"><?= cambiaf_a_normal($partido[$p]['fechaPartido']); ?></div>
										<div id="fixture_equipo2"><?= strtoupper ($partido[$p]['equipo2']); ?></div>
									</div>
									
							 	<?  }
							 	}
							 }  ?>				
					<? } ?> 
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