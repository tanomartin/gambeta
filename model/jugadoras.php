<?PHP
include_once "mysql.class.php";

class Jugadoras {

	var $id;
	var $nombre;
	var $dni;
	var $email;
	var $foto;
	var $fechaNac;
	var $telefono;

	function Jugadoras($id="") {
		if ($id != "") {
			$valores = $this->get($id);
			$this->id = $valores[0]["id"];
			$this->nombre = $valores[0]["nombre"];
			$this->dni = $valores[0]["dni"];
			$this->email = $valores[0]["email"];
			$this->fechaNac = ($valores[0]["fechaNac"])?cambiaf_a_mysql($valores[0]["fechaNac"]):'1980-01-01';
			$this->foto = $valores[0]["foto"];
			$this->telefono = $valores[0]["telefono"];
		}
	}


	function set($valores){
		$this->id = $valores["id"];
		$this->nombre = $valores["nombre"];
		$this->dni = $valores["dni"];
		$this->email = $valores["email"];
		$this->fechaNac = ($valores["fechaNac"])?cambiaf_a_mysql($valores["fechaNac"]):'1980-01-01';
		$this->foto = $valores["foto"];
		$this->telefono =  $valores["telefono"];
	}

	function _setById($id) {
		$aValores = $this->getById($id, ARRAY_A);
		$this->set($aValores);
	}

	function insertar($files) {
		$db = new Db();
		$query = "insert into ga_jugadoras(nombre,dni,email,fechaNac,telefono) values (".
				"'".$this->nombre."',".
				"'".$this->dni."',".
				"'".$this->email."',".
				"'".$this->fechaNac."',".
				"'".$this->telefono."')";
		$this->id = $db->query($query);
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$name = "pre_".$this->id."_".$files['foto']['name'];
			$ruta= "../fotos_jugadoras/".$name;
			move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
			$query = "update ga_jugadoras set foto = '". $name."' where id = ".$this->id ;
			$db->query($query);
		}
		$db->close();
	}

	function eliminar() {
		$db = new Db();
		$query = "delete from ga_jugadoras_equipo where idJugadora = ".$this->id ;
		$db->query($query);
		$query = "delete from ga_jugadoras where id = ".$this->id ;
		$db->query($query);
		$db->close();
	}

	function actualizar($files) {
		$db = new Db();
		$query = "update ga_jugadoras set
		          nombre = '". $this->nombre."',
		          dni = '". $this->dni."',
		          email = '". $this->email."',
		          telefono = '". $this->telefono."',
				  fechaNac = '". $this->fechaNac."'
				  where id = ".$this->id ;
		$db->query($query);
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$name = "pre_".$this->id."_".$files['foto']['name'];
			$ruta= "../fotos_jugadoras/".$name;
			move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
			$query = "update ga_jugadoras set foto = '". $name."' where id = ".$this->id ;
			$db->query($query);
		}
		$db->close();
	}

	function get($id="") {
		$db = new Db();
		$query = "Select j.* from ga_jugadoras j where 1=1 " ;
		if ($id != "") {
			$query .= " and j.id = '$id' ";
		}
		$query .= " order by j.nombre";
		$res = $db->getResults($query, ARRAY_A);
		$db->close();
		return $res;
	}
	
	function getPaginado($filtros, $inicio, $cant, &$total) {
		$db = new Db();
		$query = "Select SQL_CALC_FOUND_ROWS j.* from ga_jugadoras j where 1=1";
		if (trim($filtros["fnombre"]) != "")
			$query.= " and j.nombre like '%".strtoupper($filtros["fnombre"])."%'";
		if (trim($filtros["fdni"]) != "")
			$query.= " and j.dni  like '%".strtoupper($filtros["fdni"])."%'";
		$query.= " order by j.nombre LIMIT $inicio,$cant";
		$datos = $db->getResults($query, ARRAY_A);
		$cant_reg = $db->getResults("SELECT FOUND_ROWS() cant", ARRAY_A);
		$total = ceil( $cant_reg[0]["cant"] / $cant );
		$db->close();
		return $datos;
	}
	
	function getEquiposById($id="") {
		$db = new Db();
		$query = "Select je.id as idJugadoraEquipo,	 
						 j.nombre as nombreJugadora,
      					 e.nombre as nombreEquipo,
       					 t.nombre as torneo,
       					 c.nombrePagina as categoria,
      					 p.nombre as posicion,
      					 je.activa
		        from ga_jugadoras j, 
		        	 ga_jugadoras_equipo je, 
		        	 ga_equipos_torneos et, 
		        	 ga_equipos e, 
		        	 ga_posiciones p, 
		        	 ga_torneos_categorias tc,
		        	 ga_torneos t,
		        	 ga_categorias c
				where j.id = $id and 
					  j.id = je.idJugadora and 
					  je.idPosicion = p.id and 
		              je.idEquipoTorneo = et.id and 
				      et.idEquipo = e.id and
					  et.idTorneoCat = tc.id and
					  tc.id_torneo = t.id and
					  tc.id_categoria = c.id" ;
		$res = $db->getResults($query, ARRAY_A);
		$db->close();
		return $res;
	}
	
	function getJugadoraEquipo($idJugadoraEquipo="") {
		$db = new Db();
		$query = "Select je.id as idJugadoraEquipo,
						 tc.id as idTorneoCat,
						 j.id as idJugadora,
						 e.id as idEquipo,
						 t.id as idTorneo,
						 c.id as idCategoria,
						 p.id as idPosicion,
						 je.activa
				  from  ga_jugadoras j,
						ga_jugadoras_equipo je,
						ga_equipos_torneos et,
						ga_equipos e,
						ga_posiciones p,
						ga_torneos_categorias tc,
						ga_torneos t,
						ga_categorias c
				where 	je.id = $idJugadoraEquipo and
						je.idJugadora = j.id and
						je.idPosicion = p.id and
						je.idEquipoTorneo = et.id and
						et.idEquipo = e.id and
						et.idTorneoCat = tc.id and
						tc.id_torneo = t.id and
						tc.id_categoria = c.id";
		$res = $db->getResults($query, ARRAY_A);
		$db->close();
		return $res;
	}
	
	function insertarequipo($datos){
		$db = new Db();
		if (isset($datos['activo'])) {
			$activo = 1;
		} else {
			$activo = 0;
		}
		$query = "insert into ga_jugadoras_equipo values ('DEFAULT',".
				"'".$datos['id']."',".
				"'".$datos['idEquipoTorneo']."','0','0','0',".
				"'".$datos['idPosicion']."',".
				"'".$activo."')";
		print($query);
		$db->query($query);
		$db->close();
	}
	
	function actualizarequipo($datos){
		$db = new Db();
		if (isset($datos['activo'])) {
			$activo = 1;
		} else {
			$activo = 0;
		}
		$query = "update ga_jugadoras_equipo 
					set idEquipoTorneo = ".$datos['idEquipoTorneo'].", idPosicion = ".$datos['idPosicion'].", activa = ".$activo.
					" where id = ".$datos['idJugadoraEquipo']." and idJugadora = ".$datos['id'];
		$db->query($query);
		$db->close();
	}
	
	function getByEquipo($id="") {
		$db = new Db();
		$query = "Select 
					j.*, e.nombre as equipo, je.id as idJugadoraEquipo, je.activa as activa, je.goles, je.amarillas, je.rojas
				  From 
					ga_jugadoras j, 
					ga_jugadoras_equipo je, 
					ga_equipos_torneos et,
					ga_equipos e
			      Where j.id = je.idJugadora and je.idEquipoTorneo = et.id and et.idEquipo = e.id" ;
		if ($id != "") {
			$query .= " and je.idEquipoTorneo = '$id'";
		}
		$query .= " order by je.idPosicion";
		$res = $db->getResults($query, ARRAY_A);
		$db->close();
		return $res;
	}
	
	function cambiarActiva($idJugadorasEquipos, $activo) {
		$db = new Db();
		$query = "update ga_jugadoras_equipo set activa = ".$activo." where id = ".$idJugadorasEquipos;
		$db->query($query);
		$db->close();
	}
	
	function borrarEquipo($idJugadorasEquipos) {
		$db = new Db();
		$query = "delete from ga_jugadoras_equipo where id = ".$idJugadorasEquipos;
		$db->query($query);
		$db->close();
	}

	function getByFixture($idFixture,$idEquipo) {
		$db = new Db();
		$query = "Select j.*, r.*
				  from ga_jugadoras j left join
				  ga_resultados r
				  on j.id = r.idJugadora
				  where (idFixture = ". $idFixture. " or idFixture is null) and
				 j.idEquipo = ".$idEquipo;
		$query .= " order by j.idPosicion";
		$res = $db->getResults($query, ARRAY_A);
		$db->close();
		return $res;
	}
	
	function updateTarjetasGoles() {
		$db = new Db();
		$query = "update ga_jugadoras set
		          amarillas = amarillas + '". $this->amarillas."',
		          rojas = rojas + '". $this->rojas."',
		          observaciones = '". $this->observaciones."'
				  where id = ".$this->id ;
		$db->query($query);
		$db->close();
	}
}

?>