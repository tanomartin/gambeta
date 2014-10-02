<?php
include("includes/claseRecordSet.php");
include("includes/conexion.php");
include("includes/queries.php");
include("includes/multiTorneo.php");
	
$rs = ConectarRS(GetGonfiguracion());
if(!$rs->Eof())
{
	$destinatario =  $rs->Fields("mailContacto");
}


$nombre = $_POST["txtNombre"];
$mailFrom = $_POST["txtMail"];
$comentario = $_POST["txtMensaje"];

///////////////////////////////////////////////////////////////////////////
// Setup
///////////////////////////////////////////////////////////////////////////
$subject = "Consulta Web de $nombre";
///////////////////////////////////////////////////////////////////////////


$contenido = "<b>Mail:</b> $mailFrom <br /><b>Mensaje:</b> $comentario <br />";
$replyemail="$mailTo";
$themessage = "Nombre: $name \nMensaje: $themessage";

mail($destinatario,$subject, $contenido,
     "From: Formulario de consultas web\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\n");

header("Location:contacto.php?op=OK");
?>