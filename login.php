<?php
	include("includes/claseRecordSet.php");
  	include("includes/conexion.php");
	include("includes/queries.php");
	include("includes/multiTorneo.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>.:: GAMBETA FEMENINA ::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
	<link href="ie_style.css" rel="stylesheet" type="text/css" />
<![endif]-->

<style>
		/* from facebook */
		.generic_dialog {
			font-size:11px;
height:0;
left:0;
overflow:visible;
position:fixed; /*dw*/
top:0;
width:100%;
z-index:101;
}
#generic_dialog_iframe {
left:0;
position:absolute;
top:0;
z-index:3;
}
.generic_dialog .generic_dialog_popup {
height:0;
overflow:visible;
position:relative;
}
.generic_dialog div.dialog_loading {
background-color:#F2F2F2;
border:1px solid #606060;
font-size:24px;
padding:10px;
}
#generic_dialog_overlay {
display:block;
left:0;
position:absolute;
top:0;
width:100%;
z-index:100;
}
.dialog_body .dialog_content_img {
float:left;
margin-right:15px;
}
.dialog_body .dialog_content_txt {
float:left;
padding-bottom:5px;
width:300px;
}
.dialog_body .dialog_content_body {
padding-bottom:13px;
}
.dialog_body .form_label {
padding-right:5px;
}
.dark_dialog_overlay {
background-image:url(images/facebook-overlay.png);
background-repeat:repeat;
}
* html .dark_dialog_overlay {
background-color:transparent;
background-image:url(images/blank.gif);
}
.full_bleed .pop_dialog_table td.pop_content .dialog_body {
padding:0;
}
table.pop_dialog_table {
border-collapse:collapse;
direction:ltr;
margin:auto;
table-layout:fixed;
width:465px;
}
td.pop_topleft, td.pop_topright, td.pop_bottomleft, td.pop_bottomright {
height:10px;
overflow:hidden;
padding:0 !important;
width:10px !important;
}
td.pop_topleft {
background:transparent url(images/facebook-pop-dialog-sprite.png) no-repeat scroll 0 0;
}
td.pop_topright {
background:transparent url(images/facebook-pop-dialog-sprite.png) no-repeat scroll 0 -10px;
}
td.pop_bottomleft {
background:transparent url(images/facebook-pop-dialog-sprite.png) no-repeat scroll 0 -20px;
}
td.pop_bottomright {
background:transparent url(images/facebook-pop-dialog-sprite.png) no-repeat scroll 0 -30px;
}
td.pop_top, td.pop_bottom {
background:transparent url(images/facebook-pop-dialog-sprite.png) repeat-x scroll 0 -40px;
}
td.pop_side {
background:transparent url(images/facebook-pop-dialog-sprite.png) repeat-y scroll -10px 0;
}
td.pop_content {
background-color:white;
direction:ltr;
padding:0;
}
.pop_dialog_rtl td.pop_content {
direction:rtl;
}
td.pop_content h2.dialog_title {
background:#6D84B4 none repeat scroll 0 0;
border:1px solid #3B5998;
color:white;
font-size:14px;
font-weight:bold;
margin:0;
}
td.pop_content h2.dialog_loading {
background:#6D84B4 url(images/facebook-indicator_white_small.gif) no-repeat scroll 400px 10px;
padding-right:40px;
}
td.pop_content h2 span {
display:block;
padding:4px 10px 5px;
}
td.pop_content .dialog_content {
background:#FFFFFF none repeat scroll 0 0;
border-color:#555555;
border-style:solid;
border-width:0 1px 1px;
}
td.pop_content .dialog_body {
border-bottom:1px solid #CCCCCC;
padding:10px;
}
td.pop_content .dialog_summary {
background:#F2F2F2 none repeat scroll 0 0;
border-bottom:1px solid #CCCCCC;
padding:8px 10px;
}
td.pop_content .dialog_buttons {
background:#F2F2F2 none repeat scroll 0 0;
padding:8px;
text-align:right;
}
td.pop_content .dialog_buttons input {
margin-left:5px;
}
td.pop_content .dialog_buttons_msg {
float:left;
padding:5px 0 0;
}
td.pop_content .dialog_footer {
background:#F2F2F2 none repeat scroll 0 50%;
}
 
/* david walsh custom */
#fb-modal	{ display:block; }
.info		{ width:280px; float:left; font-size:11px; color:#666; }
.info b	{ color:#000; }
.image	{ width:200px; float:left; margin-right:10px; }
 
	</style> 
	<script type="text/javascript" src="js/mootools.js"></script> 
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

</head>

<body id="page1">
	<div id="main">
      <div id="main-width">
        <!-- header -->
        <?php include("includes/Header.php"); ?>
         <!-- content -->
         <div id="content">
            <div class="indent">
               <div class="row-1 wrapper indent1">
                  <div class="block">
                     <div class="col-1">
                        <!-- box begin -->
                        <?php include("secciones/Noticias.php"); ?>
                        <!-- box end -->
                     </div>
                  </div>
                  <div class="col-2"><a href="#"><img alt="" src="images/banner1.gif" /></a></div>
               </div>
               <div class="row-2 wrapper">
                  <div class="block">
                     <div class="col-1">
                       <div class="line-hor"></div>
                        <div class="wrapper">
                           <div class="col-1">
                              <div class="ind">
                                 <!-- title-box1 begin -->
                                 <div class="title-box1">
                                    <div class="left-top-corner">
                                       <div class="right-top-corner">
                                          <div class="right-bot-corner">
                                             <div class="left-bot-corner">
                                                <div class="inner">
                                                   <div class="wrapper"><a href="#" class="link3 fright">Ver todos</a>
                                                   <h3>Destacados</h3></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- title-box1 end -->
                                 <!-- box1 begin -->
                                 <div class="box1">
                                    <div class="right-bot-corner">
                                       <div class="left-bot-corner">
                                          <div class="inner">
                                             <!-- events block begin -->
                                             <div class="box2">
                                                <div class="left-top-corner">
                                                   <div class="right-top-corner">
                                                      <div class="border-top"></div>
                                                   </div>
                                                </div>
												
											   <!-- Jugador de la fecha -->
											   <?php include("secciones/JugadorFecha.php"); ?> 
												
                                                <div class="left-bot-corner">
                                                   <div class="right-bot-corner">
                                                      <div class="border-bot"></div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- events block end -->
                                             <!-- events block begin -->
                                             <div class="box2">
                                                <div class="left-top-corner">
                                                   <div class="right-top-corner">
                                                      <div class="border-top"></div>
                                                   </div>
                                                </div>

											   <!-- Equipo de la fecha -->
											   <?php include("secciones/EquipoFecha.php"); ?> 

                                                <div class="left-bot-corner">
                                                   <div class="right-bot-corner">
                                                      <div class="border-bot"></div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- events block end -->
                                             <!-- events block begin -->
                                             
                                             <!-- events block end -->
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- box1 end -->
                              </div>
                           </div>
                           <div class="col-2">
                              <!-- title-box2 begin -->
                              <div class="title-box2">
                                 <div class="left-top-corner">
                                    <div class="right-top-corner">
                                       <div class="right-bot-corner">
                                          <div class="left-bot-corner">
                                             <div class="inner">
                                                <div class="wrapper"><a href="#" class="link4 fright">Fixture</a>
                                                <h3>Próxima fecha</h3></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- title-box2 end -->
                              <!-- box3 begin -->

								  <!-- Proxima fecha -->
								  <?php include("secciones/ProximaFecha.php"); ?> 
							  
                              <!-- box3 end -->
                           </div>
                        </div>
                       <div class="line-hor"></div>
                       <!-- BannerFoot -->
			         <?php include("includes/BannersFoot.php"); ?> 
                        
                     </div>
                  </div>
                  <div class="col-2">
                     <div class="wrap">
                        <div class="indent2">
                
                           
                           <!-- Tabla de posiciones -->
                           <?php include("secciones/TablaPosiciones.php"); ?> 
              				<!-- Tabla de goleadores -->
                           <?php include("secciones/TablaGoleadores.php"); ?> 
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- footer -->
         <?php include("includes/foot.php"); ?> 
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
					<td id="pop_content" class="pop_content"> 
						<h2 class="dialog_title"><span>Ingreso al perfil</span></h2> 
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
    <td>
            <input type="text" name="user" id="usern" />
    
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Password: </td>
    <td><input type="text" name="passwd" id="passwd" /></td>
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
						</div> 
					</td> 
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
</body>
</html>