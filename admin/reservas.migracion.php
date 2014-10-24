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
	$horasFecha = $oFecha -> getHorasCancha($_POST['id']);
	
	$oEquipo = new Equipos();
	$equiposTorneo = $oEquipo -> getTorneoCat($fecha[0]['idTorneoCat']);

	$equiposConReserva = array();
	$equiposSinReserva = array();
	foreach($equiposTorneo as $equipo) {
		$tiene = 0;
		$tuvo_libre = $oEquipo-> tieneFechaLibre($fecha[0]['idTorneoCat'], $equipo['id']);
		if ($reservas != NULL) {
			foreach($reservas as $reserva) {
				if ($reserva['id_equipo'] == $equipo['id']) {
					$detalle = $oReserva -> getDetalleReservaById($reserva['id_reserva']);
					$r = $reserva['id_equipo'];
					$equiposConReserva[$r] = array('id_reserva' => $reserva['id_reserva'],'id_equipo' => $reserva['id_equipo'], 'nombre' => $reserva['nombre'], 'fecha_libre' => $reserva['fecha_libre'], 'observacion' =>  $reserva['observacion'] ,'tuvo_libre' => $tuvo_libre, 'detalle' => $detalle);
					$tiene = 1;
				} 
			}
		}
		if ($tiene == 0) {
			$s = $equipo['id'];
			$equiposSinReserva[$s] = array('id_equipo' => $equipo['id'], 'nombre' => $equipo['nombre'], 'tuvo_libre' => $tuvo_libre);
		}
	}
	
	$excelName = "Reservas-".$fecha[0]['nombre']."-".$fecha[0]['torneo']."-".$fecha[0]['categoria'].".xls";
	
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$excelName");
	
	?>

	<html>
	<div style="visibility:hidden">
	<h1>Reservas: <?= $fecha[0]['nombre']." - ".$fecha[0]['torneo']." - ".$fecha[0]['categoria']?></h1>
	<table id="reservas" name="reservas" border="1">
			<tr>
				<td style="background-color:#CE6C2B; color:#FFFFFF"></td>
		 	<? foreach ($horasFecha as $horas) { ?>
				<td style="background-color:#CE6C2B; color:#FFFFFF"><?=$horas['descripcion'] ?></td>
		 	<? } ?>
		</tr>
	 <? foreach ($equiposTorneo as $equipo) { 
			$id = $equipo['id'];	?>
			<tr>
				<td style="background-color:#CE6C2B; color:#FFFFFF"><?=$equipo['nombre'] ?></td>
			 <? if (array_key_exists($id,$equiposConReserva)) { 
					$reserva = $equiposConReserva[$id];
					if ($reserva['fecha_libre'] == 1) { ?>
						<td colspan="<?=sizeof($horasFecha)?>" style="text-align:center; font-size:16px; color:#000099">FECHA LIBRE EQUIPO</td>
				 <? }
					if ($reserva['fecha_libre'] == 2) { ?>
						<td colspan="<?=sizeof($horasFecha)?>" style="text-align:center; font-size:16px; color:#FF6699">FECHA LIBRE GAMBETA</td>
				<?	}
					if ($reserva['fecha_libre'] == 0) { 
						foreach ($horasFecha as $horas) {
							$detalle = $reserva['detalle'];
							$marca = false;
							foreach($detalle as $horasreservada) {
								if ($horasreservada['id_horas_cancha'] == $horas['id_horas_cancha']) {
									$marca = true;
								}
							}
							if ($marca) {?>
								<td style="text-align:center; font-size:16px">X</td>
						<?  } else { ?>
								<td></td>
						<?  } ?>
			    	<?	}
					}
					if ($reserva['observacion'] != "") { $colspanObs =sizeof($horasFecha)+1; ?>
						<tr><td colspan="<?=$colspanObs?>"><?="Obs: <b>".$reserva['observacion']."</b>"?></td></tr>
				<?	} 
				} else { ?>
					<td colspan="<?=sizeof($horasFecha)?>" style="text-align:center; font-size:16px; color:#FF0000">SIN RESERVA</td>
	    	  <? }?>
		  </tr>
	<? } ?>
	</table>
	</div>
	</html>