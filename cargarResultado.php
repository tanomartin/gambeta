<?	include_once "include/config.inc.php";
	include_once "model/fixture.php";	
	
	$modulo = "resultados";

	$color = $_REQUEST['color'];

	$oObj1 = new Fixture();

	$aFixture = $oObj1->getByEquipo($_REQUEST['id'],$_REQUEST['idEquipo']);


?>
<? for ($i=0; $i<count($aFixture);$i++) { ?>
   <? if ($aFixture[$i]['idEquipo1']  == $_REQUEST['idEquipo']) { ?>
       <div id=linea style="height:19px; width:355px; padding:7px; border-top: #CCC 1px solid" >
           <div style="width:155px; text-align:left; float:left" class=" resultado_equipo resultado_color_<?=$color?>"><?= $aFixture[$i]['equipo1'] ?></div>
           <div style="width:15px; text-align:center; float:left" class=" resultado_equipo resultado_color_<?=$color?>"><b><?= $aFixture[$i]['golesEquipo1'] ?></b></div>
           <div style="width:10px; text-align:left; float:left">&nbsp;</div>
           <div style="width:15px; text-align:center; float:left"  class="resultado_equipo"><b><?= $aFixture[$i]['golesEquipo2'] ?></b></div>
           <div style="width:155px; text-align: right; float:left" class="resultado_equipo"><?= $aFixture[$i]['equipo2'] ?></div>                                                                                    
       </div>
     <? } else { ?>
       <div id=linea style="height:19px; width:355px; padding:7px; border-top: #CCC 1px solid" >
           <div style="width:155px; text-align:left; float:left" class=" resultado_equipo resultado_color_<?=$color?>"><?= $aFixture[$i]['equipo2'] ?></div>
           <div style="width:15px; text-align:center; float:left" class=" resultado_equipo resultado_color_<?=$color?>"><b><?= $aFixture[$i]['golesEquipo2'] ?></b></div>
           <div style="width:10px; text-align:left; float:left">&nbsp;</div>
           <div style="width:15px; text-align:center; float:left"  class="resultado_equipo"><b><?= $aFixture[$i]['golesEquipo1'] ?></b></div>
           <div style="width:155px; text-align: right; float:left" class="resultado_equipo"><?= $aFixture[$i]['equipo1'] ?></div>                                                                                    
       </div>
     
     <? } ?>  
<? } ?> 
<div id=linea style="height:19px; width:355px; padding:7px; border-top: #CCC 1px solid" ></div>
