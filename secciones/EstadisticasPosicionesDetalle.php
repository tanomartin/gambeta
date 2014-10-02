<?php
function GetTablaPosicionesDetalle($torneo, $sessioId)
{

	//Vacio la tabla de proceso
	ConectarRS(DeleteProcesoPosiciones($sessioId));
	
	LlenarTablaPosicionesDetalle($torneo, $sessioId);
	$rs = ConectarRS(GetProcesoPosicionesHome($sessioId)); 
	$i = 1;

	while(!$rs->Eof())
	{
		echo sprintf("<tr><td class=\"cell-1\">%s</td><td class=\"cell-2\"><a href=\"equipo.php?id=%s\">%s</a></td><td class=\"cell-3\">%s</td>
		
		
		
		<td class=\"cell-3\">%s</td>
		<td class=\"cell-3\">%s</td>
		<td class=\"cell-3\">%s</td>
		<td class=\"cell-3\">%s</td>
		<td class=\"cell-3\">%s</td>
		<td class=\"cell-3\">%s</td>
		<td class=\"cell-3\">%s</td>
		
		<td class=\"cell-4\">%s</td></tr>",$i,$rs->Fields("id"),$rs->Fields("nombre"),$rs->Fields("pj")
		
		,$rs->Fields("pg")
		,$rs->Fields("pe")
		,$rs->Fields("pp")
		,$rs->Fields("gf")
		,$rs->Fields("gc")
		,$rs->Fields("ta")
		,$rs->Fields("tr")
		
		
		,$rs->Fields("puntos"));

		$rs->moveNext();
		$i++;
	}
	
/*	//Vacio la tabla de proceso
	ConectarRS(DeleteProcesoPosiciones($sessioId));*/
}

function LlenarTablaPosicionesDetalle($torneo, $sessioId)
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


<div class="box3">
                              <div class="right-bot-corner">
                                 <div class="left-bot-corner">
                                    <div class="inner1">

        <table class="league-table">
          <thead>
            <tr>
              <td class="cell-1"></td>
              <td class="cell-2"></td>
              <td class="cell-3">PJ</td>
              <td class="cell-3">PG</td>
              <td class="cell-3">PE</td>
              <td class="cell-3">PP</td>
              <td class="cell-3">GF</td>
              <td class="cell-3">GC</td>
              <td class="cell-3">TA</td>
              <td class="cell-3">TR</td>
              <td class="cell-4">PTS</td>
            </tr>
          </thead>
          <tbody>
            <?php GetTablaPosicionesDetalle(GetTorneo(), session_id() ); ?>
          </tbody>
        </table>

                                    </div>
                                 </div>
                              </div>
                           </div>