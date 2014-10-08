<?  include_once "include/config.inc.php";
include_once "model/reservas.php";
include_once "model/fixture.php";

if(!session_is_registered("equipo")){
	header("Location: index.php");
	exit;
}

$oPartido = new Fixture();
$idPartido = $_GET['idPartido'];
$oPartido -> confirmarPartido($idPartido, $_SESSION['equipo']);
header('Location: reserva_menu.php');

?>