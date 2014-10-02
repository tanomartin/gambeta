<?php
function GetTablaPosiciones($torneo, $sessioId)
{

	//Vacio la tabla de proceso
	ConectarRS(DeleteProcesoPosiciones($sessioId));

	LlenarTablaPosiciones($torneo, $sessioId);
	$rs = ConectarRS(GetProcesoPosicionesHome($sessioId)); 

	for($i=1; $i<7;$i++)
	{
		if(!$rs->Eof())
			echo sprintf("<tr><td class=\"cell-1\">%s</td><td class=\"cell-2\"><a href=\"equipo.php?id=%s\">%s</a></td><td class=\"cell-3\">%s</td><td class=\"cell-4\">%s</td></tr>",$i,$rs->Fields("id"),$rs->Fields("nombre"),$rs->Fields("pj"),$rs->Fields("puntos"));
		else
			echo sprintf("<tr><td class=\"cell-1\">%s</td><td class=\"cell-2\"><a href=\"equipo.php?id=%s\">%s</a></td><td class=\"cell-3\">%s</td><td class=\"cell-4\">%s</td></tr>",$i,"-","-","0","0");


		$rs->moveNext();
		
	}
/*	Vacio la tabla de proceso
	ConectarRS(DeleteProcesoPosiciones($sessioId));
*/
}

function LlenarTablaPosiciones($torneo, $sessioId)
{
	$puntosPartidoGanado = 0;
	$puntosPartidoEmpatado = 0;
	$puntos=0;
	$gf=0;
	$gc=0;
	$pg=0;
	$pe=0;
	$pp=0;
	$tr=0;
	$ta=0;
	$tabla="";
	
	//Obtengo los puntos de la configuracion
	$rsConfig = ConectarRS(GetGonfiguracion());
	
	if(!$rsConfig->Eof())
	{
		$puntosPartidoGanado = $rsConfig->Fields("puntosPartidoGanado");
		$puntosPartidoEmpatado = $rsConfig->Fields("puntosPartidoEmpatado");
	}
	else
		return false;
	
	//Por cada equipo obtengo los resultados
	$rsEq = ConectarRS(GetEquipos($torneo));

	while(!$rsEq->Eof())
	{
		$rsFix = ConectarRS(GetListaFechas($torneo, $rsEq->Fields("id")));

		while(!$rsFix->Eof())
		{
			
			// Me quedo solo con los partidos que tienen dos equipos y cargados los goles
			if($rsFix->Fields("idEquipo2") != NULL && $rsFix->Fields("golesEquipo1") != NULL && $rsFix->Fields("golesEquipo2") != NULL)
			{

				if ($rsFix->Fields("indicador") == 1)
				{
					$gf += $rsFix->Fields("golesEquipo1");
					$gc += $rsFix->Fields("golesEquipo2");
					$tr += $rsFix->Fields("expulsadosEquipo1");
					$ta += $rsFix->Fields("amonestadosEquipo1");
					
					if($rsFix->Fields("golesEquipo1") > $rsFix->Fields("golesEquipo2"))
						$pg++;
					else if($rsFix->Fields("golesEquipo1") == $rsFix->Fields("golesEquipo2"))
						$pe++;
					else if($rsFix->Fields("golesEquipo1") < $rsFix->Fields("golesEquipo2"))
						$pp++;
				}
				else
				{
					$gf += $rsFix->Fields("golesEquipo2");
					$gc += $rsFix->Fields("golesEquipo1");
					$tr += $rsFix->Fields("expulsadosEquipo2");
					$ta += $rsFix->Fields("amonestadosEquipo2");

					if($rsFix->Fields("golesEquipo2") > $rsFix->Fields("golesEquipo1"))
						$pg++;
					else if($rsFix->Fields("golesEquipo2") == $rsFix->Fields("golesEquipo1"))
						$pe++;
					else if($rsFix->Fields("golesEquipo2") < $rsFix->Fields("golesEquipo1"))
						$pp++;
				}
			}
			
			$rsFix->moveNext();
		}
		
		//Calculo los puntos segun los pg, pe, pp
		$puntos = ($pg * $puntosPartidoGanado) + ($pe * $puntosPartidoEmpatado);
		
		//Resto los puntos de descuento
		if($rsEq->Fields("descuentoPuntos") != NULL)
			$puntos = $puntos - $rsEq->Fields("descuentoPuntos");

		
		//Inserto la tabla de proceso
		ConectarRS(InsertProcesoPosiciones($sessioId, $rsEq->Fields("id"), $rsEq->Fields("nombre"), $gf, $gc, $ta, $tr, $pg, $pe, $pp, $puntos));
		
		$puntos=0;
		$gf=0;
		$gc=0;
		$pg=0;
		$pe=0;
		$pp=0;
		$tr=0;
		$ta=0;

		$rsEq->moveNext();
	}
		
	return true;
}
?>

<div class="title-box3">
  <div class="left">
    <div class="right">
      <div class="wrapper"> <a href="estadisticas.php" class="link5 fright"> estadísticas</a>
        <h2>Tabla de Posiciones</h2>
      </div>
    </div>
  </div>
</div>
<div class="box3 alt">
  <div class="right-bot-corner">
    <div class="left-bot-corner">
      <div class="inner">
        <table class="league-table">
          <thead>
            <tr>
              <td class="cell-1"></td>
              <td class="cell-2"></td>
              <td class="cell-3">PJ</td>
              <td class="cell-4">PTS</td>
            </tr>
          </thead>
          <tbody>
            <?php GetTablaPosiciones(GetTorneo(), session_id() ); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
