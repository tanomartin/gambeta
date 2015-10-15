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
		$query = "Select j.*, e.nombre as equipo
				  from ga_jugadoras j, ga_equipos e
				  where j.idEquipo = e.id " ;
		if ($id != "") {
			$query .= " and j.id = '$id' ";
		}
		$query .= " order by j.nombre";
		$res = $db->getResults($query, ARRAY_A);
		$db->close();
		return $res;
	}

	function getByEquipo($id="") {
		$db = new Db();
		$query = "Select j.*, e.nombre as equipo
				  from ga_jugadoras j, ga_equipos e
				  where j.idEquipo = e.id " ;
		if ($id != "") {
			$query .= " and e.id = '$id' ";
		}
		$query .= " order by j.idPosicion";
		$res = $db->getResults($query, ARRAY_A);
		$db->close();
		return $res;
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
	
	function getPaginado($filtros, $inicio, $cant, &$total) {
		$orden = ($filtros["filter_order"])?$filtros["filter_order"]:"e.id";
		$dir = ($filtros["filter_order_Dir"])?$filtros["filter_order_Dir"]:"asc";
		$db = new Db();
		$query = "Select SQL_CALC_FOUND_ROWS  j.*, e.nombre as equipo, p.nombre as posicion
		          from ga_jugadoras j, ga_jugadoras_equipo je, ga_equipos e, ga_posiciones p
				  where j.id = je.idJugadora and je.idEquipo = e.id and je.idPosicion = p.id ";
		if (trim($filtros["fnombre"]) != "")
			$query.= " and j.nombre like '%".strtoupper($filtros["fnombre"])."%'";
		if (trim($filtros["fequipo"]) != "")
			$query.= " and  e.nombre  like '%".strtoupper($filtros["fequipo"])."%'";
		$query.= " order by  $orden $dir LIMIT $inicio,$cant";
		$datos = $db->getResults($query, ARRAY_A);
		$cant_reg = $db->getResults("SELECT FOUND_ROWS() cant", ARRAY_A);
		$total = ceil( $cant_reg[0]["cant"] / $cant );
		$db->close();
		return $datos;
	}


	function updateTarjetas() {
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