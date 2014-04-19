<?php
class Facebook_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'facebook_widget', 
			'[WP Practical] Facebook',
			array('description' => __('Coloca la URL de tu fanpage y muestra los usuarios que le han dado me gusta.'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if(!$title){
		$title = 'Facebook';	
		}
		echo $before_widget; ?>

 <div class="sidetitle"><?php echo $title; ?></div>
  <?php
  $face_url =  $instance['face_url'];
  echo '<div class="fb-like-box" data-href="'.$face_url.'" data-width="300" data-height="400" data-show-faces="true" data-stream="false" data-show-border="false" data-header="false"></div>
';
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['face_url'] = strip_tags($new_instance['face_url']);		
		return $instance;
	}
	public function form($instance) {
?>
		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
         </p> 
       	<p>
            <label for="<?php echo $this->get_field_id('face_url'); ?>">URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('face_url'); ?>" name="<?php echo $this->get_field_name('face_url'); ?>" type="text" value="<?php echo esc_attr($instance["face_url"]); ?>" />
         </p> 
         <?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("Facebook_Widget");'));
?>