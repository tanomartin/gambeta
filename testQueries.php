<style>
.par{float:right;}
.impar{float:left;}
</style>

<?php
	include("includes/queries.php");
	include("includes/claseRecordSet.php");
  	include("includes/conexion.php");
?>

<?php

TraerConfiguracion();
echo "<br />------------------------------------------------------------------<br />";
TraerTorneosHome();
echo "<br />---------------Traer torneos-------------------------------------------------<br />";
TraerTorneos();
echo "<br />------------------------------------------------------------------<br />";
TraerNoticiasHome(1);
echo "<br />---------------------------traer noticias---------------------------------------<br />";
TraerNoticias(1);
echo "<br />------------------------------------------------------------------<br />";
TraerEquipoFechaHome(1);
echo "<br />------------------------------------------------------------------<br />";
TraerJugadorFechaHome(1);
echo "<br />------------------------------------------------------------------<br />";
TraerGoleadoresHome(1);
echo "<br />------------------------------------------------------------------<br />";
TraerEquipos(1);
echo "<br />------------------------------------------------------------------<br />";
/*TraerTablaPosicionesYFairPlayHome(1, '76asd67sd6a7sdas');
echo "<br />------------------------------------------------------------------<br />";*/
TraerReglamentos(1);
echo "<br />------------------------------------------------------------------<br />";
TraerFixture(1);
echo "<br />------------------------------------------------------------------<br />";
TraerFixtureHTML(1);
echo "<br /><br /><br /><br /><br />------------------------------------------------------------------<br />";
TraerFechasEquipoIdeal(1);
echo "<br />------------------------------------------------------------------<br />";
TraerEquipoIdeal(1);
echo "<br />------------------------------------------------------------------<br />";
TraerJugadoresByEquipo(1);
echo "<br />----------------Fotos LIST--------------------------------------------------<br />";
TraerGaleriaFotosList();
echo "<br />------------------------------------------------------------------<br />";
TraerFotosList(1);
echo "<br />------------------------------------------------------------------<br />";
TraerJugadorByUsername("pmolina", "qw");
echo "<br />------------------------------------------------------------------<br />";
TraerPerfilJugador(1);
echo "<br />------------------------------------------------------------------<br />";
ActualizarPerfilById(2, 'qw', '111', '22', '', '44', '55', '66', '77', '88', '89', '100','dasjkdja aksjdak kajs');
echo "<br />------------------------------------------------------------------<br />";


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

function TraerFixtureHTML($torneo)
{
	$rs = ConectarRS(GetFixture($torneo));
	$idFecha = -1;
	$contFilas = 1;
	
	while(!$rs->Eof())
	{
		
		if($idFecha != $rs->Fields("idFecha"))
		{
			//Cierro la tabla despues de cada fecha excepto en la primera
			if($idFecha != -1) echo "</table></div>";
			
			//Asigno el calss de alineacion segun si es un registro para o impar
			if($contFilas%2==0)
				echo "<div class=\"par\"><table width=\"520px\" border = \"1\">";
			else
				echo "<div class=\"impar\"><table width=\"520px\" border = \"1\">";
			
			//Armo la fila header 
			echo "<tr><td align=\"center\" colspan=\"3\">".$rs->Fields("nombreFecha")."</td>";
			echo "<td align=\"center\" colspan=\"3\">".$rs->Fields("fechaInicio")." - ".$rs->Fields("fechaFin")."</td></tr>";
			
			$idFecha = $rs->Fields("idFecha");
			$contFilas++;
		}
		else
		{
			//Cargo el nombre del equipo 1 ya que siempre viene porque es obligatorio
			echo "<tr><td align=\"center\" width=\"140px\">".$rs->Fields("nombreEquipo1")."</td>";
			
			//Goles equipo 1
			if($rs->Fields("golesEquipo1") == NULL)
				echo "<td align=\"center\" width=\"20px\">&nbsp;</td>";
			else
				echo "<td align=\"center\" width=\"20px\">".$rs->Fields("golesEquipo1")."</td>";
			
			//Separador
			echo "<td align=\"center\" width=\"10px\">-</td>";
			
			//Agrego si tiene equipo 2 los goles, el nombre y la hora del partido
			//Si no hubiera equipo 2 (equipo 1 esta libre por esa fecha) marco al equipo 1 como libre
			if($rs->Fields("nombreEquipo2") == NULL)
			{
				echo "<td align=\"center\" width=\"20px\">&nbsp;</td>";
				echo "<td align=\"center\" width=\"140px\">&nbsp;</td>";
				echo "<td>Libre</td>";
			}
			else
			{
				echo "<td align=\"center\" width=\"20px\">".$rs->Fields("golesEquipo2")."</td>";
				echo "<td align=\"center\" width=\"140px\">".$rs->Fields("nombreEquipo2")."</td>";
				
				//Marco el partido como suspendido, si no le asigno la fecha y la hora
				if($rs->Fields("suspendido") == 1)
					echo "<td><table><tr><td>Suspendido</td><td><img src=\"images/info.gif\" border=\"0\" title=\"".$rs->Fields("observaciones")."\" alt=\"".$rs->Fields("observaciones")."\"/></td></tr></table></td>";
				else
					echo "<td>".$rs->Fields("fechaPartido")." - ".$rs->Fields("horaPartido")."</td>";
			}
		}
		
		$rs->moveNext();
	}
	
	//Cierro la ultima tabla y el ultimo div
	echo "</table></div>";
	
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

function TraerNoticias($idTorneo)
{
	$rs = ConectarRS(GetNoticias($idTorneo));
	
	if($rs->EOF())
	{
		echo "No hay registros para mostrar";
		return false;
	}
	else
	{
		while(!$rs->EOF())
		{
			echo $rs->Fields("id")." - ".$rs->Fields("torneo")." - ".$rs->Fields("fecha")." - ".$rs->Fields("titulo")." - ".$rs->Fields("prologo");
			echo "<br />";
			$rs->moveNext();
		}
	}


	return true;
}

function TraerNoticiasHome($idTorneo)
{
	$rs = ConectarRS(GetNoticiasHome($idTorneo));
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

function TraerFechasEquipoIdeal($idTorneo)
{
	$rs = ConectarRS(GetFechasEquipoIdealList($idTorneo));
	if($rs->EOF())
	{
		echo "No hay registros para mostrar";
		return false;
	}
	else
	{
		while(!$rs->EOF())
		{
			echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("fechaInicio")." - ".$rs->Fields("fechaFin");
			echo "<br />";
			$rs->moveNext();
		}
	}

	return true;
}

function TraerEquipoIdeal($idFecha)
{
	$rs = ConectarRS(GetEquipoIdeal($idFecha));
	if($rs->EOF())
	{
		echo "No hay registros para mostrar";
		return false;
	}
		else
	{
		while(!$rs->EOF())
		{
			echo $rs->Fields("idEquipoIdeal")." - ".$rs->Fields("descripcion")." - ".$rs->Fields("fechaNombre")." - ".$rs->Fields("fechaInicio")." - ".$rs->Fields("fechaFin")." - ".$rs->Fields("nombreEquipo")." - ".$rs->Fields("nombreJugador")." - ".$rs->Fields("foto")." - ".$rs->Fields("posicionCancha")." - ".$rs->Fields("idPosicionCancha");

			echo "<br />";
			$rs->moveNext();
		}
	}
	return true;
}

function TraerJugadoresByEquipo($idEquipo)
{
	$rs = ConectarRS(GetJugadoresByEquipo($idEquipo));
	if($rs->EOF())
	{
		echo "No hay registros para mostrar";
		return false;
	}
	else
	{
		while(!$rs->EOF())
		{
			echo $rs->Fields("id")." - ".$rs->Fields("nombreEquipo")." - ".$rs->Fields("fotoEquipo")." - ".$rs->Fields("nombreJugador")." - ".$rs->Fields("fotoJugador");
			echo "<br />";
			$rs->moveNext();
		}
	}

	return true;
}

function TraerGaleriaFotosList()
{
	$rs = ConectarRS(GetGaleriaFotosList());
	if($rs->EOF())
	{
		echo "No hay registros para mostrar";
		return false;
	}
	else
	{
		while(!$rs->EOF())
		{
			echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("imagen")." - ".$rs->Fields("cantidad");
			echo "<br />";
			$rs->moveNext();
		}
	}

	return true;
}

function TraerFotosList($idGaleria)
{
	$rs = ConectarRS(GetFotosList($idGaleria));
	if($rs->EOF())
	{
		echo "No hay registros para mostrar";
		return false;
	}
	else
	{
		while(!$rs->EOF())
		{
			echo $rs->Fields("id")." - ".$rs->Fields("fotoPreview")." - ".$rs->Fields("fotoLarge")." - ".$rs->Fields("esFoto");
			echo "<br />";
			$rs->moveNext();
		}
	}

	return true;
}

function TraerJugadorByUsername($username, $passwd)
{
	$rs = ConectarRS(GetJugadorByUsername($username, $passwd));
	if($rs->EOF())
	{
		echo "No existe el usuario";
		return false;
	}
	else
	{
		echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("username");
	}

	return true;
}

function TraerPerfilJugador($idJugador)
{
	$rs = ConectarRS(GetPerfilJugador($idJugador));
	if($rs->EOF())
	{
		echo "No existe el jugador";
		return false;
	}
	else
	{
		echo $rs->Fields("id")." - ".$rs->Fields("nombre")." - ".$rs->Fields("pregunta1")." - ".$rs->Fields("pregunta2")." - ".$rs->Fields("pregunta3");
	}

	return true;
}

function ActualizarPerfilById($id, $passwd, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8, $pregunta9, $pregunta10, $acerca)
{
	$rs = ConectarRS(UpdatePerfilById($id, $passwd, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8, $pregunta9, $pregunta10, $acerca));
	echo "Perfil actualizado con EXITO";
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
