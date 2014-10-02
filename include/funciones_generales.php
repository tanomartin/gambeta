<?php
function fecha(){
	switch (date('w')){
		case 0: $dia = "Domingo"; break;
		case 1: $dia =  "Lunes"; break;
		case 2: $dia =  "Martes"; break;
		case 3: $dia =  "Miércoles"; break;
		case 4: $dia =  "Jueves"; break;
		case 5: $dia =  "Viernes"; break;
		case 6: $dia =  "Sábado"; break;
	}  

  switch ( date(m) ) {
    case '1': $mes="Enero"; break;
    case '2': $mes="Febrero"; break;
    case '3': $mes="Marzo"; break;
    case '4': $mes="Abril"; break;
    case '5': $mes="Mayo"; break;
    case '6': $mes="Junio"; break;
    case '7': $mes="Julio"; break;
    case '8': $mes="Agosto"; break;
    case '9': $mes="Septiembre"; break;
    case '10': $mes="Octubre"; break;
    case '11': $mes="Noviembre"; break;
    case '12': $mes="Diciembre"; break;
    }
	$armar_fecha = $dia.' '.date("j").' de '.$mes.' de '.date("Y"); 

return $armar_fecha;

}

function php2js ($var) {

    if (is_array($var)) {
        $res = "[";
        $array = array();
        foreach ($var as $a_var) {
            $array[] = php2js($a_var);
        }
        return "[" . join(";", $array) . "]";
    }
    elseif (is_bool($var)) {
        return $var ? "true" : "false";
    }
    elseif (is_int($var) || is_integer($var) || is_double($var) || is_float($var)) {
        return $var;
    }
    elseif (is_string($var)) {
        return "\"" . addslashes(stripslashes($var)) . "\"";
    }

    return FALSE;
}

?>