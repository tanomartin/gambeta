<?  include_once "include/config.inc.php";
	include_once "model/equipos.php";
	if ($_POST['equipo'] != 0 && $_POST['pwd'] != "") {
		$oObj = new Equipos();
		$ingresa = $oObj->accesoCorrecto($_POST['equipo'],$_POST['pwd']);
		if ($ingresa) {
			$respuesta = 0;
			session_start();
			$_SESSION['equipo'] = $_POST['equipo'];
			$_SESSION['id'] = $_POST['id'];
		} else { 
			$respuesta = "Contrase&ntildea incorrecta.";
		}
	} else {
		$respuesta = "Debe seleccionar un equipo e ingresar su contrase&ntildea";
	}	
	print($respuesta);
?>