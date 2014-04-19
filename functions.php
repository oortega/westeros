<?php


function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];
  return $first_img;
}

function ads($ads){
if(!is_404()){
if($ads == "ads_adaptable"){
	$ads = get_option('wppractical_ads_adaptable');
}
elseif($ads == "ads_336x280"){
	$ads = get_option("wppractical_ads_336x280");
}
elseif($ads == "ads_300x250"){
	$ads = get_option("wppractical_ads_300x250");
}
elseif($ads == "ads_300x600"){
	$ads = get_option("wppractical_ads_300x600");
}
elseif($ads == "ads_468x15"){
	$ads = get_option("wppractical_ads_468x15");
}
} else {
$ads = null;
}
return stripslashes($ads);
}

add_theme_support( 'nav-menus' );
register_nav_menus(array('menu' => __('menu')));

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}

if (function_exists('register_sidebar'))
register_sidebar(array(
	'name' => 'Sidebar',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<div class="sidetitle">',
	'after_title' => '</div>',
));

register_sidebar(array(
	'name' => 'footer',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

function new_excerpt_more( $more ) {
	return '...<a href="'.get_permalink( get_the_ID() ).'" title="Seguir leyendo el artículo" class="readmore">Seguir leyendo</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_theme_support( 'post-thumbnails' );

function new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

if (function_exists( 'add_image_size') ) {
	 add_image_size('pequeño', 100, 100, true);
	 add_image_size('miniatura', 50, 50, true);
}
add_filter('image_size_names_choose', 'hmuda_image_sizes');
function hmuda_image_sizes($sizes) {
    $addsizes = array(
		"pequeño" => __("Pequeño"),
		"miniatura" => __("Miniatura")
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}
  
require_once (TEMPLATEPATH.'/funciones/paginador.php');
require_once (TEMPLATEPATH.'/funciones/comentarios.php');
require_once (TEMPLATEPATH.'/funciones/panel.php');
require_once (TEMPLATEPATH.'/funciones/widgets/facebook.php');
require_once (TEMPLATEPATH.'/funciones/widgets/twitter.php');
require_once (TEMPLATEPATH.'/funciones/widgets/google.php');
require_once (TEMPLATEPATH.'/funciones/widgets/youtube.php');
require_once (TEMPLATEPATH.'/funciones/widgets/feedburner.php');
require_once (TEMPLATEPATH.'/funciones/widgets/ads_adaptable.php');
require_once (TEMPLATEPATH.'/funciones/widgets/ads_300x600.php');
require_once (TEMPLATEPATH.'/funciones/widgets/ads_300x250.php');
require_once (TEMPLATEPATH.'/funciones/widgets/mas_comentadas.php');
require_once (TEMPLATEPATH.'/funciones/widgets/ultimas_entradas.php');
?>