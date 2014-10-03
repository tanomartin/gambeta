<?  include_once "include/config.inc.php";
	include_once "model/equipos.php";
	
	var_dump($_POST);
	$oObj = new Equipos();
	$ingresa = $oObj->accesoCorrecto($_POST['equipo'],$_POST['pwd']);
	
	if ($ingresa) {
		print("Ingresa");
	} else {
		print("No ingresa");
	}
?>