<?php
if(is_admin()){require_once (TEMPLATEPATH.'/funciones/admin.php');}

add_action('admin_menu', 'wppractical_theme');

function wppractical_theme() {
	if(count($_POST)> 0 && isset($_POST['wppractical_settings'])){
		$options = array ('logo', 'favicon', 'facebook', 'twitter', 'google+', 'youtube', 'rss', 'titulo', 'header_codigos', 'texto_footer', 'footer_codigos', 'sidebar', 'footer_menu', 'fondo_color', 'fondo_imagen', 'header_color', 'color_menu', 'color_menu_a', 'color_todo', 'color_footer_a', 'color_footer', 'ads_adaptable', 'ads_336x280', 'ads_300x600', 'ads_300x250', 'ads_468x15', 'url_perfil_google', 'nombre_perfil_google', 'estrellas', 'estrellas_posicion');
		foreach ($options as $opt)
		{
		delete_option ('wppractical_'.$opt, $_POST[$opt]);
		add_option ('wppractical_'.$opt, $_POST[$opt]);	
		}		 
	}
	add_menu_page(__('WP Practical'), __('Westeros'), 'edit_themes', basename(__FILE__), 'wppractical_settings');
	add_submenu_page(__('WP Practical'), __('WP Practical'), 'edit_themes', basename(__FILE__), 'wppractical_settings');
}
function wppractical_settings()
{?>
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/funciones/jscolor/jscolor.js"></script>

 <style type="text/css" media="screen">  
   fieldset {border:1px solid #CCC; background:#F8F8F8; overflow:hidden; padding:5px 15px 15px 20px; margin-top:20px; clear:left}
   legend {padding:3px 15px 2px 15px; background:#FFF; font-size:16px}
   form {margin:0}
   .form-table {float:left; width:400px}
   .form-table tr td {width:50px}
   .wrap {width:640px; position:relative}
   .caja_color {height:20px; width:20px; display:run-in; float:left; position:relative; top: 2.5px}
   .colorwell {width:100px; float:left}
   
   #menu {background: #222222;width: 250px;margin-left: -294px;border-radius:0px 10px 10px 0px;-moz-border-radius:0px 10px 10px 0px;-webkit-border-radius:0px 10px 10px 0px;float: left;border-left: 5px solid #111111; position:fixed}
   #menu ul, #menu ul li {padding:0; margin:0}
   #menu ul li a {display:block; color:#EEE; text-decoration:none; padding:10px 20px 10px; font-size:15px; text-align:right}
   #menu ul li a:hover {background:#111111; color:#2ea2cc}
   .submit {text-align: center; margin: 0;}
   
   h3 {background:#F8F8F8; padding:8px 15px 8px 15px; font-size:17px; margin:0; border-bottom:1px solid #CCC; color:#444; border-radius:5px 5px 0px 0px;-moz-border-radius:5px 5px 0px 0px;-webkit-border-radius:5px 5px 0px 0px}
   .bloque {border:1px solid #CCC; margin-top:15px; width:540px; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px}
   .bloque .s {padding:20px 15px 20px 15px;}
   .bloque textarea {width:500px; height:100px}
   
   #generales {display:inherit}
   #footer, #sidebar, #colores, #anuncios, #autor, #estrellas {display:none}
   .upload {width:230px !important}
 </style> 
 
 <script type="text/javascript">
  function bloque(bloq){
	  
	document.getElementById("generales").style.display = 'inherit';
	document.getElementById("autor").style.display = 'none';
	document.getElementById("footer").style.display = 'none';
	document.getElementById("sidebar").style.display = 'none';
	document.getElementById("colores").style.display = 'none';
	document.getElementById("anuncios").style.display = 'none';
	document.getElementById("estrellas").style.display = 'none';
	
	  if(bloq == "generales") {
		document.getElementById("generales").style.display = 'inherit';
	  }
	  else if(bloq == "autor") {
		document.getElementById("generales").style.display = 'none';
		document.getElementById("autor").style.display = 'inherit';
	  }
	  else if(bloq == "footer") {
		document.getElementById("generales").style.display = 'none';
		document.getElementById("footer").style.display = 'inherit';
	  }
	  else if(bloq == "sidebar") {
	    document.getElementById("generales").style.display = 'none';
		document.getElementById("sidebar").style.display = 'inherit';
	  }
	  else if(bloq == "colores") {
	    document.getElementById("generales").style.display = 'none';
		document.getElementById("colores").style.display = 'inherit';
	  }
	  else if(bloq == "anuncios") {
	    document.getElementById("generales").style.display = 'none';
		document.getElementById("anuncios").style.display = 'inherit';
	  }
	  else if(bloq == "estrellas") {
	    document.getElementById("generales").style.display = 'none';
		document.getElementById("estrellas").style.display = 'inherit';
	  }
  }
 </script>
<div class="wrap">
<div style="margin-left:270px">
<form method="post" action="" name="myform" id="myform">
<div id="menu">
 <ul>
  <li><img style="margin-left: 14px;" src="<?php bloginfo("template_directory"); ?>/images/wppractical-panel.png" /></li>
  <li><a href="javascript:bloque('generales')">Opciones generales</a></li>
  <li><a href="javascript:bloque('autor')">Autor</a></li>  
  <li><a href="javascript:bloque('colores')">Colores</a></li>
  <li><a href="javascript:bloque('sidebar')">Sidebar</a></li>
  <li><a href="javascript:bloque('anuncios')">Anuncios</a></li>
  <li><a href="javascript:bloque('estrellas')">Estrellas</a></li>
  <li><a href="javascript:bloque('footer')">Footer</a></li>  
  <li><div class="submit" style="clear:both">
  <input type="submit" name="Submit" class="button-primary" value="Guardar cambios" />
  <input type="hidden" name="wppractical_settings" value="save" style="display:none;" />
 </div></li>
 </ul>
</div>
<div id="generales">
 <h2>Opciones generales</h2>
 <div class="bloque">
  <h3>Logo</h3>
  <div class="s">Sube un logo para tu página (400 x 100 píxeles como máximo)<br /><br /><input type="text" name="logo" id="logo" value="<?php echo get_option('wppractical_logo'); ?>" class="regular-text upload" />
  <input class="upload_image_button" type="button" value="Upload" /><input type="button" onclick="document.getElementById('logo').value = ''" value="Borrar" /></div>
 </div>
  
 <div class="bloque">
  <h3>Favicon</h3>
  <div class="s">Sube el favicon para tu página:<br /><br /><input type="text" name="favicon" id="favicon" value="<?php echo get_option('wppractical_favicon'); ?>" class="regular-text upload" />
  <input class="upload_image_button" type="button" value="Upload" /><input type="button" onclick="document.getElementById('favicon').value = ''" value="Borrar" /></div>
 </div>
 
 <div class="bloque">
  <h3>Fondo</h3>
  <div class="s">Sube una imagen de fondo y/o un color:<br /><br /><input type="text" name="fondo_imagen" id="fondo_imagen" value="<?php echo get_option('wppractical_fondo_imagen'); ?>" class="regular-text upload" />
   <input class="upload_image_button" type="button" value="Upload" /><input type="button" onclick="document.getElementById('fondo_imagen').value = ''" value="Borrar" />   
   <input type="text" class="color" name="fondo_color" style="width:100px" value="<?php if(get_option('wppractical_fondo_color') == ''){$color ='#F2F2F2';} else {$color=get_option('wppractical_fondo_color');} echo $color; ?>" /></div>
 </div>
 
 <div class="bloque">
  <h3>Iconos sociales (header)</h3>
  <div class="s">
   Ingresa las direcciones URL's de cada red social.<br /><br />
   <p>Facebook: <input type="text" name="facebook" value="<?php echo get_option('wppractical_facebook'); ?>" class="regular-text" /></p>
   <p>Twitter: <input type="text" name="twitter" value="<?php echo get_option('wppractical_twitter'); ?>" class="regular-text" /></p>
   <p>Google+: <input type="text" name="google+" value="<?php echo get_option('wppractical_google+'); ?>" class="regular-text" /></p>
   <p>YouTube: <input type="text" name="youtube" value="<?php echo get_option('wppractical_youtube'); ?>" class="regular-text" /></p>
   <p>RSS: <input type="text" name="rss" value="<?php echo get_option('wppractical_rss'); ?>" class="regular-text" /></p>
   </div>
 </div>
 
 <div class="bloque">
  <h3>Titulo</h3>
  <div class="s">Coloca el título que quieres que aparezca en el Home. Por defecto: Últimos artículos<br /><br /><input type="text" name="titulo" value="<?php echo get_option('wppractical_titulo'); ?>" class="regular-text" maxlength="72" /></div>
 </div>
 
 <div class="bloque">
  <h3>Códigos header</h3>
  <div class="s">Coloca los códigos en el header, como: Google Analytics, Webmasters, Alexa, etc.<br /><br /><textarea name="header_codigos" class="regular-text"><?php echo stripslashes(get_option('wppractical_header_codigos')); ?></textarea></div>
 </div>
</div>

<div id="autor">
 <h2>Autor</h2>
 <div class="bloque">
  <h3>Autor de Google</h3>
  <div class="s">Coloca la URL de tu perfil: <input type="text" name="url_perfil_google" value="<?php echo get_option('wppractical_url_perfil_google'); ?>" class="regular-text" /><br /><br />
  Coloca tu nombre: <input type="text" name="nombre_perfil_google" value="<?php echo get_option('wppractical_nombre_perfil_google'); ?>" class="regular-text" /><br /><br /></div>
 </div>
</div> 
 
<div id="estrellas">
 <h2>Estrellas</h2>
 <div class="bloque">
  <h3>¿Mostrar las estrellas en los posts?</h3>
  <div class="s">
   Recuerda haber instalado el plugin WP-PostRatings que vino junto al theme.<br /><br />
   <?php if(get_option('wppractical_estrellas') == "no"){ $marcar_estrellas = ' selected="selected"'; } ?>
   <select name="estrellas">
   <option value="si">Si</option>
   <option value="no"<?php echo @$marcar_estrellas; ?>>No</option>
   </select></div>
 </div>
 <div class="bloque">
  <h3>¿En qué parte mostrarlas?</h3>
  <div class="s"><?php if(get_option('wppractical_estrellas_posicion') == "bottom"){ $marcar_estrellas_posicion = ' selected="selected"'; } ?>
   <select name="estrellas_posicion">
   <option value="top">Al iniciar el post</option>
   <option value="bottom"<?php echo @$marcar_estrellas_posicion; ?>>Al finalizar el post</option>
   </select></div>
 </div>
</div> 
 
<div id="footer">
 <h2>Footer</h2>
 <div class="bloque">
  <h3>Texto footer</h3>
  <div class="s">Coloca cualquier texto en el footer. Permite HTML.
  <textarea name="texto_footer" class="regular-text"><?php echo stripslashes(get_option('wppractical_texto_footer')); ?></textarea></div>
 </div>
 
 <div class="bloque">
  <h3>Enlaces del menú en el footer</h3>
  <div class="s"><?php if(get_option('wppractical_footer_menu') == "no"){ $marcar2 = ' selected="selected"'; } ?>
   <select name="footer_menu">
   <option value="si">Si</option>
   <option value="no"<?php echo @$marcar2; ?>>No</option>
   </select></div>
 </div>
 
 <div class="bloque">
  <h3>Códigos Footer</h3>
  <div class="s"><textarea name="footer_codigos" class="regular-text"><?php echo stripslashes(get_option('wppractical_footer_codigos')); ?></textarea></div>
 </div>
</div>
 
 
<div id="sidebar">
 <h2>Sidebar</h2>
 <div class="bloque">
  <h3>Posición del sidebar</h3>
  <div class="s"><?php if(get_option('wppractical_sidebar') == "izquierda"){ $marcar = ' selected="selected"'; } ?>
   <select name="sidebar">
   <option value="derecha">Derecha</option>
   <option value="izquierda"<?php echo @$marcar; ?>>Izquierda</option>
   </select></div>
 </div>
</div>


<div id="colores">
 <h2>Colores</h2>
 <div class="bloque">
  <h3>Color general</h3>
  <div class="s">Selecciona un color para toda la página: <input type="text" class="color" name="color_todo" value="<?php if(get_option('wppractical_color_todo') == ''){$color ='#276DD6';} else {$color=get_option('wppractical_color_todo');} echo $color; ?>" /></div>
 </div>
 
 <div class="bloque">
  <h3>Header</h3>
  <div class="s">Selecciona un color para el header: <input type="text" class="color" name="header_color" value="<?php if(get_option('wppractical_header_color') == ''){$color ='#276DD6';} else {$color=get_option('wppractical_header_color');} echo $color; ?>" /></div>
 </div>
 
 <div class="bloque">
  <h3>Menú</h3>
  <div class="s">Selecciona un color para el menú: <input type="text" class="color" name="color_menu" value="<?php if(get_option('wppractical_color_menu') == ''){$color ='#1A478C';} else {$color=get_option('wppractical_color_menu');} echo $color; ?>" /></div>
 </div>
 
 <div class="bloque">
  <h3>Menú enlaces</h3>
  <div class="s">Selecciona un color para los enlaces del menú: <input type="text" class="color" name="color_menu_a" value="<?php if(get_option('wppractical_color_menu_a') == ''){$color ='#276DD6';} else {$color=get_option('wppractical_color_menu_a');} echo $color; ?>" /></div>
 </div>
 
 <div class="bloque">
  <h3>Footer</h3>
  <div class="s">Selecciona un color para el footer: <input type="text" class="color" name="color_footer" value="<?php if(get_option('wppractical_color_footer') == ''){$color ='#276DD6';} else {$color=get_option('wppractical_color_footer');} echo $color; ?>" /></div>
 </div>
 
 <div class="bloque">
  <h3>Footer enlaces</h3>
  <div class="s">Selecciona un color para los enlaces del footer: <input type="text" class="color" name="color_footer_a" value="<?php if(get_option('wppractical_color_footer_a') == ''){$color ='#FFFFFF';} else {$color=get_option('wppractical_color_footer_a');} echo $color; ?>" /></div>
 </div>
 
 
</div> 
 
 
 
<div id="anuncios">
 <h2>Anuncios</h2>
 
 <div class="bloque">
  <h3>Bloque de anuncio adaptable</h3>
  <div class="s">Si usas este tipo de bloque, no coloques lo códigos de 336x280, 300x250 y 300x600 de la parte de abajo.<br /><br /><textarea name="ads_adaptable" class="regular-text"><?php echo stripslashes(get_option('wppractical_ads_adaptable')); ?></textarea></div>
 </div>
 
 <div class="bloque">
  <h3>Ads 336x280</h3>
  <div class="s">Bloque de anuncio para la parte superior e inferior del post.<br /><br /><textarea name="ads_336x280" class="regular-text"><?php echo stripslashes(get_option('wppractical_ads_336x280')); ?></textarea></div>
 </div> 
 
 <div class="bloque">
  <h3>Ads 300x250</h3>
  <div class="s">Bloque de anuncio para el sidebar. Solo faltaría añadir el Widget.<br /><br /><textarea name="ads_300x250" class="regular-text"><?php echo stripslashes(get_option('wppractical_ads_300x250')); ?></textarea></div>
 </div> 
 
 <div class="bloque">
  <h3>Ads 300x600</h3>
  <div class="s">Bloque de anuncio para el sidebar. Solo faltaría añadir el Widget.<br /><br /><textarea name="ads_300x600" class="regular-text"><?php echo stripslashes(get_option('wppractical_ads_300x600')); ?></textarea></div>
 </div> 
 
 <div class="bloque">
  <h3>Ads 468x15</h3>
  <div class="s">Bloque de anuncio para la parte superior e inferior del post. Se muestra debajo del anuncio 336x280.<br /><br /><textarea name="ads_468x15" class="regular-text"><?php echo stripslashes(get_option('wppractical_ads_468x15')); ?></textarea></div>
 </div>  
</div>

 </form>
 </div>
 </div>
<?php }?>