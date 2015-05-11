<?
			  	$auspiciantes[0][url]="http://www.privilegeba.com";
			  	$auspiciantes[0][img]="img/auspiciantes/privilege.jpg";

			  	$auspiciantes[1][url]="http://www.fitnesas.com.ar";
			  	$auspiciantes[1][img]="img/auspiciantes/fitnesas.png";

			  	$auspiciantes[2][url]="http://es-la.facebook.com/people/Lenceria-A-Domicilio/1284686612";
			  	$auspiciantes[2][img]="img/auspiciantes/lenceria.jpg";

			  	$auspiciantes[3][url]="http://www.camisetadefutbol.com";
			  	$auspiciantes[3][img]="img/auspiciantes/camisetadefutbol.jpg";

			  	$auspiciantes[4][url]="http://www.aershop.com.ar";
			  	$auspiciantes[4][img]="img/auspiciantes/aer_logo.jpg";

			  	$auspiciantes[5][url]="http://www.facebook.com/aqui.africa";
			  	$auspiciantes[5][img]="img/auspiciantes/africa_logo.jpg";

			  	$auspiciantes[6][url]="http://www.solofutbolfemenino.com";
			  	$auspiciantes[6][img]="img/auspiciantes/solo_futbol.jpg";
				
				//$auspiciantes[7][url]="http://www.sushiboom.com.ar";
			  	//$auspiciantes[7][img]="img/auspiciantes/sushi_boom.jpg";

				shuffle ($auspiciantes);?>
				
				<a href="http://www.sushiboom.com.ar" target="_blank"><img src="img/auspiciantes/sushi_boom.jpg" class="imagen"/>     </a>
			<?	for ($i=0;$i<count($auspiciantes);$i++) { ?>
					<a href="<?= $auspiciantes[$i]['url']?>" target="_blank"><img src="<?= $auspiciantes[$i]['img']?>" class="imagen"/>     </a>
			<? } ?>