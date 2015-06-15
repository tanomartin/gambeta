<?
# FUNCIONES FTP

# CONSTANTES
# Cambie estos datos por los de su Servidor FTP
define("SERVER","190.183.59.231"); //IP o Nombre del Servidor
define("PORT",21); //Puerto
define("USER","gambetafemenina"); //Nombre de Usuario
define("PASSWORD","manejar8pera"); //Contraseña de acceso
define("PASV",true); //Activa modo pasivo

# FUNCIONES

function ConectarFTP(){
//Permite conectarse al Servidor FTP
$id_ftp=ftp_connect(SERVER,PORT); //Obtiene un manejador del Servidor FTP
ftp_login($id_ftp,USER,PASSWORD); //Se loguea al Servidor FTP
ftp_pasv($id_ftp,MODO); //Establece el modo de conexión
return $id_ftp; //Devuelve el manejador a la función
}

//Sube archivo de la maquina Cliente al Servidor (Comando PUT)
if(!empty($_FILES["archivo"])){
$file = $_FILES["archivo"]["tmp_name"];
$base_archivo = basename($_FILES["archivo"]["name"]);
$g_archivo =  $base_archivo;
$id_ftp=ConectarFTP();
// check connection
if (!$id_ftp) {
    die("FTP connection has failed !");
}

echo "Current directory: " . ftp_pwd($id_ftp) . "\n";

// try to change the directory to somedir
if (ftp_chdir($id_ftp, "wwwroot/logo1")) {
    echo "Current directory is now: " . ftp_pwd($id_ftp) . "\n";
} else { 
    echo "Couldn't change directory\n";
}


$upload = ftp_put($id_ftp, $g_archivo, $file, FTP_BINARY);
if (!$upload) {
	$status = "Error al guardar: " . $g_archivo;
	} else {
	$status = "Exito al gaurdar: " . $g_archivo;
	}
echo $status;
unset($_FILES["archivo"]);
ftp_quit($id_ftp);
}

?>