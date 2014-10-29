<?	include_once "include/config.inc.php";
	include_once "../model/fechas.php";
	include_once "../model/torneos.categorias.php";
	include_once "../model/fixture.php";
	include_once "../model/equipos.php";
	include_once "../model/correos.php";

	if(!session_is_registered("usuario")){
		header("Location: index.php");
		exit;
	}
	
	$menu = "Secciones";
	
	$oFecha = new Fechas();
	$fecha = $oFecha -> get($_POST['id']);
	$asunto = "Recordatorio Confirmacion Partido: ".$fecha[0]['nombre']." - ".$fecha[0]['torneo']." - ".$fecha[0]['categoria'];
	
	$oFixture = new Fixture();
	$partidos = $oFixture -> getByFecha($_POST['id']);
	
	$oEquipo = new Equipos();
	$equiposTorneo = $oEquipo -> getTorneoCat($fecha[0]['idTorneoCat']);
	
	$i = 0;
	foreach ($equiposTorneo as $equipo) {
		$tienePartido = false;
		$tieneLibre = false;
		$id = $equipo['id'];
		if ($partidos!= NULL){
			foreach ($partidos as $partido) {
				if ($id == $partido['idEquipo1'] || $id == $partido['idEquipo2']) {
					$equipoOb = new Equipos($id);
					$seEnvio = $equipoOb->seEnvioCorreo($id, $_POST['id'], 'r');
					$confirmado = $oFixture -> partidoConfirmado($partido['id'],$id);
					if (($equipoOb->email != "" ) && (!$seEnvio) && (!$confirmado)) {
						$valores = array('correo' => $equipoOb->email, 'cuerpo' => $_POST['cuerpocorreo'], 'equipoId' => $id, 'equipoNombre' => $equipoOb->nombre, 'asunto' => $asunto);
						$emailOb = new Correos($valores);
						$seEnvio = $emailOb->enviar();
						if ($seEnvio) {
							$equipoOb -> cargarCorreo($id, $_POST['id'], 'c');
						}
					}
				}
			}
		}
	}
	
	?>
