<div id="header">
  <div class="inside">
    <!-- header-box begin -->
    <div class="header-box">
      <div class="left">
        <div class="right">
          <div class="inner">
            <div class="row-1">
              <div class="fleft">
                <!-- logo-box begin -->
                <div class="logo-box">
                  <div class="left">
                    <div class="right">
                      <h1><a href="index.php">Gambeta Femenina</a></h1>
                    </div>
                  </div>
                </div>
                <!-- logo-box end -->
                <span class="slogan">Torneo de f&uacute;tbol 5</span> </div>
              <div class="fright">
                <form action="index.php" id="search-form" method="get">
                  <div>
                    <select id="t" name="t" class="text">
                      <?php echo GetCboTorneos();?>
                    </select>
                    &nbsp;
                    <input type="submit" value="Cambiar" class="submit"/>
                  </div>
                </form>
              </div>
            </div>
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="fixture.php">Fixture</a></li>
              <li><a href="estadisticas.php">Estad&iacute;sticas</a></li>
              <li><a href="equipoIdeal.php">Equipo Ideal</a></li>
              <li><a href="noticias.php">Noticias</a></li>
              <li><a href="galerias.php">Galerias</a></li>
              <li><a href="reglamento.php">Reglamento</a></li>
              <li><a href="contacto.php">Contacto</a></li>
              <?php
			  	if($_SESSION["userId"])
				{ ?>
              <li style="float:right"><a href="logout.php">Cerrar Sesión</a> </li>
              <li style="float:right"><a href="jugadorEdit.php">Mi perfil</a> </li>
              <?php } else { ?>
              <li style="float:right"><a id="fb-trigger" href="#" style="float:right">Login</a></li>
              <?php } ?>
            </ul>
            <ul class="sub-nav">
            <?php
			  	if($_SESSION["_ERROR_"])
				{ ?>
            <li style="float:left; color:#F00"><?php echo $_SESSION["_ERROR_"] ?></li>
             <?php } unset($_SESSION["_ERROR_"])?>
            <?php
			  	if($_SESSION["nombre"])
				{ ?>
	            
    	          <li style="float:right">Bienvenida <?php echo $_SESSION["nombre"] ?></li>
        	      <li style="float:right; display:none"><a id="fb-trigger" href="#">Login</a></li>
                  
            	
            <?php } ?>
            </ul>
            
           
                
                
          </div>
        </div>
      </div>
    </div>
    <!-- header-box end -->
  </div>
</div>
<div class="generic_dialog" id="fb-modal">
  <div class="generic_dialog_popup" style="top: 125px;">
    <table class="pop_dialog_table" id="pop_dialog_table" style="width: 332px;">
      <tbody>
        <tr>
          <td class="pop_topleft"/>
          <td class="pop_border pop_top"/>
          <td class="pop_topright"/>
        </tr>
        <tr>
          <td class="pop_border pop_side"/>
          <td id="pop_content" class="pop_content"><h2 class="dialog_title"><span>Ingreso al perfil</span></h2>
            <div class="dialog_content">
              <div class="dialog_summary">Solo jugadores registrados en el torneo</div>
              <div class="dialog_body">
                <div class="ubersearch search_profile">
                  <div class="result clearfix">
                    <div class="clear" style="clear:both;"></div>
                    <form id="form1" method="post" action="login_process.php">
                      <table border="0" cellspacing="5" cellpadding="10">
                        <tr>
                          <td>Usuario: </td>
                          <td><input type="text" name="user" id="usern" /></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Password: </td>
                          <td><input type="password" name="passwd" id="passwd" /></td>
                          <td><input type="submit" value="&gt;" /></td>
                        </tr>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
              <div class="dialog_buttons">
                <input type="button" value="cerrar" name="close" class="inputsubmit" id="fb-close" />
              </div>
            </div></td>
          <td class="pop_border pop_side"/>
        </tr>
        <tr>
          <td class="pop_bottomleft"/>
          <td class="pop_border pop_bottom"/>
          <td class="pop_bottomright"/>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript" src="js/mootools-1.2.3-core-yc.js"></script> 
	<script type="text/javascript"> 
		window.addEvent('domready',function() {
			/* hide using opacity on page load */
			$('fb-modal').setStyles({
				opacity:0,
				display:'block'
			});
			/* hiders */
			$('fb-close').addEvent('click',function(e) { $('fb-modal').fade('out'); });
			window.addEvent('keypress',function(e) { if(e.key == 'esc') { $('fb-modal').fade('out'); } });
			/*$(document.body).addEvent('click',function(e) { 
				if($('fb-modal').get('opacity') == 1 && !e.target.getParent('.generic_dialog')) { 
					$('fb-modal').fade('out'); 
				} 
			});*/
			/* click to show */
			$('fb-trigger').addEvent('click',function() {
				$('fb-modal').fade('in');
			});
		});
	</script> 