<?php

function TraerUltimaFechaByTorneo()
{
	$idF = 0;
	
	$rs = ConectarRS(GetUltimaFechaByTorneo(GetTorneo())); 

	if(!$rs->Eof())
	{
		$idF = $rs->Fields("id");
	}
	
	return $idF;
}

function TraerFechaById($idFecha)
{

	$rs = ConectarRS(GetFechaById($idFecha)); 

	if(!$rs->Eof())
	{
		echo sprintf("%s - %s - %s",$rs->Fields("nombre"),$rs->Fields("fechaInicio"),$rs->Fields("fechaFin"));
	}
	else
		echo "No hay registros para mostrar";
}

function TraerEquipoIdeal($idFecha)
{

	$rs = ConectarRS(GetEquipoIdeal($idFecha)); 

	if ($rs->Eof())
	{
		echo "No hay registros para mostrar";
		return false;
	}
	
	for($i=1; $i<6;$i++)
	{
		if (!$rs->Eof())
		{
			echo sprintf("<div id=\"j%s\" class=\"jugadora\"><div class=\"foto\"><a href=\"jugador.php?id=%s\"><img src=\"admin/uploads/%s\" alt=\"\" border=\"0\" width=\"55\" height=\"55\" /></a></div><div class=\"info\"><h3>%s</h3><p class=\"nombre\"><a href=\"jugador.php?id=%s\">%s</a></p><p class=\"equipo\"><a href=\"equipo.php?id=%s\">%s</a></p></div></div>",$i,$rs->Fields("idJugador"),$rs->Fields("foto"),$rs->Fields("posicionCancha"),$rs->Fields("idJugador"),$rs->Fields("nombreJugador"),$rs->Fields("idEquipo"),$rs->Fields("nombreEquipo"));
			
			$rs->moveNext();
		}
	}

}

?>

<?php 
	$idFecha =  (isset($_GET['fid']) ) ?  $_GET['fid'] :  0;
	
	if($idFecha == 0)
	{
		$idFecha = TraerUltimaFechaByTorneo();
	}
?>

<div>
  <!-- title-box2 begin -->
  <div class="title-box2">
	<div class="left-top-corner">
	  <div class="right-top-corner">
		<div class="right-bot-corner">
		  <div class="left-bot-corner">
			<div class="inner">
			  <div class="wrapper">
				<h3><?php TraerFechaById($idFecha);  ?></h3>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  <!-- title-box2 end -->
  <!-- box3 begin -->
  <div class="box2">
	<div class="left-top-corner">
	  <div class="right-top-corner">
		<div class="border-top"></div>
	  </div>
	</div>
	<div class="border-left">
	  <div class="border-right">
		<div class="inner">
		  <div class="extra-wrap">
			<div id="cancha">
			  <?php TraerEquipoIdeal($idFecha);  ?>
			</div>
			<div class="wrapper"></div>
		  </div>
		  <div class="clear"></div>
		</div>
	  </div>
	</div>
	<div class="left-bot-corner">
	  <div class="right-bot-corner">
		<div class="border-bot"></div>
	  </div>
	</div>
  </div>
  <!-- Proxima fecha -->
  <!-- box3 end -->
</div>