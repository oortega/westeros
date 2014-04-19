<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES">
 <head>
  <title><?php if(is_home()) { echo get_bloginfo("title"); } else { wp_title('- '.get_bloginfo("title").'', true, 'right'); } ?></title>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php 
if (have_posts()): while(have_posts()) : the_post();
$description = string_limit_words(get_the_excerpt(), 20);
endwhile; endif; 
if(is_single()){
$pro_url = "<meta property='og:url' content='".get_permalink()."'/>";	
$pro_descripcion = "<meta property='og:description' content='".$description."'/>";
$pro_type = "<meta property='og:type' content='article'/>";
$pro_title = "<meta property='og:title' content='".get_the_title()."'/>";
} else {
$pro_url = "<meta property='og:url' content='".get_bloginfo("url")."'/>";	
$pro_descripcion = "<meta property='og:description' content='".get_bloginfo("description")."'/>";
$pro_type = "<meta property='og:type' content='website'/>";
$pro_title = "<meta property='og:title' content='".get_bloginfo("title")."'/>";
}
?>
<?php if(is_404()){
 echo '
<meta name="robots" content="noindex,nofollow" />';	
} else {
echo '
<meta name="robots" content="index,follow" />';		
}
if(has_post_thumbnail()){
  $src = wp_get_attachment_url(get_post_thumbnail_id($post->ID));	
} else {
	if(get_option("wppractical_logo") == ""){$src = get_bloginfo("template_url")."/images/logo.png"; } else {$src = get_option("wppractical_logo");} 
}
echo "
<meta property='og:locale' content='es_ES'/>
$pro_title
$pro_descripcion
$pro_url
<meta property='og:site_name' content='".get_bloginfo("title")."'/>
<meta property='og:image' content='".$src."'/>
$pro_type
";	
?>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <?php
  if(get_option("wppractical_favicon")){
	 $favicon = get_option("wppractical_favicon");
 } else {
  	 $favicon = get_bloginfo('template_directory')."/images/favicon.ico"; }
   echo '<link rel="shortcut icon" href="'.$favicon.'" />'; ?>
  <?php echo stripslashes(get_option('wppractical_header_codigos')); ?>
<?php wp_head(); ?>
<style type="text/css">
<?php
$color = "#".get_option('wppractical_color_todo');
$color_menu = "#".get_option('wppractical_color_menu');
$color_menu_a = "#".get_option('wppractical_color_menu_a');
$color_footer = "#".get_option('wppractical_color_footer');
$color_footer_a = "#".get_option('wppractical_color_footer_a');
$color_fondo = "#".get_option('wppractical_fondo_color');
$header_color = "#".get_option('wppractical_header_color');
$fondo_imagen = get_option('wppractical_fondo_imagen');
if(!get_option('wppractical_color_todo')){
$color = "#0086D7";
$color_menu = "#2FD4F4";
$color_menu_a = "#FFFFFF";
$color_footer = "#2FD4F4";
$color_footer_a = "#FFFFFF";
$color_fondo = "#123039";
$header_color = "#0086D7";
}
$rgba = hex2rgb($color);
$rgba_1 = $rgba[0];
$rgba_2 = $rgba[1];
$rgba_3 = $rgba[2];

$rgba_menu = hex2rgb($color_menu);
$rgba_menu_1 = $rgba_menu[0];
$rgba_menu_2 = $rgba_menu[1];
$rgba_menu_3 = $rgba_menu[2];
$rgba_menu = "$rgba_menu_1, $rgba_menu_2, $rgba_menu_3";?>
body {background-color: <?php echo $color_fondo; ?>; background-image:url(<?php echo $fondo_imagen; ?>)}
a, .bloque h2.tp2 a:hover {color:<?php echo $color; ?>}
#menu li .sub-menu a:hover {color:<?php echo $color_menu_a; ?>}
.sidetitle, #relacionados h2, #author-info, #comentarios .tpp, #relacionados ul li a:hover img,  #comentarios .tpp li a {border-color:<?php echo $color; ?>}
#header, #footer, .etiquetas .normal, .mas_comentadas ul .plus, .paginador a:hover, .paginador a:hover, .paginador .est, #sidebar .tagcloud a:hover, #searchsubmit, .feedburner-subscribe, .commentlist .comment-body .comment-reply-link, #commentform #submit, #comentarios .tpp li a, .mas_comentadas .bloque:hover {background:<?php echo $color; ?>}
#header {background:<?php echo $header_color; ?>}
<?php 
$color1 = $rgba[0]; 
$color2 = $rgba[1]-10;
$color3 = $rgba[2]-30; 
$mezcla = "$color1, $color2, $color3";
?>
#header #menu .menu .sub-menu li a {color: <?php echo $color_menu_a ?>}

#header #menu .menu .sub-menu li:hover>.sub-menu  {background:rgba(<?php echo $rgba_menu ?>,0.8)}
#header #menu .sub-menu li a {border-bottom:1px solid rgba(<?php echo $rgba_menu ?>)}
.mas_comentadas .bloque_1, #contenido h2.tp2 a:hover {border-color:rgba(<?php echo $mezcla ?>,1)}
.mas_comentadas .bloque_2 {border-color:rgba(<?php echo $mezcla ?>,0.8)}
.mas_comentadas .bloque_3, #contenido h2.tp2 a, #contenido h1.tp {border-color:rgba(<?php echo $mezcla ?>,0.6)}
.mas_comentadas .bloque_4 {border-color:rgba(<?php echo $mezcla ?>,0.4)}
.mas_comentadas .bloque_5 {border-color:rgba(<?php echo $mezcla ?>,0.2)}
<?php 
if(get_option('wppractical_sidebar') == "izquierda"){
	echo '#content #sidebar {float:left}
	#content #wrapper {float:right}
	.botones_sociales {margin-left:576px; box-shadow:2px 0px 8px 1px #CCC}';
}
?>
#menu, #header #menu li a, #header #menu li {background:<?php echo $color_menu; ?>}
#menu a {color:<?php echo $color_menu_a; ?>}
#header #menu .menu .sub-menu li a {background:rgba(<?php echo $rgba_menu ?>)}
#header #menu li a:hover {background:#fff; color:<?php echo $header_color?>; text-decoration:none; transition: all 0.3s ease; -moz-transition: all 0.3s ease; -o-transition: all 0.3s ease; -webkit-transition: all 0.3s ease; }
.bloque h2.tp2 a{border-left:10px solid <?php echo $color_menu ?>;}
#sidebar .widget .sidetitle{border-bottom: 3px solid <?php echo $color_menu ?>;}
#footer {background:<?php echo $color_footer; ?>; color:<?php echo $color_footer_a; ?>}
#footer a {color:<?php echo $color_footer_a; ?>}
#header #menu .menu,#header .contenido{max-width: 910px; margin: 0 auto}
<?php
 if(!get_option("wppractical_facebook") || !get_option("wppractical_twitter") || !get_option("wppractical_google+") || !get_option("wppractical_youtube") || !get_option("wppractical_rss")){ 
 echo '#header .buscador {margin-top:40px}';
 }
?>
</style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

 <div id="header">
 <div class="contenido"><a href="<?php bloginfo("url"); ?>"><img src="<?php 
 if(get_option("wppractical_logo")){
	 echo get_option("wppractical_logo");
 } else {
	 echo bloginfo("template_directory")."/images/logo.png"; 
 }?>" alt="<?php bloginfo("title"); ?>" class="logo" /></a>
  
  
<div class="buscador"> 
<?php
 if(get_option("wppractical_facebook") || get_option("wppractical_twitter") || get_option("wppractical_google+") || get_option("wppractical_youtube") || get_option("wppractical_rss")){ ?>
<div class="header_social">
<?php
    if(get_option("wppractical_facebook") != ''){
	  echo '<a href="'.get_option("wppractical_facebook").'" target="_blank" class="b_social _f" title="Nuestro Facebook">facebook</a>';
	  }
	if(get_option("wppractical_twitter") != ''){
	  echo '<a href="'.get_option("wppractical_twitter").'" target="_blank" class="b_social _t" title="Nuestro Twitter">twitter</a>';
	}
	if(get_option("wppractical_google+") != ''){
	  echo '<a href="'.get_option("wppractical_google").'" target="_blank" class="b_social _g" title="Nuestro perfil de Google+">google+</a>';
	}  
	if(get_option("wppractical_youtube") != ''){
	  echo '<a href="'.get_option("wppractical_google").'" target="_blank" class="b_social _y" title="Suscríbete a nuestro canal">youtube</a>';
	}  
	if(get_option("wppractical_rss") != ''){
	  echo '<a href="'.get_option("wppractical_rss").'" target="_blank" class="b_social _rss" title="RSS">RSS</a>';
	} 
echo '</div>'; 
 } 
	?>
<form action="<?php bloginfo("url"); ?>" method="get">
<input type="text" name="s" required="required" placeholder="Buscar en la web" autocomplete="off">
<input type="submit" class="boton_form" value="Buscar" title="Buscar" /></form></div>
 
</div>
<div id="menu"><?php wp_nav_menu(array('theme_location' => 'menu', 'show_home' => true)); ?></div>
</div>

<div id="pag">

<div id="content">