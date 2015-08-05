<?	include_once "include/fechas.php";
	include_once "../model/torneos.php";
	include_once "../model/torneos.categorias.php";	
	include_once "../model/equipos.php";	
    include_once "../model/fckeditor.class.php" ;
	
	
	if(!session_is_registered("usuario")){
		header("Location: index.php");
		exit;
	}

	$operacion = "Alta";

	if ($_POST["id"] != -1) {
	
		$operacion = "Modificaci&oacute;n";

		$oEquipo= new Equipos();
		$datos = $oEquipo->get($_POST["id"]);

//		$datos = decodeUTF8($datos);	
	}
    $oFCKeditor = new FCKeditor( "texto" ) ;

    $oFCKeditor -> BasePath = '../_js/FCKeditor/' ;

	$oFCKeditor -> Height = 250 ;

	$oFCKeditor -> Width = 450 ;

	$oFCKeditor -> ToolbarSet = "custom2" ;

    $oFCKeditor -> InstanceName = "descripcion" ;

    $oFCKeditor -> Value = $datos[0]['descripcion'] ;
	
	$disabled = "";
	
	if( $_POST['accion'] == 'ver')
		$disabled = "disabled";

	$oTorneo= new Torneos();
	$aTorneos = $oTorneo->get();

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>

<!-- base href="http://www.typolight.org/" -->
<title>Panel de Control</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="description" content="Panel de Control."/>
<meta name="keywords" content=""/>
<meta name="robots" content="index,follow"/>

<? include("encabezado.php"); ?>


<script>

	function volver(){
	
		document.form_alta.accion.value = "volver";		
		document.form_alta.submit();
	}

</script>

</head>

<body id="top" class="home">

<div id="wrapper">

<!-- Header -->

<div id="header">
	<div class="inside">

<? include("top_menu.php"); ?>

<!-- indexer::stop -->
<!--
<div id="search">
<form action="search.html" method="get">
<div class="formbody">
  <label for="keywords" class="invisible">Search</label>
  <input name="keywords" id="keywords" class="text" type="text"><input src="index_archivos/search.png" alt="Search" value="Search" class="submit" type="image">
</div>
</form>
</div>
-->
<!-- indexer::continue -->

<!-- indexer::stop -->
<div id="logo">
	<h1><a href="index.php" title="Volver al incio"> Panel de Control</a></h1>
</div>
<!-- indexer::continue -->

<? include("menu.php");?>

 
	</div>

</div>

<!-- Header -->


<div id="container">

    <div id="main">
        
        <div class="inside">
    
            <? include("path.php"); ?>




<div class="mod_article block" id="register">

<div class="ce_text block">
	<h1><?=$operacion?>
	   del Equipo</h1>
</div>

<!-- indexer::stop -->
<div class="mod_registration g8 tableform block">

<form name="form_alta" id="form_alta" action="<?=$_SERVER['PHP_SELF']?>" method="post"  enctype="multipart/form-data"> 


<input name="id" id="id"  value="<?=$_POST["id"]?>" type="hidden" />
<input name="_pag" id="_pag"  value="<?=$_POST["_pag"]?>" type="hidden" />
<input type="hidden" name="accion" value="guardar" />

<!-- Filtros -->
<input type="hidden" name="fnombre" value="<?=$_POST["fnombre"]?>" />
<!-- Fin filtros -->


<!-- Parametros menu -->
<input type="hidden" name="menu" value="<?=$_POST["menu"]?>" />
<input type="hidden" name="submenu" value="<?=$_POST["submenu"]?>" />
<input type="hidden" name="pag_submenu" value="<?=$_POST["pag_submenu"]?>" />
<!--     -->

<div class="formbody">

	<div class="ce_table">
	
	<fieldset>
	<legend>Datos del Equipo

	</legend><table summary="Personal data">
  	<tbody>
      <tr class="odd">
        <td class="col_0 col_first"><label for="nombre">Nombre</label><span class="mandatory">*</span></td>
        <td class="col_1 col_last"><input name="nombre" id="nombre" class="required text" maxlength="50" type="text" value="<?=$datos[0]["nombre"]?>" size="50"  <?= $disabled ?>></td>
      </tr>  
      <tr class="even">
        <td class="col_0 col_first"><label for="email">Email</label></td>
        <td class="col_1 col_last"><input name="email" id="email" class="text" maxlength="200" type="text" value="<?=$datos[0]["email"]?>" size="70"  <?= $disabled ?>></td>
      </tr>      
      <tr class="odd">
        <td class="col_0 col_first"><label for="nombre">Torneo</label><span class="mandatory">*</span></td>
        <td class="col_1 col_last">
         <select name="idTorneo" id='idTorneo' <?= $disabled ?> class="validate-selection" onChange="clearCategoria('idTorneoCat');
         	return listOnChange('idTorneo', '','categoriaList','categoria_data.php','advice1','idTorneoCat','idTorneoCat');" >
            <option value="-1">Seleccione un Torneo...</option>
		 	<?php for($i=0;$i<count($aTorneos);$i++) { ?>	
				<option value="<?php echo $aTorneos[$i]['id'] ?>" <?php if ($datos[0]["id_torneo"] ==   $aTorneos[$i]['id'] ) echo "selected"; ?>><?php echo $aTorneos[$i]['nombre'] ?>
                </option>
             <?php } ?>	   
         	</select>
         </td>   
      </tr>  

      <tr class="even">
        <td class="col_0 col_first"><label for="nombre">Categoría</label><span class="mandatory">*</span></td>
        <td class="col_1 col_last"> 
		<span id="categoriaList">
				<select name="idTorneoCat" id="idTorneoCat" <?= $disabled ?> class="validate-selection" >
					<option value="-1">Seleccione antes un Torneo...</option>
						<?
						 if($datos[0]["id_torneo"]) {
							$oTorneoCat = new TorneoCat();
							$aTorneoCat = $oTorneoCat->getByTorneoSub($datos[0]["id_torneo"]);

							for ($i=0;$i<count($aTorneoCat);$i++) 
							{
						?>	
							 <option <? if($aTorneoCat[$i]["id"] == $datos[0]["idTorneoCat"]) echo "selected"; ?> value="<?=$aTorneoCat[$i]["id"]?>"><?=$aTorneoCat[$i]["nombreLargo"]?> <? if ( $aTorneoCat[$i]["nombreCat"] != "" ){ echo "- ". $aTorneoCat[$i]["nombreCat"]; } ?></option>
							
						<?							
							}
						 }
						?>
						</select> 
            <span id="advice1"> </span>
			</span>	
        </td>    
      </tr>  
      <tr class="odd">
        <td class="col_0 col_first"><label for="nombre">Descuentos Puntos</label></td>
        <td class="col_1 col_last"> 
	       <input name="descuento_puntos" type="text" id="descuento_puntos" value="<?php echo $datos[0]["descuento_puntos"]; ?>" class="validate-digits" size="3"  <?= $disabled ?>/>
         </td>
       </tr>    
      <tr class="even">
        <td class="col_0 col_first"><label for="nombre">Foto Preview</label><span class="mandatory">*</span></td>
        <td class="col_1 col_last"><input name="fotoPreview" id="fotoPreview" class="" type="file"  <?= $disabled ?> /><? if ($datos[0]["fotoPreview"] != "" ) { ?><a href="../fotos_equipos/<?= $datos[0]["fotoPreview"] ?>" target="_blank"> Imagen</a> <? } ?></td>
      </tr>  
      <tr class="odd">
        <td class="col_0 col_first"><label for="nombre">Foto Grande</label><span class="mandatory">*</span></td>
        <td class="col_1 col_last"><input name="fotoGrande" id="fotoGrande" class="" maxlength="50" type="file"  <?= $disabled ?>/><? if ($datos[0]["fotoGrande"] != "" ) { ?><a href="../fotos_equipos/<?= $datos[0]["fotoGrande"] ?>" target="_blank"> Imagen</a> <? } ?> </td>
      </tr>  
      <tr class="even">
        <td class="col_0 col_first"><label for="nombre">Descripción</label><span class="mandatory">*</span></td>
        <td class="col_1 col_last"><?= $oFCKeditor -> Create( ) ; ?></td>      </tr>   
	</tbody>
	</table>
	</fieldset>

    <div class="submit_container">
   <? if ( $disabled  == "" ) { ?>
   	 <input class="submit" onclick="valirdarForm_submit('form_alta')" type="button" value="Guardar" /> 
    <? } ?>
<!--    <input class="submit" type="button" value="Limpiar" onclick="javascript:limpiar('form_alta');" />-->
    <input class="submit" type="button" value="Volver" onclick="javascript:volver();" />
    
    
    
    </div>
    </div>
</div>
</form>

</div>
<!-- indexer::continue -->


<div class="ce_text g4 xpln block">

	<p><strong>Datos del Equipo</strong><br/>Ingrese los datos del Equipo.</p>
	<p>Los campos marcados con <span class="mandatory">*</span> son de ingreso obligatorio.</p>

</div>

<div class="clear"></div>

</div>

</div>

	<div id="clear"></div>

</div>

</div>

<? include("pie.php")?>

</div>
</body>

</html>