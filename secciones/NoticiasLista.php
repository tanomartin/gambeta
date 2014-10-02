<?php
function TraerNoticiasLista()
{

	$rs = ConectarRS(GetNoticias(GetTorneo())); 

	while(!$rs->Eof())
	{
		if(!$rs->Fields("fotoPreview"))
		{
			echo "<p class=\"titulo\"><a href=\"LeerNoticia.php?nid=".$rs->Fields("id")."\">".$rs->Fields("fecha")." - ".$rs->Fields("titulo")."</a></p><p>".$rs->Fields("prologo")."</p>";
		}
		else
		{
			echo "<a href=\"LeerNoticia.php?nid=".$rs->Fields("id")."\"><img src=\"admin/uploads/".$rs->Fields("fotoPreview")."\" width=\"55\" border=\"0\" height=\"55\" alt=\"\" class=\"img-indent\" /></a><p class=\"titulo\"><a href=\"LeerNoticia.php?nid=".$rs->Fields("id")."\">".$rs->Fields("fecha")." - ".$rs->Fields("titulo")."</a></p><p>".$rs->Fields("prologo")."</p>";
		}
		
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
				
				<?php TraerNoticiasLista(); ?>
				
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