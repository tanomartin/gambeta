<?	include_once "include/config.inc.php";
	include_once "../model/fechas.php";
	include_once "../model/torneos.categorias.php";
	include_once "../model/reservas.php";
	include_once "../model/equipos.php";
	include_once "../model/correos.php";

	if(!session_is_registered("usuario")){
		header("Location: index.php");
		exit;
	}
	
	$oReserva = new Reservas();
	$reservas = $oReserva -> getReservaByIdFecha($_POST['id']);
	
	$oFecha = new Fechas();
	$fecha = $oFecha -> get($_POST['id']);
	$asunto = "Recordatorio Reserva Horario: ".$fecha[0]['nombre']." - ".$fecha[0]['torneo']." - ".$fecha[0]['categoria'];
	
	$oEquipo = new Equipos();
	$equiposTorneo = $oEquipo -> getTorneoCat($fecha[0]['idTorneoCat']);
	
	$equiposSinReserva = array();
	foreach($equiposTorneo as $equipo) {
		$tiene = 0;
		$tuvo_libre = $oEquipo-> tieneFechaLibre($fecha[0]['idTorneoCat'], $equipo['id']);
		if ($reservas != NULL) {
			foreach($reservas as $reserva) {
				if ($reserva['id_equipo'] == $equipo['id']) {
					$tiene = 1;
				} 
			}
		}
		if ($tiene == 0) {
			$s = $equipo['id'];
			$equipoOb = new Equipos($equipo['id']);
			$seEnvio = $equipoOb->seEnvioCorreoReserva($equipo['id'], $_POST['id']);
			if (($equipoOb->email != "" ) && (!$seEnvio)) {
				$valores = array('correo' => $equipoOb->email, 'cuerpo' => $_POST['cuerpocorreo'], 'equipoId' => $equipo['id'], 'equipoNombre' => $equipo['nombre'], 'asunto' => $asunto);
				$emailOb = new Correos($valores);
				$seEnvio = $emailOb->enviar();
				if ($seEnvio) {
					$equipoOb -> cargarCorreoReserva($equipo['id'], $_POST['id']);
				}
			}
		}
	}	
	?>
