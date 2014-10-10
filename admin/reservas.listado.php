<?	include_once "include/config.inc.php";
	include_once "../model/fechas.php";
	include_once "../model/torneos.categorias.php";
	include_once "../model/reservas.php";
	include_once "../model/equipos.php";

	if(!session_is_registered("usuario")){
		header("Location: index.php");
		exit;
	}
	
	$oReserva = new Reservas();
	$reservas = $oReserva -> getReservaByIdFecha($_POST['id']);
	
	$oFecha = new Fechas();
	$fecha = $oFecha -> get($_POST['id']);
	
	$oEquipo = new Equipos();
	$equiposTorneo = $oEquipo -> getTorneoCat($fecha[0]['idTorneoCat']);

	$equiposConReserva = array();
	$equiposSinReserva = array();
	$r = 0;
	$s = 0;
	foreach($equiposTorneo as $equipo) {
		$tiene = 0;
		$tuvo_libre = $oEquipo-> tieneFechaLibre($fecha[0]['idTorneoCat'], $equipo['id']);
		if ($reservas != NULL) {
			foreach($reservas as $reserva) {
				if ($reserva['id_equipo'] == $equipo['id']) {
					$detalle = $oReserva -> getDetalleReservaById($reserva['id_reserva']);
					$equiposConReserva[$r] = array('id_reserva' => $reserva['id_reserva'],'id_equipo' => $reserva['id_equipo'], 'nombre' => $reserva['nombre'], 'fecha_libre' => $reserva['fecha_libre'], 'tuvo_libre' => $tuvo_libre, 'detalle' => $detalle);
					$r++;
					$tiene = 1;
				} 
			}
		}
		if ($tiene == 0) {
			$equiposSinReserva[$s] = array('id_equipo' => $equipo['id'], 'nombre' => $equipo['nombre'], 'tuvo_libre' => $tuvo_libre);
			$s++;
		}
	}
	
/*	print("<br><br> EQUIPO CON RESERVA <br><br>");
	var_dump($equiposConReserva);
	print("<br><br> EQUIPO SIN RESERVA <br><br>");
	var_dump($equiposSinReserva);
*/
	?>
    
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>

<!-- base href="http://www.typolight.org/" -->
<title>Panel de Control</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="Panel de Control.">
<meta name="keywords" content="">
<meta name="robots" content="index,follow">

<? include("encabezado.php"); ?>


<script language="javascript">

	function eliminarReserva(reserva) {
		document.form_alta.accion.value = "eliminar";
		document.form_alta.id_reserva.value = reserva;
		document.form_alta.submit();
	}

	function cargarReserva(equipo) {
		document.form_alta.accion.value = "cargarnueva";
		document.form_alta.id_equipo.value = equipo;
		document.form_alta.submit();
	}

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
	<a href="index.php" title="Volver al incio"><h1> Panel de Control</h1></a>
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
		  <div class="ce_text block">
				<h1>Reservas: <?= $fecha[0]['nombre']." - ".$fecha[0]['torneo']." - ".$fecha[0]['categoria']?>
				  <div style="float:right"> 
				  	<img width="75" border="0" alt="reserva" title="Exportar Excel" style="cursor:pointer" src="images/xls-icon.png"/>
				  	<img width="75" border="0" alt="reserva" title="Enviar Correo Recordatorio" style="cursor:pointer" src="images/eml-icon.png"/>	
					<img width="75" border="0" alt="reserva" title="volver" onclick="javascript:volver();" style="cursor:pointer" src="images/back-icon.png"/>	
				  </div>
				</h1>
			</div>
			<div class="mod_article block" id="home">
				<div class="ce_text block">
					<div class="mod_listing ce_table listing block" id="partnerlist">
						<form name="form_alta" id="form_alta" action="<?=$_SERVER['PHP_SELF']?>" method="post"  enctype="multipart/form-data"> 
							<input type="hidden" name="id" id="id"  value="<?=$_POST["id"]?>"/>
							<input type="hidden" name="id_equipo" id="id_equipo" />
							<input type="hidden" name="id_reserva" id="id_reserva" />
							<input name="_pag" id="_pag"  value="<?=$_POST["_pag"]?>" type="hidden" />
							<input type="hidden" name="accion" value="" />
							<!-- Filtros -->
							<input type="hidden" name="fnombre" value="<?=$_POST["fnombre"]?>" />
							<!-- Fin filtros -->
							<!-- Parametros menu -->
							<input type="hidden" name="menu" value="<?=$_POST["menu"]?>" />
							<input type="hidden" name="submenu" value="<?=$_POST["submenu"]?>" />
							<input type="hidden" name="pag_submenu" value="<?=$_POST["pag_submenu"]?>" />
							<!--     -->
		
							<div align="center" style="float:left">
								<table id="conReserva" width="450">
										<tr>
											<th><img width="15" border="0" alt="reserva" title="Con Reserva" src="../img/check.ico"/> Con Reserva</th>
											<th>Detalle</th>
											<th width="8%"></th>
										</tr>
									<? if (sizeof($equiposConReserva) == 0) {
											print("<tr><td colspan='3'>No hay equipos</td></tr>");
										} else {
											foreach($equiposConReserva as $equipo) { ?>
											<tr>
												<td style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:17px"><?=$equipo['nombre'] ?></td>
												<td>
													<? 
														if ($equipo['fecha_libre'] == 0) {
															$detalleArray = $equipo['detalle'];
															foreach($detalleArray as $detalle) { ?>
																<li><?= $detalle['descripcion']	?></li>
														<?	} 
														} 
														if ($equipo['fecha_libre'] == 1) {
															print("F.L. EQUIPO");
														}
														if ($equipo['fecha_libre'] == 2) {
															print("F.L. GAMBETA");
														}
														
														?>
												</td>	
												<td nowrap>
													<a href="javascript:eliminarReserva(<?=$equipo['id_reserva']?>);"> <img border="0" src="images/icono-eliminar.gif" alt="ver" title="Editar Reserva" width="20px" height="20px" /></a>
												</td>
								  </tr>	
										<?	} 
										}?>
								</table>
							</div>	
							<div align="center" style="float:right">
								<table id="sinReserva" width="450">
									
										<tr>
											<th><img width="15" border="0" alt="reserva" title="Sin Reserva" src="../img/forbidden.ico"/> Sin Reserva</th>
											<th width="8%"></th>
										</tr>
									
									<? if (sizeof($equiposSinReserva) == 0) {
											print("<tr><td colspan='3'>No hay equipos</td></tr>");
										} else {
											foreach($equiposSinReserva as $equipo) { ?>
											<tr>
												<td style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:17px"><?=$equipo['nombre'] ?></td>
												<td>
													<a href="javascript:cargarReserva(<?=$equipo['id_equipo']?>);"> <img border="0" src="images/icono-editar.gif" alt="ver" title="Cargar Reserva" width="20px" height="20px" /></a>
												</td>
											</tr>	
										<?	} 
										}?>
								</table>	
							</div>
						</form>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>
<? include("pie.php")?>
</body>

</html>