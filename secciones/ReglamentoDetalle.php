<?php
function TraerReglamentoDetalle()
{

	$rs = ConectarRS(GetReglamentos(GetTorneo())); 

	if(!$rs->Eof())
	{
		echo sprintf("<h6>%s</h6>%s",$rs->Fields("titulo"),$rs->Fields("descripcion"));
	}
		
}
?>


<div class="box2">
	<div class="left-top-corner">
	   <div class="right-top-corner">
		  <div class="border-top"></div>
	   </div>
	</div>
	<div class="border-left">
	   <div class="border-right">
		  <div class="inner">
			 
			 <div class="extra-wrap">
				
				<?php TraerReglamentoDetalle(); ?>
				
				<div class="wrapper"></div>
			</div>
			 <div class="clear"></div>
		  </div>
	   </div>
	</div>
	<div class="left-bot-corner">
	   <div class="right-bot-corner">
		  <div class="border-bot"></div>
	   </div>
	</div>
 </div>