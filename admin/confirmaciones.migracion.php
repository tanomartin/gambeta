<?	include_once "include/config.inc.php";
	include_once "../model/fechas.php";
	include_once "../model/torneos.categorias.php";
	include_once "../model/reservas.php";
	include_once "../model/fixture.php";
	include_once "../model/equipos.php";

	if(!session_is_registered("usuario")){
		header("Location: index.php");
		exit;
	}
	
	$menu = "Secciones";
	
	$oFecha = new Fechas();
	$fecha = $oFecha -> get($_POST['id']);
	
	$oFixture = new Fixture();
	$partidos = $oFixture -> getByFecha($_POST['id']);
	
	$oEquipo = new Equipos();
	$equiposTorneo = $oEquipo -> getTorneoCat($fecha[0]['idTorneoCat']);
	
	$oReservas = new Reservas();
	$reservasLibres = $oReservas -> getReservaLibresByIdFecha($_POST['id']);
	$reservas = $oReservas -> getReservaByIdFecha($_POST['id']);
	
	$i = 0;
	foreach ($equiposTorneo as $equipo) {
		$tienePartido = false;
		$tieneLibre = false;
		$id = $equipo['id'];
		if ($partidos!= NULL){
			foreach ($partidos as $partido) {
				if ($id == $partido['idEquipo1'] || $id == $partido['idEquipo2']) {
					$tienePartido = true;	
				}
			}
		}
		if ($reservas != NULL) {
			foreach ($reservas as $reserva) {
				if ($id == $reserva['id_equipo'] && $reserva['fecha_libre'] != 0) {
					$tieneLibre = true;
				}
			}
		}
		if (!$tienePartido && !$tieneLibre){
			$equiposSinDefinir[$i] = array('nombre' => $equipo['nombre']);
			$i++;
		}
	}
	
	$cruce = array();
	foreach ($equiposTorneo as $equipo1) {
		foreach ($equiposTorneo as $equipo2) {
			$jugaron = $oFixture -> jugaronEnContra($equipo1['id'], $equipo2['id'], $fecha[0]['idTorneoCat'], $_POST['id']);
			$juegaEstaFecha = $oFixture -> juegaEstaFecha($equipo1['id'], $equipo2['id'], $fecha[0]['idTorneoCat'], $_POST['id']);
			$id = $equipo1['id'].$equipo2['id'];
			if ($jugaron) {
				$cruce[$id] = "#CCCCCC";
			}
			if ($juegaEstaFecha) {
				$cruce[$id] = "#0000CC";
			}
			if ($jugaron && $juegaEstaFecha) {
				$cruce[$id] = "#FF0000";
			}
		}
	}
	
	$excelName ="Cruces-".$fecha[0]['nombre']."-".$fecha[0]['torneo']."-".$fecha[0]['categoria'].".xls";
	
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$excelName");
	
	?>

	<html>
	<div style="visibility:hidden">
	<h1>CRUSES: <?= $fecha[0]['nombre']." - ".$fecha[0]['torneo']." - ".$fecha[0]['categoria']?></h1>
	<table id="cruces" name="cruces" border="1">
		<tr><td style="background-color:#CE6C2B; color:#FFFFFF"><b>EQUIPOS</b></td>
		<? foreach ($equiposTorneo as $equipo) { ?>
				<td style="background-color:#CE6C2B; color:#FFFFFF"><?=$equipo['nombre'] ?></td>
		<? } ?>
		</tr>
	  <? foreach ($equiposTorneo as $equipo1) { ?>
			<tr>
				<td style="background-color:#CE6C2B; color:#FFFFFF"><?=$equipo1['nombre'] ?></td>
			    <? foreach ($equiposTorneo as $equipo2) { 
						if ($equipo1['id'] == $equipo2['id']) {  ?>
							<td style="background-color:#CE6C2B"></td>
					<? } else { 
							$id = $equipo1['id'].$equipo2['id']; 
								if (array_key_exists($id,$cruce)) { ?>
									<td style="background-color:<?=$cruce[$id] ?>"></td>
							 <? } else { ?>
									<td></td>
							 <? } ?>
					<? } 
					} ?>
			</tr>
		<? } ?>
	</table>
	</div>
	</html>