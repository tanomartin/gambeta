<?
	$auspiciantes[0][url]="http://www.privilegeba.com";
	$auspiciantes[0][img]="img/auspiciantes/privilege.jpg";
	$auspiciantes[0][tit]="Privileg BA";

	$auspiciantes[1][url]="http://www.fitnesas.com.ar";
	$auspiciantes[1][img]="img/auspiciantes/fitnesas.png";
	$auspiciantes[1][tit]="Fitnesas";

	$auspiciantes[2][url]="https://www.facebook.com/lenceria.adomicilio";
	$auspiciantes[2][img]="img/auspiciantes/lenceria.jpg";
	$auspiciantes[2][tit]="Lenceria a Domicilio";

	$auspiciantes[3][url]="http://www.camisetadefutbol.com";
	$auspiciantes[3][img]="img/auspiciantes/camisetadefutbol.jpg";
	$auspiciantes[3][tit]="Camiseta de Futbol";

	$auspiciantes[4][url]="http://www.aershop.com.ar";
	$auspiciantes[4][img]="img/auspiciantes/aer_logo.jpg";
	$auspiciantes[4][tit]="Aer Shop";

	$auspiciantes[5][url]="https://www.facebook.com/aqui.africa";
	$auspiciantes[5][img]="img/auspiciantes/africa_logo.jpg";
	$auspiciantes[5][tit]="Africa";

// 	$auspiciantes[6][url]="http://www.solofutbolfemenino.com";
	$auspiciantes[6][url]="#";
	$auspiciantes[6][img]="img/auspiciantes/solo_futbol.jpg";
	$auspiciantes[6][tit]="Solo Futbol Femenino";
				
	//$auspiciantes[7][url]="http://www.sushiboom.com.ar";
	//$auspiciantes[7][img]="img/auspiciantes/sushi_boom.jpg";
	//$auspiciantes[7][tit]="Sushi Boom";
	shuffle ($auspiciantes);
?>				
	<a href="http://www.sushiboom.com.ar" rel="shadowbox" title="Sushi Boom"><img src="img/auspiciantes/sushi_boom.jpg" class="imagen"/></a>
	<?	for ($i=0;$i<count($auspiciantes);$i++) { 
			if (strpos($auspiciantes[$i]['url'], "facebook") === false ) { ?>
				<a href="<?= $auspiciantes[$i]['url']?>" rel="shadowbox" title="<?= $auspiciantes[$i]['tit']?>"><img src="<?= $auspiciantes[$i]['img']?>" class="imagen"/></a>
		<? } else { ?>
				<a href="<?= $auspiciantes[$i]['url']?>" title="<?= $auspiciantes[$i]['tit']?>" target="_blank"><img src="<?= $auspiciantes[$i]['img']?>" class="imagen"/></a>
		<? } ?>
	<? } ?>