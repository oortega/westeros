<?php
class Feedburner_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'feedburner_widget', 
			'[WP Practical] Feedburner',
			array('description' => __('Si estás registrado en Feedburner, entonces coloca el nombre de tu feed.'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if(!$title){
		$title = 'Suscríbete';	
		}
		echo $before_widget; ?>

 <div class="sidetitle"><?php echo $title; ?></div>
  <?php
  $feedburner =  $instance['feedburner'];
  $feedburner_des =  $instance['feedburner_des'];
  echo $feedburner_des;
  echo '<form id="feedburner" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='.$feedburner.'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">
<input class="feedburner-email" type="email" name="email" value="Coloca tu email" onfocus="if (this.value == \'Coloca tu email\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Coloca tu email\';}">
<input type="hidden" value="'.$feedburner.'" name="uri">
<input type="hidden" name="loc" value="es_LA">
<input class="feedburner-subscribe" type="submit" name="submit" value="Suscribirme">
</form>'; ?>
 
<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['feedburner'] = strip_tags($new_instance['feedburner']);	
		$instance['feedburner_des'] = strip_tags($new_instance['feedburner_des']);	
		return $instance;
	}

	public function form($instance) {
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Descripción:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('feedburner_des'); ?>" name="<?php echo $this->get_field_name('feedburner_des'); ?>" maxlength="150"><?php echo esc_attr($instance["feedburner_des"]); ?></textarea>
       	</p> 
       	<p>
            <label for="<?php echo $this->get_field_id('feedburner'); ?>">Feed:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('feedburner'); ?>" name="<?php echo $this->get_field_name('feedburner'); ?>" type="text" value="<?php echo esc_attr($instance["feedburner"]); ?>" />
         </p> 
         <?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("Feedburner_Widget");'));
?>