<?  include_once "include/config.inc.php";
	include_once "model/equipos.php";
	
	$oObj = new Equipos();
	$ingresa = $oObj->accesoCorrecto($_POST['equipo'],$_POST['pwd']);
	if ($ingresa) {
		$respuesta = 0;
	} else { 
		$respuesta = "Usuario y/o contrase&ntildea incorrecta.";
	}
	print($respuesta);
?>