<?php
function Goleadores()
{
	$rs = ConectarRS(GetGoleadoresHome(GetTorneo()));
	
	for($i=1; $i < 6; $i++)
	{
		if(!$rs->Eof())
		{
			echo sprintf("<li %s><a href=\"jugador.php?id=%s\">%s</a><span class=\"spanGoleadores\">%s</span></li>",GetClass($i),$rs->Fields("id"),$rs->Fields("nombre"),$rs->Fields("goles")); 
			$rs->moveNext();
		}
		else
		{
			echo sprintf("<li %s><a href=\"#\">%s</a><span class=\"spanGoleadores\">%s</span></li>",GetClass($i),"-",0);
		}
	}

}

function GetClass($index)
{
	$retVal = "";
	if($index == "5")
	{
		$retVal = "class=\"last\"";
	}
	return $retVal;
}



?>
<div class="title-box4">
                              <div class="left">
                                 <div class="right">
                                    <div class="wrapper">
                                       <a href="estadisticas.php" class="link5 fright"> estadísticas</a>
                                      <h2>Goleadoras</h2>
                                   </div>
                                 </div>
                              </div>
                           </div>
                           <!-- title-box4 end -->
                           <!-- box3 begin -->
<div class="box3">
                              <div class="right-bot-corner">
                                 <div class="left-bot-corner">
                                    <div class="inner1">
                                      <ul class="list1">
                                       <?php Goleadores(); ?>
                                       <!--<li class="last"><a href="#">Newcastle - Chelsea</a><span>15:00</span></li>-->
                                      </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>