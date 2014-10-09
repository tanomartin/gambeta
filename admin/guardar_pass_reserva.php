<?  include_once "include/config.inc.php";
include_once "../model/equipos.php";

if(!session_is_registered("usuario")){
	header("Location: index.php");
	exit;
}
$oEquipo = new Equipos();
$oEquipo->setPassword($_POST['id'],$_POST['pass']);

header('Location: equipos.php');

?>