<?php
class Google_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'google_widget', 
			'[WP Practical] Google',
			array('description' => __('Coloca la URL de tu perfil de Google+ o de tus páginas.'),)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		if(!$title){
		$title = 'Síguenos en Google+';	
		}
		echo $before_widget; ?>

 <div class="sidetitle"><?php echo $title; ?></div>
  <?php
  $google_url =  $instance['google_url'];
  $google_tipo =  $instance['google_tipo'];
  
  echo '<div class="g-'.$google_tipo.'" data-href="'.$google_url.'" data-layout="landscape" data-rel="publisher"></div><script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
<script type="text/javascript">{lang: \'es-419\'}</script>'; 
echo $after_widget;
	}
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['google_url'] = strip_tags($new_instance['google_url']);	
		$instance['google_tipo'] = strip_tags($new_instance['google_tipo']);		
		return $instance;
	}

	public function form($instance) {
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
        </p>
        <p>
            <?php if(esc_attr($instance["google_tipo"]) == "page"){ $marcar = ' selected="selected"'; } ?>
            <label for="<?php echo $this->get_field_id('google_tipo'); ?>">Tipo:</label>
            <select name="<?php echo $this->get_field_name('google_tipo'); ?>">
             <option value="person">Persona</option>
             <option value="page" <?php echo @$marcar; ?>>Página</option>
            </select>
        </p> 
       	<p>
            <label for="<?php echo $this->get_field_id('google_url'); ?>">URL:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('google_url'); ?>" name="<?php echo $this->get_field_name('google_url'); ?>" type="text" value="<?php echo esc_attr($instance["google_url"]); ?>" />
         </p> 
         <?php 
	}
}
add_action('widgets_init', create_function('', 'register_widget("Google_Widget");'));

?>