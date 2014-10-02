<?php
function GetFlashMenu($menuId)
{
?>
<script type="text/javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '766',
			'height', '109',
			'src', 'flash/menu_<?php echo GetLanguage();?>?button=<?php echo $menuId; ?>',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'flash/menu_<?php echo GetLanguage();?>?button=<?php echo $menuId; ?>',
			'bgcolor', '#ffffff',
			'name', 'flash/menu_<?php echo GetLanguage();?>?button=<?php echo $menuId; ?>',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'flash/menu_<?php echo GetLanguage();?>?button=<?php echo $menuId; ?>',
			'salign', ''
			); //end AC code
	}
</script>
<?php
}

function GetHeader($id)
{
?>
<script type="text/javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '400',
			'height', '244',
			'src', 'flash/<?php echo $id; ?>',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'flash/<?php echo $id; ?>',
			'bgcolor', '#ffffff',
			'name', 'flash/<?php echo $id; ?>',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'flash/<?php echo $id; ?>',
			'salign', ''
			); //end AC code
	}
</script>
   
<?php
}
?>