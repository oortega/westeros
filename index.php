<?php get_header(); ?>
  <div id="wrapper">
    <div class="superior">
    <h1 class="p"><?php if(is_archive()){ ?>
    <?php 
 	if(is_tag()){
 	echo 'TAG: '; ?>
 	<?php single_tag_title(); ?>	
 	<?php } 
 	if(is_year()){
 	echo 'Artículos: '; ?> 	
    <?php the_time('Y'); ?>	    
    <?php } 
 	if(is_month()){
 	echo 'Artículos: '; ?>
 	<?php the_time('F, Y'); ?>	
    <?php } 
 	if(is_author()){
 	echo 'Artículos de: '; ?>
 	<?php the_author(); ?>	
 	<?php } 
 	if(is_category('')){ ?>
    <?php single_cat_title(); ?>	
 	<?php } ?>
    <?php } else {
	if(get_option("wppractical_titulo")){
		echo get_option("wppractical_titulo");
	} else {
	echo "Últimos artículos"; }
	}?></h1> </div>  
	<?php 
	$n = 0;
	if (have_posts()) : while (have_posts()) : the_post(); 
	$contador = $n++;
	if($contador == 0){
		if(ads("ads_adaptable")) echo '<div class="ads_ad">'.ads("ads_adaptable").'</div>'; else if(ads("ads_336x280")) echo '<div class="ads_336x280">'.ads("ads_336x280").'</div>';
	} 
	if($contador == 4){
		echo '<div class="cod">0e5cdf679d1a555578018850868cf751f8a613c4</div>';	
	}?>
    <div class="bloque">
     <h2 class="tp2"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
      <div class="meta"><b>Por: </b><?php the_author_link(); ?> <b>Fecha: </b><?php the_time('F') ?> <?php the_time('j') ?>, <?php the_time('Y') ?> <b>Categoría: </b><?php $cats = get_the_category();
echo $cats[0]->name; ?> <b>Comentarios: </b><?php comments_number('0', '1', '%' ); ?></div>
       <div class="all">
	    <?php
		if(has_post_thumbnail()){
         $thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
		 $src = $thumb_src['0'];
		 $src_t = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
		} else {
			$args = array(
						'post_type' => 'attachment',
						'numberposts' => 1,
						'post_status' => null,
						'post_parent' => $post->ID
			); 				
			$attachments = get_posts($args);
			
			if ($attachments) {
				foreach ($attachments as $attachment) {
					$img  = wp_get_attachment_image_src($attachment->ID,array(150, 150));	
					$src = $img['0'];				
				}
			} else {unset($src);
			$src = catch_that_image();}
		}		
		 if($src){?>
         <img src="<?php echo $src; ?>" alt="<?php echo @$src_t; ?>" />
         <?php } ?>
		 <?php the_excerpt(); ?>
       </div>
    </div>
	<?php endwhile; ?>
	<?php paginador(); ?>
	<?php endif; ?>
  </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>