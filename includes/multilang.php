<?php
session_start();
$defaultLang = "2";

foreach ($_GET as $key => $value) {
            if ($key != "C" && $key != "lang") {  // ignore this particular $_GET value
                $querystring .= $key."=".$value;
            }
}

//Verifico si tengo el idioma en el querystring. Indica que quiere cambiar el idioma
if(isset($_GET["lang"]))
{
	Set_Cookie($_GET["lang"]);
	//echo "seteo la coolie";
	Set_Session($_GET["lang"]);
	//echo "seteo session ".GetLanguage();
}
else
{
	 //echo "no pide cambiar";
	//Verifico si tiene idioma en session
	if(!isset($_SESSION["lang"]))
	{
		//Si no tiene idioma en session me fijo si tiene la cookie y seteo el idioma de session con el valor de la cookie
		if(isset($_COOKIE["RYLLangNav"]))
		{
			Set_Session($_COOKIE["RYLLangNav"]);
		}
		else
		{
			//Si no tiene cookie le seteo una con el idioma default
			Set_Cookie($defaultLang);
			Set_Session($defaultLang);
		}
	}
}	
//Hago el include dinamico de los recursos
include("resources/".GetLanguage().".php");
	

//Expongo un metodo para obtener el idioma
function GetLanguage()
{
	return $_SESSION['lang'];
}

function Set_Cookie($lang)
{
	$expire=time()+60*60*24*180;
	setcookie("RYLLangNav", $lang, $expire);
}

function Set_Session($lang)
{
	$_SESSION["lang"] = $lang;
}

function CurrentPage($id) {
global $querystring;

if(isset($querystring))
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) . "?lang=".$id."&amp;".$querystring;
else
 	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) . "?lang=".$id;
}

function GetResource($name)
{
	global $RESOURCES;
	return $RESOURCES[$name];
}


function GetMenu()
{
	echo "<a href='" . CurrentPage(1) ."'>" . GetResource("mnu_sp") . "</a> | <a href='" .CurrentPage(2). "'>Ingles</a> | <a href='". CurrentPage(3)."'>Italiano</a>";
}
?>