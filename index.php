<?	include_once "include/config.inc.php";
	include_once "model/noticias.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	
	$oObj = new Noticias();
	$noti = $oObj->getByCant(5);


	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	
/*print_r($rosa); echo "avavav<br>";
print_r($grises);*/
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
	<style type="text/css">
	
		#cabezal1 {
			width:920px;
			height:275px;
			margin:0 auto 0 auto;
		}
	
		#imagen {
			background-repeat:no-repeat;
			width:767px;
			height:275px;
			margin:0 auto 0 auto;
		}
	
		#cabezal2 {
			width:999px;
			height:44px;
			margin:0 auto 0 auto;
		}
		
		#cabezal3 {
			width:999px;
			margin:0 auto 0 auto;
		}
	
		#titulo_cartelera {
			background-image:url(img/home/titulo_cartelera.jpg);
			background-repeat:no-repeat;
			width:581px;
			height:44px;
			margin:0 auto 0 auto;
		}
	
		#titulo_torneo {
			background-image:url(img/home/titulo_torneo.jpg);
			background-repeat:no-repeat;
			width:185px;
			height:44px;;
			margin:0 auto 0 auto;
		}
	
		#titulo_auspiciante {
			background-image:url(img/home/titulo_auspiciante.jpg);
			background-repeat:no-repeat;
			width:168px;
			height:44px;;
			margin:0px 0px 0px 28px;
			text-align:left;		
		}
	
		#noticias {
			width:531px;
			margin:0 auto 0 auto;
		}
	
		#torneos {
			width:205px;
			margin:0 auto 0 auto;
		}
	
		#categoria {
			background:url(img/home/torneo_pico.jpg) left no-repeat ;
			width:205px;
			margin:0 auto 0 20px;
		}
	
		#auspiciantes {
			width:210px;
			margin:0px 0px 0px 0px;
			text-align:left;		
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
		span.top span, span.bottom span{
		   width:4px; /* De acuerdo al tamaño de la imagen GIF */
		   height:4px;/* De acuerdo al tamaño de la imagen GIF */
		   float:right;
		   font-size:4px; /* Esto es para IE6, que no respeta el height del span si el tamaño de letra es mayor a este  */
		}

	</style> 
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
	<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'></script>
	<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/> 
	<script>
		//Efecto slide de fotos Jquery	
		$(document).ready(function() {
			$('#slideH').cycle({ 
				fx: 'scrollLeft', 
				timeout: 5000 
			});
		});
	
		function pagina(id){
			document.getElementById('id').value= id;		
			document.frm1.submit();
		}
	
		Shadowbox.init({ 
			overlayColor: "#000", 
			overlayOpacity: "0.6", 
		}); 
	</script>
</head>
   
<body bgcolor="#FFFFFF" style=" width:100%; height:100%" >
	<?php include_once "include/analyticstracking.php"; ?>
	<div id="wrap">
		<div id="encabezado">	  
		  <div id="cabezal">
				 <div id="gf" onClick="location.href='index.php'" style="cursor:pointer"></div>
				 <div id="facebook" style="cursor:pointer" onClick="window.open('https://www.facebook.com/gambeta.femenina');"></div>
		  		 <div id="twitter" style="cursor:pointer" onClick="window.open('https://twitter.com/GambetaFemenina');"></div>
				 <div id="instagram" style="cursor:pointer" onClick="window.open('https://instagram.com/gambetafemenina');"></div> 
				 <div id="youtube" style="cursor:pointer" onClick="window.open('https://www.youtube.com/user/gambetafemenina2012');"></div> 
              	 <div id="quienes_somos"  style="cursor:pointer" onClick="window.location = 'quienes_somos.php';"></div>
                 <div id="reglamento" style="cursor:pointer"  onclick="window.location = 'reglamento.php';"></div>
                 <div id="sedes" style="cursor:pointer" onClick="window.location = 'sedes.php';"></div>
                 <div id="contacto"  style="cursor:pointer" onClick="window.location = 'contacto.php';"></div>
            </div> 
		 </div>
        <div id="cabezal1">
			<div id="imagen" style="float:left; margin-bottom:15px">
				<img src="imgRotar/foto.jpg" alt="" title="" width="920" height="275" />	
			</div>
        </div> 
	    <div id="cabezal2">
             <div id="titulo_cartelera" style="float:left"></div>
             <div id="titulo_torneo" style="float:left"></div>
             <div id="titulo_auspiciante" style="float:left"></div>           
        </div> 
        <div id="cabezal3">
          <div id="noticias" style="float:left; margin-left:50px">
               <? for ($i=0; $i<1; $i++ ) { 
	                  $class = "gris2";
					  $class_titulo = "noticias_titulo";
					  $class_desarrollo = "noticias_desarrollo";				  
					  $class_fecha = "fecha_noticia";				  
					  $class_linea = "noticia_linea";
					  
					  if ($noti[$i][posicion] == 1) {
	                      $class = "rosa";
						  $class_titulo = "noticias_titulo1";					  
						  $class_desarrollo = "noticias_desarrollo1";
						  $class_fecha = "fecha_noticia1";		
						  $class_linea = "noticia_linea1";
					  } else {
	                    if ( ( $i % 2 ) == 0 )
	                      $class = "gris1";
                   } ?>
                <div class="<?= $class ?>">
                   <span class="top"><span></span></span>
                   <div class="<?= $class_titulo ?>"><?= $noti[$i]['titulo'] ?></div>
                   <div class="<?= $class_desarrollo ?>"><?= $noti[$i]['desarrollo'] ?></div>                    
                   <hr  class="<?= $class_linea ?>"/>
                   <div class="<?= $class_fecha ?>"><?= $noti[$i]['fecha'] ?></div>        
                   <span class="bottom"><span></span></span>
            	</div>
                  <br />
                <? } ?>
				<div align="center" >             
					<a style="width: 520px; height: 600" class="twitter-timeline"  href="https://twitter.com/GambetaFemenina"  data-widget-id="446705375895494656">Tweets por @GambetaFemenina</a>
		    		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
	      	</div> 
                
	    	 <div id="torneos" style="float:left">
	              <? for ($i=0; $i<count( $aTorneos ); $i++) { 
						$oObj = new TorneoCat();
						$categoria = $oObj ->getByTorneo($aTorneos[$i][id]);
				   ?>
	               <div id="categoria" style="clear:both; text-align: center;"><span class="tituloHome<?= $aTorneos[$i]['color'] ?>"><?= strtoupper ($aTorneos[$i]['nombre'] ) ?></span></div>
	               <div style="float: center; margin: 10px 10px 10px 80px"><img style="cursor: pointer" onClick="pagina('<?= $categoria[0][id]?>')" src="logos/<?= $aTorneos[$i]['logoPrincipal'] ?>"  width="85px" height="85px" /></div>  
					<? } ?>
	                
	        </div>
	        <div id="auspiciantes" style="float:left"><? include('auspiciantes.php'); ?></div>   
        </div>           
		<div id="pie_repetir" style="float:left">
			<div id="pie"></div>
        </div>    
    </div>
    <form name="frm1" id="frm1" method="post" action="noticias.php">
    	<input name="id"  id="id" type="hidden" />        
    </form>
</body>
</html>