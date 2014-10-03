<?  include_once "include/config.inc.php";
	include_once "model/torneos.categorias.php";
	include_once "model/equipos.php";
	include_once "model/torneos.php";
	include_once "model/categorias.php";
	include_once "model/fechas.php";
	
	var_dump($_POST);
	print("<br>");print("<br>");
	
	$oObj = new Torneos();
	$oTorneo = $oObj->getByTorneoCat($_POST['id']);
	
	$idTorneo = $oTorneo->id_torneo;
	$idZona = $oTorneo->id_categoria;
	$idCategoria = $oTorneo->id_padre;

	$torneo = $oObj->get($idTorneo);
	print_r($torneo);
	print("<br>");
	$oCategoria = new Categorias();
	$zona = $oCategoria->get($idCategoria);
	print_r($zona);
	print("<br>");
	$categoria = $oCategoria->get($idZona);
	print_r($categoria);
	print("<br>");
	
	$oFechas = new Fechas();
	$fecha = $oFechas->getIdTorneoCat($_POST['id'],"fechaIni DESC");
	print_r($fecha[0]);
	print("<br>");
?>