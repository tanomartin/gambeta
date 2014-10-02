<?php
	include("includes/queries.php");
	include("includes/claseRecordSet.php");
  	include("includes/conexion.php");
?>
<?php

TraerConfiguracion();
echo "<br /><br />";
TraerTorneosHome();
echo "<br /><br />";
TraerTorneos();
echo "<br /><br />";
TraerNoticiasHome();
echo "<br /><br />";
TraerNoticias();
echo "<br /><br />";
TraerEquipoFechaHome(1);
echo "<br /><br />";
TraerJugadorFechaHome(1);
echo "<br /><br />";
TraerGoleadoresHome(1);
echo "<br /><br />";
TraerEquipos(1);
echo "<br /><br />";
TraerTablaPosicionesYFairPlayHome(1, '76asd67sd6a7sdas');
echo "<br /><br />";
TraerFixture(1);
echo "<br /><br />";
TraerReglamentos(1);
echo "<br /><br />";

echo "<br /><br />....";


function TraerReglamentos($torneo)
{
	$rs = ConectarRS(GetReglamentos($torneo));

	while(!$rs->Eof())
	{
		echo $rs->Fields("id")." - ".$rs->Fields("titulo")." - ".$rs->Fields("descripcion")."<br />";
		$rs->moveNext();
	}
	
	return true;
}

function TraerFixture($torneo)
{
	$rs = ConectarRS(GetFixture($torneo));

	while(!$rs->Eof())
	{
		echo $rs->Fields("idFecha")." - ".$rs->Fields("fechaInicio")." - ".$rs->Fields("fechaFin")." - ".$rs->Fields("nombreFecha")." - ".$rs->Fields("fechaPartido")." - ".$rs->Fields("horaPartido")." - ".$rs->Fields("nombreEquipo1")." - ".$rs->Fields("golesEquipo1")." - ".$rs->Fields("nombreEquipo2")." - ".$rs->Fields("golesEquipo2")."<br />";
		$rs->moveNext();
	}
	
	return true;
}

function TraerTablaPosicionesYFairPlayHome($torneo, $sessioId)
{
	//Inserto registros en la tabla de posiciones
	LlenarTablaPosiciones($torneo, $sessioId);

	//Obtengo lista de posiciones
	$rs = ConectarRS(GetProcesoPosicionesHome($sessioId));

	while(!$rs->Eof())
	{
		echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("gf")." - ".$rs->Fields("gc")." - ".$rs->Fields("ta")." - ".$rs->Fields("tr")." - ".$rs->Fields("pg")." - ".$rs->Fields("pe")." - ".$rs->Fields("pp")." - ".$rs->Fields("puntos")." - ".$rs->Fields("pj")."<br />";
		$rs->moveNext();
	}
	
	echo "<br /><br />";
	
	//Obtengo el equipo fairplay
	$rsFP = ConectarRS(GetEquipoFairPlayHome($sessioId));

	while(!$rsFP->Eof())
	{
		echo $rsFP->Fields("id")." - ".$rsFP->Fields("nombre")." - ".$rsFP->Fields("puntosFP")." - ".$rsFP->Fields("fecha")."<br />";
		$rsFP->moveNext();
	}
	
	//Vacio la tabla de proceso
	ConectarRS(DeleteProcesoPosiciones($sessioId));

	return true;
}

function LlenarTablaPosiciones($torneo, $sessioId)
{
	$puntosPartidoGanado = 0;
	$puntosPartidoEmpatado = 0;
	$puntosTR = 0;
	$puntosTA = 0;
	$puntosFP = 0;
	$puntos = 0;
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
		$puntosTR = $rsConfig->Fields("puntosTarjetaRoja");
		$puntosTA = $rsConfig->Fields("puntosTarjetaAmarilla");
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
		$puntos = ($pg * $puntosPartidoGanado) - ($pe * $puntosPartidoPerdido);
		
		//Calculo los puntos de fairplay
		$puntosFP = ($tr * $puntosTR) + ($ta * $puntosTA);
		
		//Resto los puntos de descuento
		if($rsEq->Fields("descuentoPuntos") != NULL)
			$puntos = $puntos - $rsEq->Fields("descuentoPuntos");
		
		//Inserto la tabla de proceso
		ConectarRS(InsertProcesoPosiciones($sessioId, $rsEq->Fields("id"), $rsEq->Fields("nombre"), $gf, $gc, $ta, $tr, $pg, $pe, $pp, $puntos, $puntosFP));
		
		//Limpio variables para el proceso del registro siguiente
		$puntosFP = 0;
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

function TraerEquipos($torneo)
{
	$rs = ConectarRS(GetEquipos($torneo));

	while(!$rs->Eof())
	{
		echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("descuentoPuntos")."<br />";
		$rs->moveNext();
	}
	
	return true;
}

function TraerGoleadoresHome($torneo)
{
	$rs = ConectarRS(GetGoleadoresHome($torneo));

	while(!$rs->Eof())
	{
		echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("goles")."<br />";
		$rs->moveNext();
	}
	
	return true;
}

function TraerJugadorFechaHome($torneo)
{
	$rs = ConectarRS(GetJugadorFechaHome($torneo));
	echo $rs->Fields("id")." - ".$rs->Fields("nombreFecha")." - ".$rs->Fields("fechaInicio")." - ".$rs->Fields("fechaFin")." - ".$rs->Fields("nombreEquipo")." - ".$rs->Fields("nombreJugador")." - ".$rs->Fields("titulo");
	return true;
}

function TraerEquipoFechaHome($torneo)
{
	$rs = ConectarRS(GetEquipoFechaHome($torneo));
	echo $rs->Fields("id")." - ".$rs->Fields("nombreFecha")." - ".$rs->Fields("fechaInicio")." - ".$rs->Fields("fechaFin")." - ".$rs->Fields("nombreEquipo")." - ".$rs->Fields("titulo");
	return true;
}

function TraerNoticias()
{
	$rs = ConectarRS(GetNoticias());
	echo $rs->Fields("id")." - ".$rs->Fields("torneo")." - ".$rs->Fields("fecha")." - ".$rs->Fields("titulo")." - ".$rs->Fields("prologo");
	return true;
}

function TraerNoticiasHome()
{
	$rs = ConectarRS(GetNoticiasHome());
	echo $rs->Fields("id")." - ".$rs->Fields("torneo")." - ".$rs->Fields("fecha")." - ".$rs->Fields("titulo");
	return true;
}

function TraerTorneosHome()
{
	$rs = ConectarRS(GetTorneosHome());
	echo $rs->Fields("id")." - ".$rs->Fields("nombre");
	return true;
}

function TraerTorneos()
{
	$rs = ConectarRS(GetTorneos());
	echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("fechaInicio")." - ".$rs->Fields("fechaFin");
	return true;
}

function TraerConfiguracion()
{
	$rs = ConectarRS(GetGonfiguracion());
	echo $rs->Fields("id")." - ".$rs->Fields("mailContacto")." - ".$rs->Fields("puntosPartidoGanado")." - ".$rs->Fields("puntosPartidoEmpatado")." - ".$rs->Fields("puntosTarjetaRoja")." - ".$rs->Fields("puntosTarjetaAmarilla");
	return true;
}


function ConectarRS($sql)
{
	$rs = new RecordSet();
	$con = Conectar();
	$rs->Open($sql, $con);
	return $rs;
}

?>
