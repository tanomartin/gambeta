<?  include_once "include/config.inc.php";
include_once "../model/fechas.php";

if(!session_is_registered("usuario")){
	header("Location: index.php");
	exit;
}

$oFecha = new Fechas();
$oFecha->deleteHorasCancha($_POST['id']);
foreach($_POST as $key => $value) {
	$resultado = strpos($key, "hora");
	if($resultado !== FALSE){
		$oFecha->setHorasCancha($_POST['id'],$value);
	}
}

header('Location: fechas.php');

?>