<?

$auspiciantes1[0][url]="http://www.futbolfemenino.com.ar";
$auspiciantes1[0][img]="img/auspiciantes/camisetadefutbol.jpg";
$auspiciantes1[0][tit]="Camiseta de Futbol";		
		
$auspiciantes1[1][url]="http://www.sushiboom.com.ar";
$auspiciantes1[1][img]="img/auspiciantes/sushi_boom.jpg";
$auspiciantes1[1][tit]="Sushi Boom";

$auspiciantes1[2][url]="http://www.frerebsas.com.ar/";
$auspiciantes1[2][img]="img/auspiciantes/frere.jpg";
$auspiciantes1[2][tit]="Frere";

shuffle ($auspiciantes1);

for ($i=0;$i<count($auspiciantes1);$i++) { 
	if (strpos($auspiciantes1[$i]['url'], "facebook") === false ) { ?>
		<a href="<?= $auspiciantes1[$i]['url']?>" rel="shadowbox" title="<?= $auspiciantes1[$i]['tit']?>"><img src="<?= $auspiciantes1[$i]['img']?>" class="imagen"/></a>
 <? } else { ?>1
		<a href="<?= $auspiciantes1[$i]['url']?>" title="<?= $auspiciantes1[$i]['tit']?>" target="_blank"><img src="<?= $auspiciantes1[$i]['img']?>" class="imagen"/></a>
 <? } 
}

$auspiciantes[0][url]="http://www.privilegeba.com";
$auspiciantes[0][img]="img/auspiciantes/privilege.jpg";
$auspiciantes[0][tit]="Privileg BA";

/*$auspiciantes[1][url]="http://www.fitnesas.com.ar";
$auspiciantes[1][img]="img/auspiciantes/fitnesas.png";
$auspiciantes[1][tit]="Fitnesas";

$auspiciantes[2][url]="https://www.facebook.com/lenceria.adomicilio";
$auspiciantes[2][img]="img/auspiciantes/lenceria.jpg";
$auspiciantes[2][tit]="Lenceria a Domicilio";*/

$auspiciantes[1][url]="http://www.aershop.com.ar";
$auspiciantes[1][img]="img/auspiciantes/aer_logo.jpg";
$auspiciantes[1][tit]="Aer Shop";

$auspiciantes[2][url]="https://www.facebook.com/aqui.africa";
$auspiciantes[2][img]="img/auspiciantes/africa_logo.jpg";
$auspiciantes[2][tit]="Africa";

$auspiciantes[3][url]="#";
$auspiciantes[3][img]="img/auspiciantes/solo_futbol.jpg";
$auspiciantes[3][tit]="Solo Futbol Femenino";	

shuffle ($auspiciantes);

for ($i=0;$i<count($auspiciantes);$i++) { 
	if (strpos($auspiciantes[$i]['url'], "facebook") === false ) { ?>
		<a href="<?= $auspiciantes[$i]['url']?>" rel="shadowbox" title="<?= $auspiciantes[$i]['tit']?>"><img src="<?= $auspiciantes[$i]['img']?>" class="imagen"/></a>
 <? } else { ?>
		<a href="<?= $auspiciantes[$i]['url']?>" title="<?= $auspiciantes[$i]['tit']?>" target="_blank"><img src="<?= $auspiciantes[$i]['img']?>" class="imagen"/></a>
 <? } 
} ?>