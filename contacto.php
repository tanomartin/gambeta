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
	<link rel="stylesheet" href="css/home.css" type="text/css" />
	<style type="text/css">
		<!--
		#cabezal1 {
			width:999px;
			height:275px;
			margin:0 auto 0 auto;
		}
	
		#imagen {
			background-image:url(img/contacto/contacto_1.jpg);
			background-repeat:no-repeat;
			width:767px;
			height:333px;
			margin:4px auto 0 auto;
		}
	
		#campo_nombre { 
			position: relative;
			left:  55px; 
			top: 39px;
			width: 150px; 
			height: 20px;
			text-align:left;
		}
	
		#campo_email { 
			position: relative;
			left:  55px; 
			top: 49px;
			width: 150px; 
			height: 20px;
			text-align:left;
		}
		
		#campo_telefono { 
			position: relative;
			left:  55px; 
			top: 59px;
			width: 150px; 
			height: 20px;
			text-align:left;
		}	
		
		#campo_mensaje { 
			position: relative;
			left:  430px; 
			top: -10px; 
			width: 325px; 
			height: 140px;
			text-align:left;
		}	
	
		#boton { 
			position: relative;
			left: 320px; 
			top: -30px; 
			width: 80px; 
			height: 40px;
			border:none;
			cursor:pointer;
		}
		
		#descripcion { 
			position: relative;
			left: 50px; 
			top:  35px;
			width: 500px; 	
			height: 90px;
			text-align:left;
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
			margin:0px 0px 0px 18px;
			text-align:left;		
		}

	</style>
	<script type="text/javascript" src="_js/funciones.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
	<script src='js/shadowbox-1b8e4a9.js' type='text/javascript'></script>
	<link href='css/shadowbox.css' rel='stylesheet' type='text/css'/> 
	<script>
		function validar(){
			
			if (trim(document.form_alta.nombre.value) =="" ||  ( document.form_alta.nombre.value == document.form_alta.nombre.defaultValue)){
				alert("Debe ingresar su Nombre");	
				document.form_alta.nombre.focus();
				return;
			}
	
			if (trim(document.form_alta.email.value) =="" ||  ( document.form_alta.email.value == document.form_alta.email.defaultValue)){
				alert("Debe ingresar su Email");	
				document.form_alta.email.focus();
				return;			
			}		
			if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(trim(document.form_alta.email.value)))){
					alert("La dirección de email es incorrecta");
					return;
			}
	
			if (trim(document.form_alta.telefono.value) =="" ||  ( document.form_alta.telefono.value == document.form_alta.telefono.defaultValue)){
				alert("Debe ingresar el Teléfono");	
				document.form_alta.telefono.focus();
				return;			
			}
	
			
			if (trim(document.form_alta.mensaje.value) =="" ||  ( document.form_alta.mensaje.value == document.form_alta.mensaje.defaultValue)){
				alert("Debe ingresar el Mensaje");	
				document.form_alta.mensaje.focus();
				return;			
			}
	
			document.form_alta.submit();
		}
	
		function pagina(id){
			document.getElementById('id').value= id;		
			document.form_alta.action = "noticias.php";
			document.form_alta.submit();
		}
		
		function clickFocus(input){
			if (input.value == input.defaultValue){
				input.value = '';
			}
		}
		
		function unFocus(input){
			if (input.value == ''){
				input.value = input.defaultValue;
			}
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
<form id="form_alta" name="form_alta" action="enviar_mail.php" method="post">
  <input name="id" id="id"  value="-1" type="hidden" />
  <input name="accion" id="accion"  value="registro" type="hidden" />
  <div id="wrap">
    <div id="encabezado"></div>
    <div id="cabezal1" style="margin-top:5px" align="center">
    <? for ($i=0; $i<count( $aTorneos ); $i++) {   
	   		$oObj = new TorneoCat();
			$categoria = $oObj ->getByTorneo($aTorneos[$i][id]);?>
          	<img src="logos/<?= $aTorneos[$i]['logoPrincipal'] ?>" title="<?= $aTorneos[$i]['nombre']?>"  border="0" width="50px" height="50px" onclick="pagina('<?= $categoria[0][id]?>')" style="cursor: pointer"/>
    <? } ?>
		  <div id="menu"></div>    
		  <div id="imagen" style="float:left; vertical-align:top" align="left">
			<div id="descripcion" class="descripcion">
				  <p><b>Realiz&aacute; ac&aacute; tu consulta</b></p>
				  Record&aacute; que si ya est&aacute;s inscripta en alguno de los Torneos, pod&eacute;s dejarnos tu consulta directamente en nuestro Facebook o Twitter </div>
				<div id="campo_nombre">
				  <input name="nombre" id="nombre" class="registro" maxlength="50" type="text" value="NOMBRE Y APELLIDO" size="45"  onfocus="clickFocus(this)" onblur="unFocus(this)" />
				</div>
				<div id="campo_email">
				  <input name="email" id="email" class="registro" maxlength="100" size="45" type="text" value="EMAIL"  onfocus="clickFocus(this)" onblur="unFocus(this)" />
				</div>
				<div id="campo_telefono">
				  <input name="telefono" id="telefono" class="registro" maxlength="50" size="45" type="text" value="TELEFONO"  onfocus="clickFocus(this)" onblur="unFocus(this)" />
				</div>
				<div id="campo_mensaje">
				  <textarea name="mensaje" id="mensaje" style="height:137px; width:322px; resize: none;" class="registro"  onfocus="clickFocus(this)" onblur="unFocus(this)" >Mensaje</textarea>
				</div>
				<div id="boton" onclick="validar()"></div>
			</div>
			<div id="auspiciantes" style="float:left">     
				<div id="titulo_auspiciante"><img src="img/home/titulo_auspiciante.jpg" /></div>
				<? include('auspiciantes.php'); ?>
			</div> 
		  </div>	
	</div>
    <div id="pie_repetir" style="float:left">
      <div id="pie"></div>
    </div>
</form>
</body>
</html>