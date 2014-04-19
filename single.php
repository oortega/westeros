<?php get_header(); ?>
  <div id="wrapper">
   <div id="contenido">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="bread" itemscope><span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a title="<?php bloginfo("name"); ?>" href="<?php bloginfo("url"); ?>" itemprop="url" class="category"><span itemprop="title">Home</span></a></span> » <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a title="<?php $cats = get_the_category(); echo $cats[0]->name; ?>" href="<?php $category_link = get_category_link($cats[0]->cat_ID); echo esc_url($category_link); ?>" itemprop="url"><span itemprop="title"><?php $cats = get_the_category(); echo $cats[0]->name; ?></span></a></span> » <span itemprop="title"><?php the_title(); ?></span></div>
    
    <ul class="botones_sociales">
        <li><div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div></li>
        
        <li><a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="<?php the_permalink() ?>" data-lang="es" data-text="<?php the_title(); ?>">Tweet</a></li>
        <li><div class="g-plus" data-action="share" data-href="<?php the_permalink(); ?>" data-annotation="vertical-bubble"></div></li>
       </ul>
        
      <h1 class="tp"><?php the_title(); ?></h1>
      <div class="meta"><b>Por: </b><?php the_author_link(); ?> <b>Fecha: </b><?php the_time('F') ?> <?php the_time('j') ?>, <?php the_time('Y') ?> <b>Categoría: </b><?php $cats = get_the_category();
echo $cats[0]->name; ?> <b>Comentarios: </b><?php comments_number('0', '1', '%' ); ?></div>
       <?php if(get_option("wppractical_estrellas") == "" || get_option("wppractical_estrellas") == "si" && get_option("wppractical_estrellas_posicion") == "top"){
		   if(function_exists('the_ratings')) { the_ratings(); } 
	   } ?>
       <?php if(ads("ads_adaptable")) echo '<div class="ads_ad">'.ads("ads_adaptable").'</div>'; else if(ads("ads_336x280")) echo '<div class="ads_336x280">'.ads("ads_336x280").'</div>'; ?>
        <?php if(ads("ads_468x15")) echo '<div class="ads_468x15">'.ads("ads_468x15").'</div>'; ?>
       <div class="entry"><?php the_content(); ?></div>       
       <?php if(ads("ads_468x15")) echo '<div class="ads_468x15">'.ads("ads_468x15").'</div>'; ?>
       <?php if(ads("ads_adaptable")) echo '<div class="ads_ad">'.ads("ads_adaptable").'</div>'; else if(ads("ads_336x280")) echo '<div class="ads_336x280">'.ads("ads_336x280").'</div>'; ?>
       <?php if(get_option("wppractical_estrellas") == "" || get_option("wppractical_estrellas") == "si" && get_option("wppractical_estrellas_posicion") == "bottom"){
		   if(function_exists('the_ratings')) { the_ratings(); } 
	   } ?>
	   <?php
        $post_tags = wp_get_post_tags($post->ID);
		if(!empty($post_tags)) {
			?>
			<div class="etiquetas"><?php the_tags('<b>Etiquetas: </b>', ', '); ?></div>
		<?php } ?>    
       
		  <?php
           $cat = get_the_category(); 
		   $cat = $cat[0]; 
		   $cat = $cat->cat_ID;
		   $post = get_the_ID();
		   $args = array('cat'=>$cat, 'showposts' => 4,'post__not_in' => array($post));
		   $related = new WP_Query($args); 
		   if($related->have_posts()) {
		 echo '<div id="relacionados">
		 <h2>¡Esto también te puede interesar!</h2>	
           <ul>'; 		   
		   while($related->have_posts()) : $related->the_post();
		   if(has_post_thumbnail()){
			   $thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'pequeño');
			   if(!$thumb_src['3']){
				$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');   
			   }
			   $src = $thumb_src['0'];
		   } else {
			   $src = catch_that_image();
			 }		    
			 ?>
             <li><img src="<?php echo $src; ?>" alt="<?php the_title(); ?>" /><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
             </li>
			 <?php endwhile; ?>
           </ul></div>
		   <?php } else {
			   
			   $cat = get_the_category(); 
		   $cat = $cat[0]; 
		   $cat = $cat->cat_ID;
		   $post = get_the_ID();
		   $args = array('orderby' => 'rand', 'showposts' => 4,'post__not_in' => array($post));
		   $related = new WP_Query($args); 
		   if($related->have_posts()) {
		 echo '<div id="relacionados">
		 <h2>¡Esto también te puede interesar!</h2>	
           <ul>'; 		   
		   while($related->have_posts()) : $related->the_post();
		   if(has_post_thumbnail()){
			   $thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'pequeño');
			   if(!$thumb_src['3']){
				$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');   
			   }
			   $src = $thumb_src['0'];
		   } else {
			   $src = catch_that_image();
			 }		    
			 ?>
             <li><img src="<?php echo $src; ?>" alt="<?php the_title(); ?>" /><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
             </li>
			 <?php endwhile; ?>
           </ul></div>
			   
			   
			   <?php } }wp_reset_query(); ?>
    
        <div id="comentarios">
        
        <a href="javascript:comentar_fb()" style="text-align:center; padding:10px; background:#1A478C; color:#FFF; font-weight:bold; display:block; width:100%">Publicar mi reseña en Facebook</a>
        <div class="fb-comments" id="comentar_fb" data-href="<?php the_permalink() ?>" data-numposts="5" data-colorscheme="light"></div>
        
     <?php comments_template(); ?>    
        </div>
     </div>     
	<?php endwhile; endif; ?>
   </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>