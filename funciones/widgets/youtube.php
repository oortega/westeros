<?php
class YouTube_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'video_widget', 
			'[WP Practical] YouTube',
			array('description' => __('Muestra cualquier video de YouTube colocando solo el ID.'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if(!$title){
		$title = 'YouTube';	
		}
		echo $before_widget; ?>

 <div class="sidetitle"><?php echo $title; ?></div>
  <?php
  $youtubeid =  $instance['youtubeid'];
  echo '<embed src="//www.youtube.com/v/'.$youtubeid.'?version=3&amp;hl=es_MX" type="application/x-shockwave-flash" width="300" height="210" allowscriptaccess="always" allowfullscreen="true" />'; ?>

<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['youtubeid'] = strip_tags($new_instance['youtubeid']);		
		return $instance;
	}

	public function form($instance) {
?>
		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
         </p> 
       	<p>
            <label for="<?php echo $this->get_field_id('youtubeid'); ?>">ID:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('youtubeid'); ?>" name="<?php echo $this->get_field_name('youtubeid'); ?>" type="text" value="<?php echo esc_attr($instance["youtubeid"]); ?>" />
         </p> 
         <?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("YouTube_Widget");'));
?>