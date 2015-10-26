<?
	include_once "include/config.inc.php";
	include_once "../model/jugadoras.php";	
	header("Content-Type:text/html; charset=utf-8"); 
	$oJugadoras = new Jugadoras();
	var_dump($_REQUEST);
	$aJugadoras = $oJugadoras->getByEquipoTorneo($_REQUEST['id'],$_REQUEST['idTorneCat']);
?>
	 <select name="<?=$_REQUEST["id_sublista"]?>" id="<?=$_REQUEST["id_sublista"]?>"  class="validate-selection">
		<option value="-1">Seleccione antes un Equipo</option>
	 <? for ($i=0;$i<count($aJugadoras);$i++) { ?>		
			<option value="<?=$aJugadoras[$i]["id"]?>"><?=$aJugadoras[$i]["nombre"]?> </option>
     <? } ?>
	</select>
	<span id="<?=$_REQUEST["id_status"]?>"> </span>