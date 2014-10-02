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
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>:: Gambeta Femenina ::</title>

    <meta name="author" content="gambetafemenina.com">
    <meta name="description" content="Somos una Organización dedicada exclusivamente a la difusión del Fútbol Femenino. Promovemos Torneos de fútbol femenino, entrenamientos para todas las edas, escuelitas, clínicas, etc. Gracias a este ideal, muchas chicas y mujeres participan activamente de este deporte, mejorando su calidad de vida, su salud y condición física">
    <meta name="keywords" content="fútbol femenino - torneo fútbol femenino - torneo fútbol 5 - futbol para mujeres - entrenamientos fútbol femenino - torneo de chicas - futbol para chicas - competencia para mujeres">

	<link rel="stylesheet" href="css/home.css" type="text/css">
    
  
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
		height:275px;
		margin:0 auto 0 auto;
	}

	#imagen {
		background-image:url(img/contacto/contacto_1.jpg);
		background-repeat:no-repeat;
		width:767px;
		height:333px;
		margin:0 auto 0 auto;
	}

	#campo_nombre { 
		position: relative;
		left:  55px; 
		top: 39px; /*442*/ 
		width: 150px; 
		height: 20px;
		text-align:left;
	}

	#campo_email { 
		position: relative;
		left:  55px; 
		top: 49px; /*442*/ 
		width: 150px; 
		height: 20px;
		text-align:left;
	}
	#campo_telefono { 
		position: relative;
		left:  55px; 
		top: 59px; /*442*/ 
		width: 150px; 
		height: 20px;
		text-align:left;
	}	
	#campo_mensaje { 
		position: relative;
		left:  430px; 
		top: -10px; /*442*/ 
		width: 325px; 
		height: 140px;
		text-align:left;
		/*background-color:#F00;*/
	}	

	#boton { 
		position: relative;
		left: 320px; 
		top: -30px; /*442*/ 
		width: 80px; 
		height: 40px;
		border:none;
		cursor:pointer;
		/*background-color:#F00;*/
		
	}

	#faceytweet {
		background-image:url(img/home/faceytweet.jpg);
		background-repeat:no-repeat;
		width:232px;
		height:275px;
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

	#cabezal2 {
		width:900px;
		height:44px;
		margin:0 auto 0 auto;
	}
	
	#titulo_auspiciante {
		position: relative;
		background-image:url(img/home/titulo_auspiciante.jpg);
		background-repeat:no-repeat;
		top:-40px;
		left:717px;
		width:233px;
		height:44px;
		margin:0 auto 0 auto;
		text-align:left;		
	}
	
	#cabezal3 {
		width:999px;
		margin:0 auto 0 auto;
	}

	#descripcion { 
		position: relative;
		left: 50px; 
		top:  35px; /*442*/ 
		width: 500px; 
		_width: 430px; 		
		height: 90px;
		text-align:left;
	}
	

	#auspiciantes {
		width:210px;
		margin:0 auto 0 auto;
		border-left: 2px solid #CCC;
		text-align:left;		
	}

	#auspiciantes1 {
		width:210px;
		margin:5px auto 0 20px;
		border-left: 2px solid #CCC;
	}

	#gf{ 
		position: relative;
		left: 370px; 
		top: -530px; /*442*/ 
		width: 300px; 
		height: 200px;
		text-align:left;
		/*background-color:#F00*/
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
<script>
	function pagina(id){
		document.getElementById('id').value= id;		
		document.form_alta.action = "noticias.php";
		document.form_alta.submit();
	}
</script>
</head>
 </head>
   
<body   align="center" bgcolor="#FFFFFF" border=0 style=" width:100%; height:100%" >
<form id="form_alta" name="form_alta" action="enviar_mail.php" method="post">
	<input name="id" id="id"  value="-1" type="hidden" />
        <input name="accion" id="accion"  value="registro" type="hidden" />
	<div id="wrap">
		<div id="encabezado">
			<div id="cabezal">
		     <div id="quienes_somos"  style="cursor:pointer" onclick="window.location = 'quienes_somos.php';"></div>
              <div id="reglamento" style="cursor:pointer"  onclick="window.location = 'reglamento.php';"></div>
             <div id="sedes" style="cursor:pointer" onclick="window.location = 'sedes.php';"></div>
             <div id="contacto"  style="cursor:pointer" onclick="window.location = 'contacto.php';"></div>
            	<div id="menu">
				  <? for ($i=0; $i<count( $aTorneos ); $i++) {   
	  					$oObj = new TorneoCat();
						$categoria = $oObj ->getByTorneo($aTorneos[$i][id]);

				  ?>
                       <img src="logos/<?= $aTorneos[$i]['logoMenu'] ?>"  border="0" width="43px" height="54px" onclick="pagina('<?= $categoria[0][id]?>')" style="cursor: pointer"/>
                <? } ?>	
            </div>
            </div>
		 </div>
        <div id="cabezal1">
			<div id="imagen" style="float:left">
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
            </div>
			<div id="faceytweet" style="float:left">
      		       <div id="campo_tiempo"><!-- www.TuTiempo.net - Ancho:120px - Alto:73px -->
<!-- www.TuTiempo.net - Ancho:118px - Alto:71px -->
<div id="TT_tBawbxtBddjcAQIA7fVzzDzzj6lAMdjlrtkd1sCoK1j"><h2><a href="http://www.tutiempo.net">Tutiempo.net</a></h2></div>
<script type="text/javascript" src="http://www.tutiempo.net/widget/eltiempo_tBawbxtBddjcAQIA7fVzzDzzj6lAMdjlrtkd1sCoK1j"></script>
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
	     	</div>
         </div>  
	    <div id="cabezal2">
             <div id="titulo_auspiciante" style="float:left"></div>           
        </div> 
        <div id="cabezal3">
          <div id="auspiciantes" style="float: right">
          <? include('auspiciantes.php'); ?>
          </div>     
          <div id="gf" onclick="location.href='index.php'" style="cursor:pointer"></div>
        </div>           
		<div id="pie_repetir" style="float:left">
			<div id="pie"></div>
        </div>    
        
    </div>
    </form>
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