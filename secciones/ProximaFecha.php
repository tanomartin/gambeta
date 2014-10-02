<?php
function TraerProximaFechaHome()
{

	$rs = ConectarRS(GetProximaFecha(GetTorneo())); 
	$cont = 0;

	if (!$rs->Eof()) $fechaFin = $rs->Fields("fechaFin");
	
	if ($rs->Eof()) 
	{
	echo sprintf("<h6 class=\"alignright\">%s</h6><div class=\"inner\">","&nbsp;");
	echo "<table class=\"league-table\"><tbody>";
	echo sprintf("<tr><td class=\"cell-2\"><a href=\"#\">%s</a></td><td class=\"cell-2\"><a href=\"#\">%s</a></td><td>%s</td><td>%s</td></tr>","No hay fecha disponible.","&nbsp;","&nbsp;","&nbsp;");
	echo "</tbody></table>";
	return false;
	}
	
	while(!$rs->Eof())
	{
		if ($rs->Fields("fechaFin") == $fechaFin)
		{
			if($cont == 0)
			{
				if ($rs->Fields("fechaInicio") == $rs->Fields("fechaFin"))
				{
					echo sprintf("<h6 class=\"alignright\">%s</h6><div class=\"inner\">",$rs->Fields("fechaInicio"));
					/*echo "<table class=\"league-table\"><thead><tr><td class=\"cell-2\" align=\"center\">Equipo #1</td><td class=\"cell-2\" align=\"center\">Equipo #2</td><td class=\"cell-2\" align=\"center\">Fecha</td><td class=\"cell-2\" align=\"center\">Hora</td></tr></thead><tbody>";*/
				}else{
					echo sprintf("<h6 class=\"alignright\">%s - %s</h6><div class=\"inner\">",$rs->Fields("fechaInicio"),$rs->Fields("fechaFin"));
					/*echo "<table class=\"league-table\"><thead><tr><td class=\"cell-2\" align=\"center\">Equipo #1</td><td class=\"cell-2\" align=\"center\">Equipo #2</td><td class=\"cell-2\" align=\"center\">Fecha</td><td class=\"cell-2\" align=\"center\">Hora</td></tr></thead><tbody>";*/
				}
				echo "<table class=\"league-table\"><tbody>";     
			}	
			
			if($rs->Fields("nombreEquipo2") != NULL)
			{
				echo sprintf("<tr><td class=\"cell-2\"><a href=\"#\">%s</a></td><td class=\"cell-2\">-<td><td class=\"cell-2\"><a href=\"#\">%s</a></td><td>%s</td><td>%s</td></tr>",$rs->Fields("nombreEquipo1"),$rs->Fields("nombreEquipo2"),$rs->Fields("fechaPartido"),$rs->Fields("horaPartido") );
			}else{
				echo sprintf("<tr><td class=\"cell-2\"><a href=\"#\">%s</a></td><td class=\"cell-2\"><a href=\"#\">%s</a></td><td>%s</td><td>%s</td></tr>",$rs->Fields("nombreEquipo1"),"&nbsp;","Libre","&nbsp;");
			}
			
		}
		
		$cont++;
		$rs->moveNext();
	}
	
	echo "</tbody></table>";
		
}
?>

<div class="box3">
 <div class="right-bot-corner">
	<div class="left-bot-corner">
	   <div class="inner">

			<?php TraerProximaFechaHome(); ?>

		  </div>
	   </div>
	</div>
 </div>
</div>