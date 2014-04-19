<?php
class ADS_300X250_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'ads_300x250', 
			'[WP Practical] ADS 300x250',
			array('description' => __('Muestra un bloque de anuncio de 300x250'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		echo $before_widget; ?>
  <?php
  $ads_300x250 =  $instance['ads_300x250'];
  if(ads("ads_300x250")){
  	echo '<div class="ads_300x250">'.ads("ads_300x250").'</div>';
  }
  ?>
<?php
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['ads_300x250'] = strip_tags($new_instance['ads_300x250']);		
		return $instance;
	}

	public function form($instance) {
?>
<?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("ADS_300X250_Widget");'));
?>