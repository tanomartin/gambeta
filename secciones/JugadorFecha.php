<?php
function TraerJugadorFechaHome()
{

	$rs = ConectarRS(GetJugadorFechaHome(GetTorneo())); 

	if(!$rs->Eof())
	{
		echo sprintf("<img class=\"img-indent\" alt=\"%s\" src=\"admin/uploads/%s\" /><div class=\"extra-wrap\"><h6>%s</h6><b>%s</b><br />%s</div>",$rs->Fields("nombreJugador"),$rs->Fields("fotoPreview"),$rs->Fields("titulo"),$rs->Fields("nombreJugador"), $rs->Fields("descripcion"));
	}
	else
	{
		echo sprintf("<div class=\"extra-wrap\"><h6>%s</h6><b>%s</b><br />%s</div>","No hay jugador destacado","", "");
	}
		
}
?>

<div class="border-left">
   <div class="border-right">
	  <div class="inner">
		 <div class="extra-wrap">

			<?php TraerJugadorFechaHome(); ?>

		 </div>
		 <div class="clear"></div>
	  </div>
   </div>
</div>

