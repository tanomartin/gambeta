<?php
session_start();
$torneoDefault = "1";

foreach ($_GET as $key => $value) {
            if ($key != "C" && $key != "t") {  // ignore this particular $_GET value
                $querystring .= $key."=".$value;
            }
}

//Verifico si tengo el idioma en el querystring. Indica que quiere cambiar el idioma
if(isset($_GET["t"]))
{
	Set_Cookie($_GET["t"]);
	//echo "seteo la coolie";
	Set_Session($_GET["t"]);
	//echo "seteo session ".GetLanguage();
}
else
{
	 //echo "no pide cambiar";
	//Verifico si tiene idioma en session
	if(!isset($_SESSION["t"]))
	{
		//Si no tiene idioma en session me fijo si tiene la cookie y seteo el idioma de session con el valor de la cookie
		if(isset($_COOKIE["GFTQ"]))
		{
			Set_Session($_COOKIE["GFTQ"]);
		}
		else
		{
			//Si no tiene cookie le seteo una con el idioma default
			Set_Cookie($torneoDefault);
			Set_Session($torneoDefault);
		}
	}
}	
//Hago el include dinamico de los recursos
//include("resources/".GetLanguage().".php");
	

//Expongo un metodo para obtener el idioma
function GetTorneo()
{
	return $_SESSION['t'];
}

function Set_Cookie($torneo)
{
	$expire=time()+60*60*24*180;
	setcookie("GFTQ", $torneo, $expire);
}

function Set_Session($lang)
{
	$_SESSION["t"] = $lang;
}

function CurrentPage($id) {
global $querystring;

if(isset($querystring))
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) . "?t=".$id."&amp;".$querystring;
else
 	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) . "?t=".$id;
}

function GetCboTorneos()
{
	$rs = ConectarRS(GetTorneos());

	
	while(!$rs->Eof())
	{
		echo sprintf("<option value=\"%s\" %s class=\"text\" >%s</option>",$rs->Fields("id"), IsCboTorneoDefault($rs->Fields("id")), $rs->Fields("nombre")  );	
		$rs->moveNext();
	}
	
	return true;
}

function IsCboTorneoDefault($index)
{
	$retVal = "";
	if($index == GetTorneo())
		$retVal = "selected=\"true\"";

	return $retVal;
}

function ConectarRS($sql)
{
	$rs = new RecordSet();
	$con = Conectar();
	$rs->Open($sql, $con);
	return $rs;
}
?>