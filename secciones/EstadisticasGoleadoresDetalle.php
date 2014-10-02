<?php
function GoleadoresDetalle()
{
	$rs = ConectarRS(GetGoleadoresHome(GetTorneo()));
	
	while(!$rs->Eof())
	{
		echo sprintf("<li %s><a href=\"jugador.php?id=%s\">%s&nbsp;(%s)</a><span class=\"spanGoleadores\">%s</span></li>",GetClassDetalle($i),$rs->Fields("id"),$rs->Fields("nombre"),$rs->Fields("nombreEquipo"),$rs->Fields("goles"));
		$rs->moveNext();
	}

}

function GetClassDetalle($index)
{
	$retVal = "";
	if($index == "5")
	{
		$retVal = "class=\"last\"";
	}
	return $retVal;
}



?>
                           <!-- box3 begin -->
<div class="box3">
                              <div class="right-bot-corner">
                                 <div class="left-bot-corner">
                                    <div class="inner1">
                                      <ul class="list1">
                                       <?php GoleadoresDetalle(); ?>
                                       <!--<li class="last"><a href="#">Newcastle - Chelsea</a><span>15:00</span></li>-->
                                      </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>