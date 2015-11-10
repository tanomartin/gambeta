<br />
<!-- indexer::stop -->
<? if ($modulo == 'noticias' ) { ?>
		<div class="menu_borde_selec" id="menu_noticias_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_noticias"  onclick="cambiar_menu('noticias.php')">
        </div>    
<? } 
   if ($modulo == 'equipos' ) { ?>
		<div class="menu_borde_selec" id="menu_equipos_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_equipos" onclick="cambiar_menu('equipos.php')">
        </div>    
<? } 
   if ($modulo == 'equipoideal' ) { ?>
		<div class="menu_borde_selec" id="menu_equipoideal_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_equipoideal" onclick="cambiar_menu('equipoideal.php')">
        </div>    
<? } 
   if ($modulo == 'fixture' ) { ?>
		<div class="menu_borde_selec" id="menu_fixture_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_fixture" onclick="cambiar_menu('fixture.php')">
        </div>    
<? } 
   if ($modulo == 'resultados' ) { ?>
		<div class="menu_borde_selec" id="menu_resultados_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_resultados" onclick="cambiar_menu('resultados.php')">
        </div>    
<? } 
   if ($modulo == 'goleadoras' ) { ?>
		<div class="menu_borde_selec" id="menu_goleadoras_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_goleadoras" onclick="cambiar_menu('goleadoras.php')">
        </div>    
<? } 
   if ($modulo == 'posiciones' ) { ?>
		<div class="menu_borde_selec" id="menu_posiciones_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_posiciones"  onclick="cambiar_menu('posiciones_new.php')">
        </div>    
<? } 
   if ($modulo == 'tarjetas' ) { ?>
		<div class="menu_borde_selec" id="menu_tarjetas_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_tarjetas" onclick="cambiar_menu('tarjetas.php')">
        </div>    
<? } 
   if ($modulo == 'reserva' ) { ?>
		<div class="menu_borde_selec" id="menu_reserva_seleccionada">
       </div> 
<? } else { ?>
		<div class="menu_borde" id="menu_reserva" onclick="cambiar_menu('reserva_horarios.php')">
        </div>    
<? } ?>

<!-- indexer::continue -->