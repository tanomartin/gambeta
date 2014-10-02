<?php
function TraerFixture()
{
	$rs = ConectarRS(GetFixture(GetTorneo()));
	$idFecha = -1;
	$contFilas = 1;
	
	while(!$rs->Eof())
	{
		
		if($idFecha != $rs->Fields("idFecha"))
		{
			//Cierro la tabla despues de cada fecha excepto en la primera
			if($idFecha != -1) echo "</table></div></div></div></div></div><!-- box3 end --></div><br />";
			
			echo sprintf("<div><!-- title-box2 begin --><div class=\"title-box2\"><div class=\"left-top-corner\"><div class=\"right-top-corner\"><div class=\"right-bot-corner\"><div class=\"left-bot-corner\"><div class=\"inner\"><div class=\"wrapper\"><h3>%s</h3></div></div></div></div></div></div></div><!-- title-box2 end --><!-- box3 begin --><div class=\"box3\"><div class=\"right-bot-corner\"><div class=\"left-bot-corner\"><div class=\"inner\"><h6 class=\"alignright\">%s - %s</h6><div class=\"inner\"><table class=\"league-table\" width=\"700px\" border = \"1\">", $rs->Fields("nombreFecha"), $rs->Fields("fechaInicio"), $rs->Fields("fechaFin"));

			$idFecha = $rs->Fields("idFecha");
		}
		else
		{
			//Cargo el nombre del equipo 1 ya que siempre viene porque es obligatorio
			echo sprintf("<tr><td class=\"cell-2\" align=\"center\" width=\"260px\"><a href=\"#\">%s</a></td>", $rs->Fields("nombreEquipo1"));
			
			
			//Goles equipo 1
			if($rs->Fields("golesEquipo1") == NULL)
				echo "<td align=\"center\" width=\"20px\">&nbsp;</td>";
			else
				echo sprintf("<td align=\"center\" width=\"20px\">%s</td>", $rs->Fields("golesEquipo1"));
			
			//Separador
			echo "<td align=\"center\" width=\"10px\">-</td>";
			
			//Agrego si tiene equipo 2 los goles, el nombre y la hora del partido
			//Si no hubiera equipo 2 (equipo 1 esta libre por esa fecha) marco al equipo 1 como libre
			if($rs->Fields("nombreEquipo2") == NULL)
			{
				echo "<td align=\"center\" width=\"20px\">&nbsp;</td>";
				echo "<td align=\"center\" width=\"260px\">&nbsp;</td>";
				echo "<td align=\"center\">Libre</td>";
			}
			else
			{
				echo sprintf("<td align=\"center\" width=\"20px\">%s</td>", $rs->Fields("golesEquipo2"));
				echo sprintf("<td class=\"cell-2\" align=\"center\" width=\"260px\"><a href=\"#\">%s</a></td>", $rs->Fields("nombreEquipo2"));
				
				//Marco el partido como suspendido, si no le asigno la fecha y la hora
				if($rs->Fields("suspendido") == 1)
					echo sprintf("<td class=\"cell-1\" align=\"center\"><span style=\"line-height:14px;\">Suspendido <a href=\"#\" ><img src=\"images/info.gif\" title=\"%s\" alt=\"%s\"/></a></span></td>", $rs->Fields("observaciones"), $rs->Fields("observaciones"));
				else
					echo sprintf("<td class=\"cell-1\" align=\"center\">%s - %s</td>", $rs->Fields("fechaPartido"), $rs->Fields("horaPartido"));
			}
		}
		
		$rs->moveNext();
	}
	
	//Cierro la ultima tabla y el ultimo div
	echo "</table></div></div></div></div></div><!-- box3 end --></div>";
	
	return true;
}
?>
<div style="width:100%;">
	<?php TraerFixture(); ?>
</div>
