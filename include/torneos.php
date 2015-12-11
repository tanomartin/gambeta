<div style="margin-top:5px" align="center">
<? for ($i=0; $i<count( $aTorneos ); $i++) {
	$oObj = new TorneoCat();
		$categoria = $oObj ->getByTorneo($aTorneos[$i][id]); ?>
        <img src="logos/<?= $aTorneos[$i]['logoPrincipal'] ?>" title="<?= $aTorneos[$i]['nombre']?>"  border="0" width="50px" height="50px" onclick="pagina('<?= $categoria[0][id]?>')" style="cursor: pointer"/>
 <? } ?>	
</div>