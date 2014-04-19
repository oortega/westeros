<?php
class mas_comentadas_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'mas_comentadas', 
			'[WP Practical] Las 5 más comentadas',
			array('description' => __('Muestra los cinco posts más comentados.'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if(!$title){
		$title = 'Más comentadas';	
		}
		echo $before_widget;?>
<div class="mas_comentadas">
 <div class="sidetitle"><?php echo $title; ?></div>
<?php
global $wpdb;
$request = "SELECT ID, post_title, 
CONCAT((SELECT meta_value FROM $wpdb->postmeta WHERE $wpdb->posts.ID=$wpdb->postmeta.post_id AND $wpdb->postmeta.meta_key='_yoast_wpseo_metadesc')) AS 'descripcion', COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT 0, 5";

$posts = $wpdb->get_results($request);
$n = 1;
foreach ($posts as $post) {
$x = $n++;
$post_title = stripslashes($post->post_title);
$comment_count = $post->comment_count;
$permalink = get_permalink($post->ID);
$descripcion = $post->descripcion;


		if(has_post_thumbnail($post->ID)){
         $url_imagen = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'miniatura');
		 $url_imagen = $url_imagen['0'];
		 $src_t = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
		} else {
			$args = array(
						'post_type' => 'attachment',
						'numberposts' => 1,
						'post_status' => null,
						'post_parent' => $post->ID
			); 				
			$attachments = get_posts($args);
			
			if ($attachments) {
				foreach ($attachments as $attachment) {
					$img  = wp_get_attachment_image_src($attachment->ID,array(50, 50));	
					$url_imagen = $img['0'];				
				}
			} else {unset($url_imagen);
			$url_imagen = catch_that_image();}
			
			
		}		

		$alt_imagen = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
		 echo '<div class="box_">';
		 if($url_imagen){?>
         <img src="<?php echo $url_imagen; ?>" width="50" height="50" alt="<?php echo @$src_t; ?>" />
         <?php } ?>
<?php echo '<a href="'.$permalink.'" title="'.$post_title.'">'.$post_title.'</a><br /><span class="fecha">'.get_the_time('d/m/Y').'</span></div>';
}
?>
</div>
 
<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	public function form($instance) {	
		?>
		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
         </p> 
         <?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("mas_comentadas_Widget");'));
?>