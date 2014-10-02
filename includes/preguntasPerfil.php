<?php
$RESOURCES['preg1'] = "Un cuadro de fútbol";
$RESOURCES['preg2'] = "Una película";
$RESOURCES['preg3'] = "Un libro";
$RESOURCES['preg4'] = "Un hobbie";
$RESOURCES['preg5'] = "Un animal";
$RESOURCES['preg6'] = "Un lugar";
$RESOURCES['preg7'] = "Una canción";
$RESOURCES['preg8'] = "Banda de música favorita";
$RESOURCES['preg9'] = "Un perfume";
$RESOURCES['preg10'] = "Un jugador";


function GetResource($name)
{
	global $RESOURCES;
	return $RESOURCES[$name];
}
?>