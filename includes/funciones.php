<?php
$vectorMes = array ('CERO','enero','febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

function fecha() {
$vectorDia = array('domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado');
$fecha = getdate();
$dia = $fecha["mday"];
$mes = $fecha["mon"];
$anio = $fecha["year"];
$ndia = $fecha["wday"];
global $vectorMes;
print ("Buenos Aires, " . $vectorDia[$ndia] . " " . $dia . " de ". $vectorMes[$mes] . " de ". $anio . ".-");
}


function LiteralizarPeriodos($periodo1, $periodo2)
{
	global $vectorMes;
	$retVal = "";
	$mes1 = (int)gmdate("month", $periodo1);
	$anio1 = (int)gmdate("Y", $periodo1);

	if ($periodo1 == $periodo2) 
	{
		$retVal = $vectorMes[(int)$mes1] ." de " .$anio1;
	}
	else 
	{
		$mes2 = (int)gmdate("mon", $periodo2);
		$anio2 = (int)gmdate("Y",$periodo2);
		if ($anio1 == $anio2) {
			$retVal = $vectorMes[(int)$mes1] ." / ".  $vectorMes[(int)$mes2] . " de " .$anio2; 
		}	
		else
		{
			$retVal = $vectorMes[(int)$mes1] ." de " .$anio1 . " / ".  $vectorMes[(int)$mes2] . " de " .$anio2; 
		}
	}
	
	return $retVal;
}
?>