<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	include_once "model/reglamento.php";
	
	
	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 

	$oObj = new Reglamento();
	$oReg = $oObj->getById(1); 

/*print_r($rosa); echo "avavav<br>";
print_r($grises);*/
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
	<link rel="stylesheet" href="css/reglamento.css" type="text/css"/>
    
	<style type="text/css">
	
		#cabezal1 {
			width:999px;
			margin:0 auto 0 auto;
		}
	
		#imagen {
			float:left;		
			width:570px;
			margin-top:5px;
			margin-left:-25px;
		}
	
		#titulo_auspiciante {
			background-image:url(img/home/titulo_auspiciante.jpg);
			background-repeat:no-repeat;
			width:185px;
			height:44px;;
			margin:7px 0px 0px -9px;
			text-align:left;		
		}
		
		#auspiciantes {
			width:210px;
			margin:0px 0px 0px 240px;
			text-align:left;		
		}

	</style> 
	<script type="text/javascript" src="_js/funciones.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
	<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'></script>
	<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/> 
	<script>
		function pagina(id){
			document.getElementById('id').value= id;		
			document.form_alta.action = "noticias.php";
			document.form_alta.submit();
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
<form id="form_alta" name="form_alta" action="" method="post">
	<input name="id" id="id"  value="<?= $_POST['id'] ?>" type="hidden" />
    <input name="color" id="color"  value="<?= $color ?>" type="hidden" />
	<div id="wrap">
		<div id="encabezado"></div>
		<? include_once("include/torneos.php") ?>
	  	<div id="cabezal1" style="margin-top:5px" align="center">
        	<div id="menu"></div>
			<div id="imagen" style="float:left; vertical-align:top">
				<div style="float:left; margin-left:100px">
					<img src="img/reglamento/titulo.jpg" /><?= html_entity_decode($oReg ->descripcion) ?>
				</div>
			</div>    
			<div id="auspiciantes" style="float:left">     
				<div id="titulo_auspiciante"><img src="img/home/titulo_auspiciante.jpg" /></div>
				<? include('auspiciantes.php'); ?>
			</div> 
		</div>     
		<div id="pie_repetir" style="float:left">
			<div id="pie"></div>
        </div>    
    </div>
</form>
</body>
</html>