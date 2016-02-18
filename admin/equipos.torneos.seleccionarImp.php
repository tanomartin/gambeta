<?
include_once "include/config.inc.php";
require_once "include/PHPExcel/PHPExcel.php";
$inputFileName = $_FILES ['ficha'] ['tmp_name'];
$objPHPExcel = PHPExcel_IOFactory::load ( $inputFileName );
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title>Panel de Control</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Panel de Control." />
<meta name="keywords" content="" />
<meta name="robots" content="index,follow" />
	
	<? include("encabezado.php"); ?>
	
	<script>
	function volver(){
		document.form_alta.accion.value = "jugadoras";		
		document.form_alta.submit();
	}
	
	</script>
</head>

<body id="top" class="home">
	<div id="wrapper">
		<div id="header">
			<div class="inside">
				<? include("top_menu.php"); ?>
				<div id="logo">
					<h1>
						<a href="index.php" title="Volver al incio"> Panel de Control</a>
					</h1>
				</div>
				<? include("menu.php");?>
			</div>
		</div>
		<div id="container">
			<div id="main">
				<div class="inside">
					<? include("path.php"); ?>
					<div class="mod_article block" id="home">
						<div class="ce_text block">
							<h1>Imporacion de Jugadoras equipo <? echo $_POST['fnombre']?></h1>
						</div>
						<div class="ce_text block">
							<div class="mod_listing ce_table listing block" id="partnerlist">
								<form name="form_alta" id="form_alta"
									action="<?=$_SERVER['PHP_SELF']?>" method="post">
									<input name="id" id="id"  value="<?=$_POST["id"]?>" type="hidden" />
									<input name="_pag" id="_pag"  value="<?=$_POST["_pag"]?>" type="hidden" />
									<input type="hidden" name="accion" value="guardarImportar" />
									<input type="hidden" name="idTorneoEquipo" value="<?=$_POST["idTorneoEquipo"]?>" />
									<input type="hidden" name="idTorneoCat" value="<?=$_POST["idTorneoCat"]?>" />
									<input type="hidden" name="fnombre" value="<?=$_POST["fnombre"]?>" />
									<!-- Parametros menu -->
									<input type="hidden" name="menu" value="<?=$_POST["menu"]?>" />
									<input type="hidden" name="submenu" value="<?=$_POST["submenu"]?>" /> <input type="hidden" name="pag_submenu" value="<?=$_POST["pag_submenu"]?>" />
									<!--     -->
									<table style="width: 928px">
										<tr>
											<th>Nombre</th>
											<th>D.N.I.</th>
											<th>Fecha Nacimiento</th>
											<th>Email</th>
											<th>Telefono</th>
											<th width="5%">Importar</th>
											<th width="5%">Asociar</th>
										</tr>
								<?	for($fila = 18; $fila < 31; $fila ++) {
										$oJugadora = new Jugadoras ();
										$nombre = $objPHPExcel->getActiveSheet ()->getCell ( 'A' . $fila )->getValue ();
										$apellido = $objPHPExcel->getActiveSheet ()->getCell ( 'B' . $fila )->getValue ();
										$dni = $objPHPExcel->getActiveSheet ()->getCell ( 'C' . $fila )->getValue ();
										// $objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
										$fecnac = $objPHPExcel->getActiveSheet ()->getCell ( 'E' . $fila )->getFormattedValue ();
										$telefono = $objPHPExcel->getActiveSheet ()->getCell ( 'F' . $fila )->getValue ();
										$email = $objPHPExcel->getActiveSheet ()->getCell ( 'H' . $fila )->getValue ();
										
										$jugadora = $oJugadora->getBYDocumento ( $dni );
										$exite = false;
										if ($jugadora != NULL) {
											$exite = true;
										} if ($dni != "") { ?>
											<tr>
											<td align="left"><?=$nombre." ".$apellido?><input type="hidden" name="nombreyapellido<? echo $dni?>" value="<?=$nombre." ".$apellido?>"/> </td>
											<td align="left"><?=$dni?><input type="hidden" name="dni<? echo $dni?>" value="<?=$dni ?>"/> </td>
											<td align="left"><?=$fecnac?><input type="hidden" name="fecna<? echo $dni?>c" value="<?=$fecnac?>"/> </td>
											<td align="left"><?=$email?><input type="hidden" name="email<? echo $dni?>" value="<?=$email?>"/> </td>
											<td align="left"><?=$telefono?><input type="hidden" name="telefono<? echo $dni?>" value="<?=$telefono?>"/> </td>
							                   <? if (! $exite) { ?>
													<td style="text-align: center"><input type="checkbox" id="importar<? echo $dni?>" name="importar<? echo $dni?>" /></td>
													<td></td>
											 <?	} else { ?>
											 		<td></td>
											 		<td style="text-align: center"><input type="checkbox" id="asociar<? echo $dni?>" name="asociar<? echo $dni?>" /></td>	
											 <?	} ?>
							 				
										</tr>
										 <? } 
										 }?>
									</table>
									<div class="submit_container">
		    							<input class="submit" onclick="valirdarForm_submit('form_alta')" type="button" value="Guardar Imprtacion" /> 
		    							<input class="submit" type="button" value="Volver" onclick="javascript:volver();" />
		    						</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<? include("pie.php")?>
	</div>
</body>
</html>