<?php
function TraerEquipoFechaHome()
{

	$rs = ConectarRS(GetEquipoFechaHome(GetTorneo())); 

	if(!$rs->Eof())
	{
		echo sprintf("<img class=\"img-indent\" alt=\"%s\" src=\"admin/uploads/%s\" width=\"110\" height=\"83\" /><div class=\"extra-wrap\"><h6>%s</h6><b>%s</b><br />%s</div>",$rs->Fields("nombreEquipo"),$rs->Fields("fotoPreview"),$rs->Fields("titulo"),$rs->Fields("nombreEquipo"),$rs->Fields("descripcion"));
	}
	else
	{
		echo sprintf("<div class=\"extra-wrap\"><h6>%s</h6><b>%s</b><br />%s</div>","No hay equipo destacado","","");
	}		
}
?>

<div class="border-left">
   <div class="border-right">
	  <div class="inner">
		 <div class="extra-wrap">
		 
		 	<?php TraerEquipoFechaHome(); ?>
			
		 </div>
		 <div class="clear"></div>
	  </div>
   </div>
</div>