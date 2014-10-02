<?php 
// Devuelve la lista de torneos para el home. 
function GetTorneosHome()
{
	return 		"SELECT 
					id, 
					nombre 
				FROM 
					torneos 
				WHERE 
					activo = 1 
				ORDER BY 
					orden";
}

// Devuelve la lista de torneos. 
function GetTorneos()
{
	return 		"SELECT 
					id, 
					nombre, 
					DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio, 
					DATE_FORMAT(fechaFin,'%d/%m/%Y') as fechaFin 
				FROM 
					torneos 
				WHERE 
					activo = 1 
				ORDER BY 
					orden";
}

// Devuelve la lista de noticias para el home. 
function GetNoticiasHome($idTorneo)
{
	return 		"SELECT 
					N.id, 
					T.nombre AS torneo, 
					DATE_FORMAT(N.fecha,'%d/%m/%Y') as fecha, 
					N.titulo, 
					N.prologo
				FROM 
					noticias N
					LEFT JOIN torneos T ON N.idTorneo = T.id
				WHERE 
					N.mostrarHome = 1 
					AND N.activo = 1
					AND (N.idTorneo = $idTorneo OR ISNULL(N.idTorneo))
				ORDER BY 
					N.fecha DESC";
}

// Devuelve la lista de noticias. 
function GetNoticias($idTorneo)
{
	return 		"SELECT 
					N.id, 
					T.nombre AS torneo, 
					DATE_FORMAT(N.fecha,'%d/%m/%Y') as fecha, 
					N.titulo,
					N.prologo,
					N.cuerpo,
					N.fotoPreview,
					N.fotoLarge
				FROM 
					noticias N
					LEFT JOIN torneos T ON N.idTorneo = T.id
				WHERE 
					N.mostrarHome = 1 
					AND N.activo = 1
					AND (N.idTorneo = $idTorneo OR ISNULL(N.idTorneo))
				ORDER BY 
					N.fecha DESC";
}

// Devuelve una noticia por id
function Noticias_GetOne($idNoticia)
{
	return 		"SELECT 
					N.id, 
					T.nombre AS torneo, 
					DATE_FORMAT(N.fecha,'%d/%m/%Y') as fecha, 
					N.titulo,
					N.prologo,
					N.cuerpo,
					N.fotoPreview,
					N.fotoLarge
				FROM 
					noticias N
					LEFT JOIN torneos T ON N.idTorneo = T.id
				WHERE 
				    N.id = " . $idNoticia
					. " AND N.activo = 1";

}

// Devuelve el equipo de la fehca para el home. 
function GetEquipoFechaHome($idTorneo)
{
	return 		"SELECT 
					FE.id, 
					F.nombre AS nombreFecha,
					DATE_FORMAT(F.fechaInicio,'%d/%m/%Y') as fechaInicio, 
					DATE_FORMAT(F.fechaFin,'%d/%m/%Y') as fechaFin, 
					E.nombre AS nombreEquipo,
					E.fotoPreview, 
					FE.titulo,
					FE.descripcion
				FROM 
					fechaequipo FE
					INNER JOIN fechas F ON FE.idFecha = F.id AND F.idTorneo = ".$idTorneo."
					INNER JOIN equipos E ON FE.idEquipo = E.id AND E.idTorneo = ".$idTorneo."
				ORDER BY 
					F.fechaFin DESC
				LIMIT 1
			";
}


// Devuelve el jugador de la fehca para el home. 
function GetJugadorFechaHome($idTorneo)
{
	return 		"SELECT 
					FJ.id, 
					F.nombre AS nombreFecha,
					DATE_FORMAT(F.fechaInicio,'%d/%m/%Y') as fechaInicio, 
					DATE_FORMAT(F.fechaFin,'%d/%m/%Y') as fechaFin, 
					E.nombre AS nombreEquipo,
					J.nombre AS nombreJugador,
					J.fotoPreview, 
					FJ.titulo,
					FJ.descripcion
				FROM
				fechajugador FJ
					INNER JOIN fechas F ON FJ.idFecha = F.id AND F.idTorneo = ".$idTorneo."
					INNER JOIN equipos E ON FJ.idEquipo = E.id AND E.idTorneo = ".$idTorneo."
					INNER JOIN jugadores J ON E.id = J.idEquipo AND FJ.idJugador = J.id AND E.idTorneo = ".$idTorneo."
				ORDER BY 
					F.fechaFin DESC
				LIMIT 1";
}

// Devuelve la lista de goleadores para el home. 
function GetGoleadoresHome($idTorneo)
{
	return 		"SELECT 
					J.id, 
					J.nombre,
					J.goles,
					E.nombre AS nombreEquipo
				FROM 
					jugadores J
					INNER JOIN equipos E ON J.idEquipo = E.id AND E.idTorneo = ".$idTorneo."
				ORDER BY 
					goles DESC, nombre ASC
				LIMIT 10";
}

// Devuelve la configuracion 
function GetGonfiguracion()
{
	return 		"SELECT 
					*
				FROM 
					configuracion";
}

// Devuelve la lista de equipos por torneo 
function GetEquipos($idTorneo)
{
	return 		"SELECT 
					*
				FROM 
					equipos 
				WHERE 
					idTorneo = ".$idTorneo;
}

// Devuelve la lista de fechas por equipo
function GetListaFechas($idTorneo, $idEquipo)
{

	return 		"SELECT 
				FI.id,
				FI.idFecha,
				FI.idEquipo1,
				E1.nombre AS nombreEquipo1,
				FI.golesEquipo1,
				FI.amonestadosEquipo1,
				Fi.expulsadosEquipo1,
				FI.idEquipo2,
				E2.nombre AS nombreEquipo2,
				FI.amonestadosEquipo2,
				Fi.expulsadosEquipo2,
				FI.golesEquipo2,
				FI.fechaPartido,
				1 AS indicador
		FROM 
				fixture FI
				INNER JOIN fechas F ON FI.idFecha = F.id AND F.idTorneo = ".$idTorneo."
				LEFT JOIN equipos E1 ON FI.idEquipo1 = E1.id AND E1.idTorneo = ".$idTorneo."
				LEFT JOIN equipos E2 ON FI.idEquipo2 = E2.id AND E2.idTorneo = ".$idTorneo."
		WHERE 
				FI.idEquipo1 = ".$idEquipo."
				AND fechaPartido <= CURDATE()
		UNION
		SELECT 
				FI.id,
				FI.idFecha,
				FI.idEquipo1,
				E1.nombre AS nombreEquipo1,
				FI.golesEquipo1,
				FI.amonestadosEquipo1,
				Fi.expulsadosEquipo1,
				FI.idEquipo2,
				E2.nombre AS nombreEquipo2,
				FI.amonestadosEquipo2,
				Fi.expulsadosEquipo2,
				FI.golesEquipo2,
				FI.fechaPartido,
				2 AS indicador
		FROM 
				fixture FI
				INNER JOIN fechas F ON FI.idFecha = F.id AND F.idTorneo = ".$idTorneo."
				LEFT JOIN equipos E1 ON FI.idEquipo1 = E1.id AND E1.idTorneo = ".$idTorneo."
				LEFT JOIN equipos E2 ON FI.idEquipo2 = E2.id AND E2.idTorneo = ".$idTorneo."
		WHERE 
				FI.idEquipo2 = ".$idEquipo."
				AND fechaPartido <= CURDATE()
		ORDER BY
				fechaPartido";
}

// Elimina registros de la tabla de proceso de posiciones
function DeleteProcesoPosiciones($sessioId)
{
	return 		"DELETE FROM 
					procesoPosiciones";
				//"WHERE sessionId = '".$sessioId."'";
}

// Inserta registros de la tabla de proceso de posiciones
function InsertProcesoPosiciones($sessioId, $idEquipo, $nombre, $gf, $gc, $ta, $tr, $pg, $pe, $pp, $puntos)
{
	return 		"INSERT INTO procesoPosiciones
					(sessionId, id, nombre, gf, gc, ta, tr, pg, pe, pp, puntos) VALUES
					('$sessioId', $idEquipo, '$nombre', $gf, $gc, $ta, $tr, $pg, $pe, $pp, $puntos)";
}

// Devuelve los registros de la tabla de proceso de posiciones
function GetProcesoPosicionesHome($sessioId)
{
	return 		"SELECT 
					sessionId,
					id,
					nombre,
					gf,
					gc,
					ta,
					tr,
					pg,
					pe,
					pp,
					puntos,
					pg + pe + pp AS pj,
					gf-gc AS orden
				FROM 
					procesoPosiciones
				WHERE 
					sessionId = '".$sessioId."'
				ORDER BY
					puntos desc, orden desc, nombre";
					//gf desc, gc
}

// Devuelve la lista de fechas por torneo 
function GetFechas($idTorneo)
{
	return 		"SELECT 
					*
				FROM 
					fechas 
				WHERE 
					idTorneo = ".$idTorneo;
}

// Devuelve el fixture por torneo 
function GetFixture($idTorneo)
{
	return 		"SELECT
					FI.id,
					F.id AS idFecha,
					DATE_FORMAT(F.fechaInicio,'%d/%m/%Y') AS fechaInicio,
					DATE_FORMAT(F.fechaFin,'%d/%m/%Y') AS fechaFin,
					F.nombre AS nombreFecha, 
					DATE_FORMAT(FI.fechaPartido,'%d/%m/%Y') AS fechaPartido,
					FI.horaPartido,
					E1.id AS idEquipo1,
					E1.nombre AS nombreEquipo1,
					FI.golesEquipo1,
					E2.id AS idEquipo2,
					E2.nombre AS nombreEquipo2,
					FI.golesEquipo2,
					FI.suspendido,
					FI.observaciones
				FROM 
					fixture FI
					INNER JOIN fechas F ON FI.idFecha = F.id AND F.idTorneo = ".$idTorneo."
					LEFT JOIN equipos E1 ON FI.idEquipo1 = E1.id AND E1.idTorneo = ".$idTorneo."
					LEFT JOIN equipos E2 ON FI.idEquipo2 = E2.id AND E2.idTorneo = ".$idTorneo."
				ORDER BY
					F.fechaInicio, FI.fechaPartido, FI.horaPartido";
}

// Devuelve la proxima fecha 
function GetProximaFecha($idTorneo)
{
	return 		"SELECT
					FI.id,
					F.id AS idFecha,
					DATE_FORMAT(F.fechaInicio,'%d/%m/%Y') AS fechaInicio,
					DATE_FORMAT(F.fechaFin,'%d/%m/%Y') AS fechaFin,
					F.nombre AS nombreFecha, 
					DATE_FORMAT(FI.fechaPartido,'%d/%m/%Y') AS fechaPartido,
					FI.horaPartido,
					E1.nombre AS nombreEquipo1,
					FI.golesEquipo1,
					E2.nombre AS nombreEquipo2,
					FI.golesEquipo2,
					FI.suspendido,
					FI.observaciones
				FROM 
					fixture FI
					INNER JOIN fechas F ON FI.idFecha = F.id AND F.idTorneo = ".$idTorneo."
					LEFT JOIN equipos E1 ON FI.idEquipo1 = E1.id AND E1.idTorneo = ".$idTorneo."
					LEFT JOIN equipos E2 ON FI.idEquipo2 = E2.id AND E2.idTorneo = ".$idTorneo."
				WHERE 
					F.FechaFin >= CURDATE()
				ORDER BY
					F.fechaFin, FI.fechaPartido, FI.horaPartido";
}

// Devuelve el reglamento 
function GetReglamentos($idTorneo)
{
	return 		"SELECT 
					*
				FROM 
					reglamentos 
				WHERE 
					idTorneo = ".$idTorneo;
}

// Devuelve el query de la lista la fechas 
function GetFechasEquipoIdealList($idTorneo)
{

	return 		"SELECT DISTINCT
					F.id,
					F.nombre,
					DATE_FORMAT(F.fechaInicio,'%d/%m/%Y') AS fechaInicio,
					DATE_FORMAT(F.fechaFin,'%d/%m/%Y') AS fechaFin
				FROM 
					fechas F 
					INNER JOIN equipoidealfecha EIF ON F.id = EIF.idFecha
				WHERE
					F.idTorneo = $idTorneo
					AND F.fechaInicio < CURDATE()
				ORDER BY
					F.fechaInicio, F.fechaFin";

}

// Devuelve el query del equipo ideal de la fecha 
function GetEquipoIdeal($idFecha)
{
		return 	"SELECT 
					EIF.id AS idEquipoIdeal,
					EIF.descripcion,
					F.nombre AS fechaNombre,
					F.fechaInicio,
					F.fechaFin,
					E.id AS idEquipo,
					E.nombre AS nombreEquipo,
					J.id AS idJugador,
					J.nombre AS nombreJugador,
					J.fotoPreview AS foto,
					PC.descripcion AS posicionCancha,
					PC.id AS idPosicionCancha
				FROM 
					equipoidealfecha EIF
					INNER JOIN equipos E ON EIF.idEquipo = E.id
					INNER JOIN jugadores J ON EIF.idJugador = J.id
					INNER JOIN posicionescancha PC ON EIF.idPosicionCancha = PC.id
					INNER JOIN fechas F ON EIF.idFecha = F.id AND F.id = $idFecha
				ORDER BY
					PC.id";
}

// Devuelve el query de los jugadores de un equipo por ID
function GetJugadoresByEquipo($idEquipo)
{
		return 	"SELECT 
					J.id,
					E.nombre AS nombreEquipo,
					E.descripcion AS descripcionEquipo,
					E.fotoPreview AS fotoEquipo,
					J.nombre AS nombreJugador,
					J.fotoPreview AS fotoJugador
				FROM 
					equipos E 
					LEFT JOIN jugadores J ON J.idEquipo = E.id 
				WHERE
					E.id = $idEquipo
				ORDER BY
					J.nombre";
}

// Devuelve el query de las galerias de fotos ordenadas por el campo orden
function GetGaleriaFotosList()
{
		return 	"SELECT 
					GF.id,
					GF.nombre,
					GF.imagen,
					(SELECT COUNT(id) FROM Fotos F WHERE GF.id = F.idGaleriaFoto) AS cantidad
				FROM 
					galeriafotos GF
				ORDER BY
					GF.orden";
}

// Devuelve el query de fotos a traves del ID de una galeria de fotos
function GetFotosList($idGaleria)
{
		return 	"SELECT 
					*
				FROM 
					fotos
				WHERE 
					idGaleriaFoto = $idGaleria";
}

// Devuelve el query de login de los jugadores
function GetJugadorByUsername($username, $passwd)
{
		return 	"SELECT 
					id,
					nombre,
					username
				FROM 
					jugadores
				WHERE 
					username = '$username'
					AND passwd = '$passwd'";
}

// Devuelve el query del perfil de un jugador
function GetPerfilJugador($idJugador)
{
		return 	"SELECT 
					*
				FROM 
					jugadores
				WHERE 
					id = $idJugador";
}

// Devuelve el query de una fecha particular
function GetFechaById($idFecha)
{
		return 	"SELECT 
					id,
					nombre,
					DATE_FORMAT(fechaInicio,'%d/%m/%Y') AS fechaInicio,
					DATE_FORMAT(fechaFin,'%d/%m/%Y') AS fechaFin
				FROM 
					fechas
				WHERE 
					id = $idFecha";
}

// Devuelve el query de la ultima fecha del torneo
function GetUltimaFechaByTorneo($idTorneo)
{

	return 		"SELECT DISTINCT
					F.id,
					F.nombre,
					DATE_FORMAT(F.fechaInicio,'%d/%m/%Y') AS fechaInicio,
					DATE_FORMAT(F.fechaFin,'%d/%m/%Y') AS fechaFin
				FROM 
					fechas F 
					INNER JOIN equipoidealfecha EIF ON F.id = EIF.idFecha
				WHERE
					F.idTorneo = $idTorneo
					AND F.fechaInicio < CURDATE()
				ORDER BY
					F.fechaInicio DESC
				LIMIT 1";

}

// Devuelve el query para obtener los datos de un jugador por id
function GetJugadorById($id)
{

	return 		"SELECT 
					*
				FROM 
					jugadores
				WHERE
					id = $id";

}

// Devuelve el query para acutalizar el perfil de un jugador por id
function UpdatePerfilById($id, $passwd, $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5, $pregunta6, $pregunta7, $pregunta8, $pregunta9, $pregunta10, $acerca)
{
	$sql = "";
	
	if($passwd == NULL || $passwd == '')
	{
		$sql = 		"UPDATE 
						jugadores 
					SET
						pregunta1 = '$pregunta1',
						pregunta2 = '$pregunta2',
						pregunta3 = '$pregunta3',
						pregunta4 = '$pregunta4',
						pregunta5 = '$pregunta5',
						pregunta6 = '$pregunta6',
						pregunta7 = '$pregunta7',
						pregunta8 = '$pregunta8',
						pregunta9 = '$pregunta9',
						pregunta10 = '$pregunta10',
						acercaMio = '$acerca'
					WHERE
						id = $id";
	}
	else
	{
		$sql = 		"UPDATE 
						jugadores 
					SET
						passwd = '$passwd',
						pregunta1 = '$pregunta1',
						pregunta2 = '$pregunta2',
						pregunta3 = '$pregunta3',
						pregunta4 = '$pregunta4',
						pregunta5 = '$pregunta5',
						pregunta6 = '$pregunta6',
						pregunta7 = '$pregunta7',
						pregunta8 = '$pregunta8',
						pregunta9 = '$pregunta9',
						pregunta10 = '$pregunta10',
						acercaMio = '$acerca'
					WHERE
						id = $id";
	}
		
	return $sql;
}


?>