<?php
class ADS_Adaptable_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'ads_adaptable', 
			'[WP Practical] ADS Adaptable',
			array('description' => __('Muestra un bloque de anuncio adaptable.'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		echo $before_widget; ?>
  <?php
  $ads_adaptable =  $instance['ads_adaptable'];
  if(ads("ads_adaptable")){
  	echo '<div class="ads_sidebar">'.ads("ads_adaptable").'</div>';
  }
  ?>
<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['ads_adaptable'] = strip_tags($new_instance['ads_adaptable']);		
		return $instance;
	}

	public function form($instance) {
?>
<?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("ADS_Adaptable_Widget");'));
?>