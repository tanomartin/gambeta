<?	include_once "include/config.inc.php";
	include_once "model/equipos.php";
	include_once "model/torneos.php";
	include_once "model/jugadoras.php";

	$color = $_REQUEST["color"];

	$oJugadoras = new Jugadoras();

	$aJugadoras1 =  $oJugadoras->getByFixture($_REQUEST["id"], $_REQUEST["idEquipo1"] );

//	print_r($aJugadoras1);

	$aJugadoras2 =   $oJugadoras->getByFixture($_REQUEST["id"], $_REQUEST["idEquipo2"] );
//print_r($aJugadoras1 );
	$oEquipos = new Equipos();
	$aEquipo1  = $oEquipos ->getById($_REQUEST["idEquipo1"]);
	$aEquipo2  = $oEquipos ->getById($_REQUEST["idEquipo2"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>:: Gambeta Femenina ::</title>
    <meta name="author" content="gambetafemenina.com">
    <meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física">
    <meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres">

	<link rel="stylesheet" href="css/fixture_cabezal.css" type="text/css">
	<link rel="stylesheet" href="css/home.css" type="text/css">
	<link rel="stylesheet" href="css/menu_izq.css" type="text/css">
	<link rel="stylesheet" href="css/paginas.css" type="text/css">
<style type="text/css">
	<!--


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
		width: 550px;
		background-image: url("img/fixture_detalle/centro.jpg");
		background-repeat: repeat-y;
	}

	.cajaarriba {
		background-image: url("img/fixture_detalle/arriba.jpg");
		background-position: top center;
		background-repeat: no-repeat;
	}

	.cajaabajo {
		background-image: url("img/fixture_detalle/abajo1.jpg");
		background-position: bottom left;
		background-repeat: no-repeat;
		padding-top:10px;
		padding-bottom:5px;
		margin-left:-1px

	}

-->
</style>
<script type="text/javascript" src="_js/funciones.js"></script>

<div id="noticias" style="float:left; margin-left:30px">
    <div class="caja">
	    <div class="cajaarriba">
             <div class="cajaabajo">
               <div class="detalle_fixture">
					<div id="nombre_posicion" class="nombre_equipo  color_<?= $color ?>"><?= $aEquipo1->nombre ?></div>
                    <div id="nombre_posicion1" class="nombre_equipo  color_<?= $color ?>"><?= $aEquipo2->nombre ?></div>

    	        </div>
               <div class="detalle_desarrollo" style="clear:both; height: auto;">
                      <div id="left" style=" width:265px; border-right: 2px solid #CCCCCC; position:absolute; left:45px; top: 75px">
                                      	   <? for ($i=0; $i< count($aJugadoras1 ); $i++) {

										 $goles = ($aJugadoras1[$i]['goles']>0)?$aJugadoras1[$i]['goles']:"";
										   $tarjeta_amarilla = ($aJugadoras1[$i]['tarjeta_amarilla']>0)?$aJugadoras1[$i]['tarjeta_amarilla']:"";
										   $tarjeta_roja = ($aJugadoras1[$i]['tarjeta_roja']>0)?$aJugadoras1[$i]['tarjeta_roja']:"";
										   ?>
                                           <div id="fila" style="width:247px; height:30px; padding-top:10px; float:left;">
									   			<div class="jugadoras1" style="height:30px;">
													<?= $aJugadoras1[$i]['nombre'] ?></div>
                                                <div class="goles color_<?= $color ?>" style="height:30px; left:10px" ><?= $goles?></div>
                                                <div class="tarjetas" style=" height:30px; left:40px"><?= $tarjeta_amarilla?></div>
                                                <div class="tarjetas" style=" height:30px; left:65px"><?= $tarjeta_roja?></div>
                                                <div class="tarjetas" style=" height:30px; left:70px">
												<? if($aJugadoras1[$i]['mejor_jugadora'] == 'S') { ?><img src="img/fixture_detalle/star.png" border="0" /><? } ?>
                                               </div>
                                           </div>
                                           <div class="detalle_desarrollo_linea1"  style="clear:both"></div>
		                                 <? } ?>
                                         </div>
                    					 <div id="left1" style="width:265px;   border-left: 2px solid #CCCCCC; position: absolute; left:310px; top:75px">
                                      	   <? 
										   for ($i=0; $i< count($aJugadoras2 ); $i++) {
										 	$goles = ($aJugadoras2[$i]['goles']>0)?$aJugadoras2[$i]['goles']:"";
										
										   $tarjeta_amarilla = ($aJugadoras2[$i]['tarjeta_amarilla']>0)?$aJugadoras2[$i]['tarjeta_amarilla']:"";
										   $tarjeta_roja = ($aJugadoras2[$i]['tarjeta_roja']>0)?$aJugadoras2[$i]['tarjeta_roja']:"";
										   ?>
                                           <div id="fila" style="width:250px; height:30px; padding-left:10px;  padding-top:10px; float:left;">
									   			<div class="jugadoras1" style="height:30px;"><?= $aJugadoras2[$i]['nombre'] ?></div>
                                                <div class="goles_1 color_<?= $color ?>" style="height:30px; left:5px"><?= $goles?></div>
                                                <div class="tarjetas" style=" height:30px; left:30px"><?= $tarjeta_amarilla?></div>
                                                <div class="tarjetas" style=" height:30px; left:55px"><?= $tarjeta_roja?></div>
                                                <div class="tarjetas" style=" height:30px; left:60px">
												<? if($aJugadoras2[$i]['mejor_jugadora'] == 'S') { ?><img src="img/fixture_detalle/star.png" border="0" /><? } ?>
                                               </div>
                                           </div>
                                           <div class="detalle_desarrollo_linea"  style="clear:both"></div>
		                                 <? } ?>
                       </div>
      			</div>
       		</div>
       	</div>
	 </div>
</div>