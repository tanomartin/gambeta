<? 
	function Conectar()
	{
	    
		$host = "localhost:3307";
	    $user = "gambeta";
	    $password = "Camarera";
		$db = "gambeta";
		
		
		
	  /*  $host = "localhost:3306";
	    $user = "root";
	    $password = "qw";
		$db = "torneofutbol";*/
	   
	    $oConn = mysql_connect($host, $user, $password)
	    or die("Error conectando a la base de datos.");
	    mysql_select_db($db,$oConn)
	    or die("Error seleccionando la base de datos.");
	    return $oConn;
   }
?>