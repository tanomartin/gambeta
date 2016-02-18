<?php
include_once "include/config.inc.php";

var_dump($_POST);
print("<br>");print("<br>");
var_dump($_FILES);
print("<br>");print("<br>");
require_once "include/PHPExcel/PHPExcel.php";


$inputFileName = $_FILES['ficha']['tmp_name'];
print($inputFileName);
echo 'Loading file '.pathinfo($inputFileName,PATHINFO_BASENAME).' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

echo '<hr />';

for ($fila = 18; $fila < 31; $fila++) {
	$oJugadora = new Jugadoras();
	$nombre = $objPHPExcel->getActiveSheet()->getCell('A'.$fila)->getValue();
	$apellido = $objPHPExcel->getActiveSheet()->getCell('B'.$fila)->getValue();
	$dni = $objPHPExcel->getActiveSheet()->getCell('C'.$fila)->getValue();
	//$objPHPExcel->getActiveSheet()->getStyle('E'.$fila)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
	$fecnac = $objPHPExcel->getActiveSheet()->getCell('E'.$fila)->getFormattedValue();
	$telefono = $objPHPExcel->getActiveSheet()->getCell('F'.$fila)->getValue();
	$email = $objPHPExcel->getActiveSheet()->getCell('H'.$fila)->getValue();
	
	$jugadora = $oJugadora->getBYDocumento($dni);
	if ($jugadora != NULL) {
		echo "EXISTE <br>";
		var_dump($jugadora);print("<br>");print("<br>");
	} else {
		echo "NUEVA <br>";
		$nuevaJugadora["nombre"] = $nombre." ".$apellido;
		$nuevaJugadora["dni"] = $dni;
		$nuevaJugadora["email"] = $email;
		$nuevaJugadora["fechaNac"] = $fecnac;
		$nuevaJugadora["telefono"] = $telefono;
		var_dump($nuevaJugadora);print("<br>");print("<br>");
		$oJugadora->set($nuevaJugadora);
	}
}

?>