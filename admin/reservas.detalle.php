<?	include_once "include/config.inc.php";
	include_once "../model/fechas.php";
	include_once "../model/torneos.categorias.php";
	include_once "../model/reservas.php";

	if(!session_is_registered("usuario")){
		header("Location: index.php");
		exit;
	}
	
	print_r($_POST);print("<br>");
	
	$oReserva = new Reservas();
	$reservas = $oReserva -> getReservaByIdFecha($_POST['id']);
	
	print_r($reservas);print("<br>");
	

	?>
    
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>

<!-- base href="http://www.typolight.org/" -->
<title>Panel de Control</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="Panel de Control.">
<meta name="keywords" content="">
<meta name="robots" content="index,follow">

<? include("encabezado.php"); ?>


<script language="javascript">

	function volver(){
		document.form_alta.accion.value = "volver";		
		document.form_alta.submit();
	}

</script>


</head>

<body id="top" class="home">

<div id="wrapper">

<!-- Header -->

<div id="header">
	<div class="inside">

<? include("top_menu.php"); ?>

<!-- indexer::stop -->
<!--
<div id="search">
<form action="search.html" method="get">
<div class="formbody">
  <label for="keywords" class="invisible">Search</label>
  <input name="keywords" id="keywords" class="text" type="text"><input src="index_archivos/search.png" alt="Search" value="Search" class="submit" type="image">
</div>
</form>
</div>
-->
<!-- indexer::continue -->

<!-- indexer::stop -->
<div id="logo">
	<a href="index.php" title="Volver al incio"><h1> Panel de Control</h1></a>
</div>
<!-- indexer::continue -->

<? include("menu.php");?>

 
	</div>

</div>

<!-- Header -->


<div id="container">

<div id="main">
	
    <div class="inside">

		<? include("path.php"); ?>

		<div class="mod_article block" id="home">

			<div class="ce_text block">

				<div class="mod_listing ce_table listing block" id="partnerlist">
                    <form name="form_alta" id="form_alta" action="<?=$_SERVER['PHP_SELF']?>" method="post"  enctype="multipart/form-data"> 

					<input name="id" id="id"  value="<?=$_POST["id"]?>" type="hidden" />
					<input name="_pag" id="_pag"  value="<?=$_POST["_pag"]?>" type="hidden" />
					<input type="hidden" name="accion" value="guardar" />
					
					<!-- Filtros -->
					<input type="hidden" name="fnombre" value="<?=$_POST["fnombre"]?>" />
					<!-- Fin filtros -->
					
					
					<!-- Parametros menu -->
					<input type="hidden" name="menu" value="<?=$_POST["menu"]?>" />
					<input type="hidden" name="submenu" value="<?=$_POST["submenu"]?>" />
					<input type="hidden" name="pag_submenu" value="<?=$_POST["pag_submenu"]?>" />
					<!--     -->
					
					<input class="submit" type="button" value="Volver" onclick="javascript:volver();" />
					
					</form>

				</div>

			</div>

	</div> 
	<div id="clear"></div>
</div>

</div>

<? include("pie.php")?>


</body>

</html>