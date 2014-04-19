<?php
if (!defined('NONCE_KEY')) die('Acceso no permitido');
function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script('my-upload');
wp_register_script( 'custom-upload', get_bloginfo('stylesheet_directory').'/funciones/upload.js',array('jquery','media-upload','thickbox'));
    wp_enqueue_script( 'custom-upload' );
} 
function my_admin_styles() {
wp_enqueue_style('thickbox');
}
if (isset($_GET['page']) && $_GET['page'] == 'panel.php') {	
add_action('admin_print_scripts', 'my_admin_scripts'); 
add_action('admin_print_styles', 'my_admin_styles'); 
}
?>