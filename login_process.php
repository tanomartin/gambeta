<?php
include("includes/claseRecordSet.php");
include("includes/conexion.php");
include("includes/queries.php");
include("includes/multiTorneo.php");

	
$usuario =  (isset($_POST["user"]) ) ?  $_POST["user"] :  "";
$passwd = (isset($_POST["passwd"]) ) ?  $_POST["passwd"] :  "";
												


if($usuario != "" && $passwd != "")
{
	
	$rs = ConectarRS(GetJugadorByUsername($usuario, $passwd)); 
	if ($rs->Eof())
	{
		$_SESSION["_ERROR_"] = "Usuario o password incorrecto";
		header('Location: index.php');
	}
	else
	{
		$_SESSION["userId"] = $rs->Fields("id");
		$_SESSION["userName"] = $rs->Fields("username");
		$_SESSION["nombre"] = $rs->Fields("nombre");
		header('Location: index.php');
	}
}
?>