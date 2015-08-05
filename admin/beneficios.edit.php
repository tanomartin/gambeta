<?
include_once "../model/fckeditor.class.php";
include_once "../model/beneficios.php";
//instancio editor
if ($_POST ["id"] != - 1) {
	$operacion = "Modificaci&oacute;n";
	$oBeneficio = new Beneficios ();
	$datos = $oBeneficio->get ( $_POST ["id"] );
}
$oFCKeditor = new FCKeditor ( "texto" );
$oFCKeditor->BasePath = '../_js/FCKeditor/';
$oFCKeditor->Height = 250;
$oFCKeditor->Width = 450;
$oFCKeditor->ToolbarSet = "custom2";
$oFCKeditor->InstanceName = "descripcion";
$oFCKeditor->Value = $datos [0] ['descripcion'];
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<!-- base href="http://www.typolight.org/" -->
<title>Panel de Control</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Panel de Control." />
<meta name="keywords" content="" />
<meta name="robots" content="index,follow" />
<? include("encabezado.php"); ?>

<title>Panel de Control</title>
<script>
	function volver(){
	
		document.form_alta.accion.value = "novedades";		
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
				<div id="logo">
					<h1><a href="index.php" title="Volver al incio">Panel de Control</a></h1>
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
							<h1><?=$operacion?> de Beneficio </h1>
						</div>
						<!-- indexer::stop -->
						<div class="mod_registration g8 tableform block">
							<form name="form_alta" id="form_alta" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
								<input name="id" id="id" value="<?=$_POST["id"]?>" type="hidden" />
								<input name="_pag" id="_pag" value="<?=$_POST["_pag"]?>" type="hidden" />
								<input name="accion" value="guardar" type="hidden" />
								<input name="idtemporal" id="idtemporal" value="<?=$id_novedad?>" type="hidden" />
								<!-- Parametros menu -->
								<input type="hidden" name="menu" value="<?=$_POST["menu"]?>" />
								<input type="hidden" name="submenu" value="<?=$_POST["submenu"]?>" />
								<input type="hidden" name="pag_submenu" value="<?=$_POST["pag_submenu"]?>" />
								<div class="ce_table">
									<fieldset>
										<table style="width: 100%;" summary="Personal data">
											<tbody>
												<tr class="even">
													<td class="col_0 col_first"><label for="nombre">T&iacute;tulo</label><span class="mandatory">*</span></td>
													<td class="col_1 col_last"><input type="text" name="titulo" value="<?= $datos[0]['titulo'] ?>" size="50" /></td>
												</tr>
												<tr class="odd">
													<td class="col_0 col_first"><label for="descripcion">Descripción</label><span class="mandatory">*</span></td>
													<td class="col_1 col_last"><?= $oFCKeditor -> Create( ) ; ?></td>
												</tr>
												<tr class="even">
													<td class="col_0 col_first"><label for="nombre">Logo</label><span class="mandatory">*</span></td>
													<td class="col_1 col_last">
														<input name="fotoLogo" id="fotoLogo" class="" type="file" />
														<? if ($datos[0]["fotoLogo"] != "" ) { ?>
															<a href="../fotos_beneficios/<?= $datos[0]["fotoLogo"] ?>" target="_blank">Imagen</a> 
													<? } ?>
													</td>
												</tr>
											</tbody>
										</table>
									</fieldset>
									<div class="submit_container">
										<input class="submit"
											onclick="valirdarForm_submit('form_alta')" type="button"
											value="Guardar" /> <input class="submit" type="button"
											value="Limpiar" onclick="javascript:limpiar('form_alta');" />
										<input class="submit" type="button" value="Volver" onclick="javascript:volver();" />
									</div>
								</div>
							</form>
						</div>
						<!-- indexer::continue -->
						<div class="ce_text g4 xpln block">
							<p><strong>Beneficio</strong><br/> Ingrese el beneficio.</p>
							<p>
								Los campos marcados con <span class="mandatory">*</span> son de
								ingreso obligatorio.
							</p>
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