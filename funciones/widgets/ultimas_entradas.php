<?php
class ultimas_entradas_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'ultimas_entradas_widget', 
			'[WP Practical] Últimas entradas',
			array('description' => __('Muestra las últimas entradas de tu sitio'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if(!$title){
		$title = 'Últimas entradas';	
		}
		echo $before_widget; ?>

 <div class="sidetitle"><?php echo $title; ?></div>
 <div class="ultimas_entradas">
  <?php
  global $post;
  $n = 0;
  $postslist = get_posts(array('numberposts' => $instance['cantidad'], 'orderby' => 'post_date'));
  foreach( $postslist as $post ) : setup_postdata($post);
	   echo '<div class="box_">';
  $url_imagen = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'miniatura');
  $url_imagen = $url_imagen['0'];
  $alt_imagen = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
  ?>
  <img src="<?php echo $url_imagen ?>" alt="<?php echo @$alt_imagen; ?>" width="50" height="50" /><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><br /><span class="fecha"><?php echo get_the_time('d/m/Y') ?></span></div>
  <?php endforeach; ?>
  </div> 
<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cantidad'] = strip_tags($new_instance['cantidad']);
		if(!is_numeric(strip_tags($new_instance['cantidad']))){
			$instance['cantidad'] = '0';
		}		
		return $instance;
	}
	public function form($instance) {		
		?>
		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
         </p> 
         <p>
            <label for="<?php echo $this->get_field_id('cantidad'); ?>">Número de entradas a mostrar:</label>
            <input id="<?php echo $this->get_field_id('cantidad'); ?>" name="<?php echo $this->get_field_name('cantidad'); ?>" type="text" value="<?php if(esc_attr($instance["cantidad"])) echo esc_attr($instance["cantidad"]); else echo '5'; ?>" size="3" maxlength="2" />
         </p> 
         <?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("ultimas_entradas_Widget");'));
?>