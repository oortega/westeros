<?php
class Twitter_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'twitter_widget', 
			'[WP Practical] Twitter',
			array('description' => __('Coloca tu nombre de usuario y muestra el botón de Twitter para que te sigan.'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if(!$title){
		$title = 'Síguenos en Twitter';	
		}
		echo $before_widget; ?>

 <div class="sidetitle"><?php echo $title; ?></div>
  <?php
  $twitter_usuario =  $instance['twitter_usuario'];  
  
  echo '<a href="https://twitter.com/'.$twitter_usuario.'" class="twitter-follow-button" data-show-count="true" data-lang="es" data-size="large" data-dnt="true">Seguir a @'.$twitter_usuario.'</a>
  <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>'; ?>	

<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_usuario'] = strip_tags($new_instance['twitter_usuario']);	
		return $instance;
	}

	public function form($instance) {
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
        </p>
       	<p>
            <label for="<?php echo $this->get_field_id('twitter_usuario'); ?>">Usuario:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_usuario'); ?>" name="<?php echo $this->get_field_name('twitter_usuario'); ?>" type="text" value="<?php echo esc_attr($instance["twitter_usuario"]); ?>" />
         </p> 
         <?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("Twitter_Widget");'));
?>