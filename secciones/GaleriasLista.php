<?php
function TraerGaleriasLista()
{

	$rs = ConectarRS(GetGaleriaFotosList()); 

	while(!$rs->Eof())
	{
		if(!$rs->Fields("imagen"))
		{
			echo "<div class=\"noticiaBox\" ><a href=\"MostrarRecursos.php?id=".$rs->Fields("id")."\">".$rs->Fields("nombre")." <br />".$rs->Fields("cantidad")." recursos</a></div>";
		}
		else
		{
			echo "<div class=\"noticiaBox\" ><a href=\"MostrarRecursos.php?id=".$rs->Fields("id")."\"><img src=\"admin/uploads/".$rs->Fields("imagen")."\" width=\"55\" border=\"0\" height=\"55\" alt=\"\" /></a><a href=\"MostrarRecursos.php?id=".$rs->Fields("id")."\">".$rs->Fields("nombre")." <br />".$rs->Fields("cantidad")." recursos</a></div>";
		}
		echo "<br />";
		
		$rs->moveNext();
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
				
				<?php TraerGaleriasLista(); ?>
				
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