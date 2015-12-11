<?	include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/torneos.php";
	
	
	$oObj = new Torneos();
	$aTorneos = $oObj->getByCant(CANT_TORNEOS); 
	
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
	<link rel="stylesheet" href="css/paginas.css" type="text/css"/>
    
 
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
			<div id="imagen" style="float:left; vertical-align:top">
	          	  <div style="float:left; margin-left:48px; height:750px">
					  <img src="img/sedes/sedes.jpg" />
					  <div style="position:relative; top:-195px; left:115px; border: 3px solid #DD2C8D; border-radius:4px; width:530px">
							<iframe width="530" height="180" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=es&amp;q=Acceso+A+Rafael+Obligado,+Recoleta,+Buenos+Aires,+Ciudad+Aut%C3%B3noma+de+Buenos+Aires,+Argentina&amp;aq=&amp;sll=-34.572592,-58.314056&amp;sspn=0.114067,0.264187&amp;ie=UTF8&amp;geocode=FVCA8P0dNueE_A&amp;split=0&amp;hq=&amp;hnear=Acceso+A+Rafael+Obligado,+Recoleta,+Buenos+Aires,+Argentina&amp;t=m&amp;ll=-34.568634,-58.394995&amp;spn=0.012722,0.04549&amp;z=14&amp;iwloc=&amp;output=embed"></iframe>
					</div>
		        </div> 
	          	  <div style="float:left; top:-100px; margin-left:48px">
					  <img src="img/sedes/sedes3.jpg" />
					  <div style="position:relative; top:-195px; left:115px; border: 3px solid #DD2C8D; border-radius:4px; width:530px">
							<iframe width="530" height="180" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5536.485459706896!2d-58.68211444615104!3d-34.40099133651545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bca1129356b343%3A0x3177b9c3445095f2!2sAv.+Benavidez+2400%2C+B1621HZV+Benavidez%2C+Buenos+Aires!5e0!3m2!1ses-419!2sar!4v1449769476829"></iframe>
					  </div>
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