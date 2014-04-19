<?php
class ADS_300X600_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'ads_300x600', 
			'[WP Practical] ADS 300x600',
			array('description' => __('Muestra un bloque de anuncio de 300x600'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		echo $before_widget; ?>
  <?php
  $ads_300x600 =  $instance['ads_300x600'];
  if(ads("ads_300x600")){
  	echo '<div class="ads_300x600">'.ads('ads_300x600').'</div>';
  }
  ?>
<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['ads_300x600'] = strip_tags($new_instance['ads_300x600']);		
		return $instance;
	}

	public function form($instance) {
?>
<?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("ADS_300X600_Widget");'));
?>