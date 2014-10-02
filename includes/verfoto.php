<?php
if(isset($_GET['id'])) {
    $_GET['id']
	$sql = "SELECT foto FROM freelance WHERE idFreelance='".$_GET['id']."'";
	$result = mysql_query($sql,$connect);
    $datos = mysql_result($result,0,"foto");
    header("Content-type: image/jpeg");
    echo $datos;
}
?> 