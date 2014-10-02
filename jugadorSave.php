<?php
	session_start(); // Initialize session data
	include("includes/claseRecordSet.php");
  	include("includes/conexion.php");
	include("includes/queries.php");
	include("includes/multiTorneo.php");

$id =  ($_SESSION[userId] ) ?  $_SESSION[userId] :  0;

$pregunta1 =  ($_POST["preg1"]) ?  $_POST["preg1"] :  "";
$pregunta2 =  ($_POST["preg2"]) ?  $_POST["preg2"] :  "";
$pregunta3 =  ($_POST["preg3"]) ?  $_POST["preg3"] :  "";
$pregunta4 =  ($_POST["preg4"]) ?  $_POST["preg4"] :  "";
$pregunta5 =  ($_POST["preg5"]) ?  $_POST["preg5"] :  "";
$pregunta6 =  ($_POST["preg6"]) ?  $_POST["preg6"] :  "";
$pregunta7 =  ($_POST["preg7"]) ?  $_POST["preg7"] :  "";
$pregunta8 =  ($_POST["preg8"]) ?  $_POST["preg8"] :  "";
$pregunta9 =  ($_POST["preg9"]) ?  $_POST["preg9"] :  "";
$pregunta10 =  ($_POST["preg10"]) ?  $_POST["preg10"] :  "";

$passwd =  ($_POST["passwd1"]) ?  $_POST["passwd1"] :  "";

$acerca =  ($_POST["acerca"]) ?  $_POST["acerca"] :  "";
$acerca = ereg_replace("\n","<br />", $acerca);
	
$rs = ConectarRS(UpdatePerfilById($id, $passwd, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8, $pregunta9, $pregunta10, $acerca));

$_SESSION[msgEdit] = "OK";

header("Location:jugadorEdit.php");
?>