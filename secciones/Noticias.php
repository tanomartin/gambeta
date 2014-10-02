<?php
function TruncatePrologo($texto)
{
	$cantidaDePalabras = 8;
	$retVal = $texto;
	
    $aux = explode(' ',$texto);
    if(count($aux) > $cantidaDePalabras && $cantidaDePalabras > 0)
	{
      $retVal = implode(' ',array_slice($aux, 0, $cantidaDePalabras)).'...' ; 
	}
	
	return $retVal;
}

function TraerNoticiasHome()
{

	$rs = ConectarRS(GetNoticiasHome(GetTorneo())); 

	for($i=1; $i<4;$i++)
	{
		
			
		if(!$rs->Eof())
		{
			$torneo = "";
		if($rs->Fields("torneo"))
			$torneo = " - ".$rs->Fields("torneo");
			
			echo sprintf("<dt>%s%s - %s</dt><dd><a href=\"LeerNoticia.php?nid=%s\">%s&nbsp;<img alt=\"\" src=\"images/marker.gif\" /></a></dd>",$rs->Fields("fecha"),$torneo,$rs->Fields("titulo"),$rs->Fields("Id"),TruncatePrologo($rs->Fields("prologo")));
		}
		
		$rs->moveNext();
		
	}
}
?>
<div class="box">
                <div class="border-bot">
                  <div class="left-top-corner">
                    <div class="right-top-corner">
                      <div class="right-bot-corner">
                        <div class="left-bot-corner">
                          <div class="inner">
                            <div class="wrapper">
                              <div class="extra-wrap">
	<h4>Noticias</h4>
    <dl class="news">
		<?php TraerNoticiasHome(); ?>
	</dl>
</div>
                              <div align="center">
							  	<img src="images/big-banner.jpg" alt="" class="fleft" />                              
							 </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              
