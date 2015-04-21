<?  include_once "include/config.inc.php";
include_once "model/reservas.php";

if(!session_is_registered("equipo")){
	header("Location: index.php");
	exit;
}

$reserva = new Reservas();
$valores["id_fecha"] = $_POST['id_fecha'];
$valores["id_equipo"] = $_SESSION['equipo'];
$valores["observacion"] = $_POST['observacion'];

if ($valores["id_fecha"] != 0) {
	if (isset($_POST['libre'])) {
		$valores["fecha_libre"] = 1;
		$reserva->set($valores);
		$reserva->insertar();
	} else {
		$valores["fecha_libre"] = 0;
		$reserva->set($valores);
		$reserva->insertar();
		if ($reserva->id != 0) {
			foreach($_POST as $key => $value) {
				$resultado = strpos($key, "hora");
				if($resultado !== FALSE){
					$valoresDetalle['id_reserva'] = $reserva->id;
					$valoresDetalle['id_horas_cancha'] = $value;
					$reserva->insertarDetalleReserva($valoresDetalle);
				}
			}
		}
	}
}
header('Location: reserva_menu.php');

?>