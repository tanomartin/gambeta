<?  include_once "include/config.inc.php";
include_once "model/reservas.php";
include_once "model/fixture.php";

$oPartido = new Fixture();
$idPartido = $_GET['idPartido'];
$oPartido -> confirmarPartido($idPartido, $_SESSION['equipo']);
header('Location: reserva_menu.php');

?>