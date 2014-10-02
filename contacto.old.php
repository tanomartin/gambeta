<?	include_once "include/config.inc.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="border-width:0;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>:: Gambeta Femenina ::</title>
	<link rel="stylesheet" href="css/home.css" type="text/css">
    
    <META NAME="EA" CONTENT="NOINDEX,NOFOLLOW">
  
  <style type="text/css">
	<!--

	#formulario1 {
		background-image:url(img/costados.jpg);
		background-repeat:no-repeat;
		width:240px;
		height:988px;
		
	}
	#formulario {
		background-image:url(img/contacto.jpg);
		background-repeat:no-repeat;
		width:999px;
		height:988px;
		margin:0 auto 0 auto;
	}
	#formulario2 {
		background-image:url(img/costados.jpg);
		background-repeat:no-repeat;
		width:240px;
		height:988px;
		
	}
	
	#wrap { margin:0 auto 0 auto; width:100%; height:988px;
			background-image:url(img/costados1.jpg);
			background-repeat:repeat-x;
	 }

	#campo_tiempo { 
		position: relative;
		left: 805px; 
		top: 270px; /*442*/ 
		width: 90px; 
		height: 90px;
		text-align:left;
	}	
	#quienes_somos { 
		position: relative;
		left: 810px; 
		top: -60px; /*442*/ 
		width: 190px; 
		height: 10px;
		text-align:left;
	}	

	#reglamento { 
		position: relative;
		left: 825px; 
		top: -30px; /*442*/ 
		width: 190px; 
		height: 10px;
		text-align:left;
	}	
	#sedes { 
		position: relative;
		left: 850px; 
		top: 0px; /*442*/ 
		width: 190px; 
		height: 10px;
		text-align:left;
	}	
	#contacto { 
		position: relative;
		left: 835px; 
		top: 25px; /*442*/ 
		width: 190px; 
		height: 10px;
		text-align:left;
	}	

	#facebook { 
		position: relative;
		left: 805px; 
		top: 285px; /*442*/ 
		width: 190px; 
		height: 90px;
		text-align:left;
	}

	#twitter { 
		position: relative;
		left: 880px; 
		top: 195px; /*442*/ 
		width: 190px; 
		height: 90px;
		text-align:left;
	}

	#fecha { 
		position: relative;
		left: 790px; 
		top: -80px; /*442*/ 
		width: 190px; 
		height: 10px;
		text-align:left;
	}
	#descripcion { 
		position: relative;
		left: 50px; 
		top:  -35px; /*442*/ 
		width: 500px; 
		_width: 430px; 		
		height: 90px;
		text-align:left;
	}

	#campo_nombre { 
		position: relative;
		left:  55px; 
		top: -40px; /*442*/ 
		width: 150px; 
		height: 20px;
		text-align:left;
	}

	#campo_email { 
		position: relative;
		left:  55px; 
		top: -30px; /*442*/ 
		width: 150px; 
		height: 20px;
		text-align:left;
	}
	#campo_telefono { 
		position: relative;
		left:  55px; 
		top: -20px; /*442*/ 
		width: 150px; 
		height: 20px;
		text-align:left;
	}	
	#campo_mensaje { 
		position: relative;
		left:  430px; 
		top: -90px; /*442*/ 
		width: 325px; 
		height: 140px;
		text-align:left;
		/*background-color:#F00;*/
	}	

#boton { 
	position: relative;
	left: 320px; 
	top: -110px; /*442*/ 
	width: 80px; 
	height: 40px;
	border:none;
	cursor:pointer;
/*	background-color:#F00;*/
	
}

	#gf{ 
		position: relative;
		left: 350px; 
		top: -620px; /*442*/ 
		width: 300px; 
		height: 200px;
		text-align:left;
	/*	background-color:#F00*/
	}

-->
</style> 
<script type="text/javascript" src="_js/funciones.js"></script>
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
	
	
</script>

   </head>
   
<body   align="center" bgcolor="#FFFFFF" border=0 style=" width:100%" >
	<div id="wrap">
    	<div id="formulario">
		<form id="form_alta" name="form_alta" action="enviar_mail.php" method="post">
			<input name="id" id="id"  value="-1" type="hidden" />
             <input name="accion" id="accion"  value="registro" type="hidden" />
                        <div id="campo_tiempo"><a href="http://www.findlocalweather.com/forecast.php?config=&forecast=zandh&pands=SABE" target="_blank"><img src="http://www.findlocalweather.net/forecast.php?forecast=hourly&pands=SABE&place=Aeroparque Bs. As.&state=Ar&config=png&alt=hwixzonemet&hwvbg=green&hwvtc=white" border="0" alt="Click for the latest Aeroparque Bs. As."></a>
                       </div> 
                        <div id="quienes_somos">
                        	<a href="quienes_somos.html" class="encabezado">QUIENES SOMOS</a>
                        </div>						
                        <div id="reglamento">
                        	<a href="reglamento.html" class="encabezado">REGLAMENTO</a>
                        </div>						
                        <div id="sedes">
                        	<a href="sedes.html" class="encabezado">SEDES</a>
                        </div>						
                        <div id="contacto">
                        	<a href="contacto.php" class="encabezado">CONTACTO</a>
                        </div>
                        <div id="facebook">
						<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fes-la.facebook.com%2Fpeople%2FGambeta-Femenina%2F100000148462698&amp;layout=box_count&amp;show_faces=false&amp;width=190&amp;action=like&amp;font&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:190px; height:65px;" allowTransparency="true"></iframe>
                        </div>
	    	           <div id="twitter">                        
	                        <a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    					</div>
	    	           <div id="fecha" class="fecha">     
                           <?php
						   	setlocale(LC_ALL,"es_ES@euro","es_ES","esp");   echo utf8_encode(strftime("%A %d/%m/%Y"));
    						?>				
					   </div>
	    	           <div id="descripcion" class="descripcion">     
                       <p><b>Realiz&aacute; ac&aacute; tu consulta</b></p>
                       Record&aacute; que si ya est&aacute;s inscripta en alguno de los Torneos, pod&eacute;s dejarnos tu consulta directamente en nuestro Facebook o Twitter
					   </div>
						<div id="campo_nombre">
	                       	 <input name="nombre" id="nombre" class="registro" maxlength="50" type="text" value="NOMBRE Y APELLIDO" size="50"  onfocus="clickFocus(this)" onblur="unFocus(this)" >
                        </div>
                        <div id="campo_email">
	                      <input name="email" id="email" class="registro" maxlength="100" size="50" type="text" value="EMAIL"  onfocus="clickFocus(this)" onblur="unFocus(this)" >
    	                </div>
                        <div id="campo_telefono">
	                      <input name="telefono" id="telefono" class="registro" maxlength="50" size="50" type="text" value="TELEFONO"  onfocus="clickFocus(this)" onblur="unFocus(this)" >
    	                </div>
                        <div id="campo_mensaje">
                        	<textarea name="mensaje" id="mensaje" style="height:137px; width:322px" class="registro"  onfocus="clickFocus(this)" onblur="unFocus(this)" >Mensaje</textarea>
    	                </div>
                 		<div id="boton" onclick="validar()"></div>    
                 	    <div id="gf" onclick="location.href='index.php'" style="cursor:pointer"></div>

            </form>
		</div>
 
    </div>
</body>

<script language="JavaScript"> 

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
 
</script>