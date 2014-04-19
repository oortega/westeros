<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Por favor, no cargue esta página directamente. ¡Gracias!');
	if ( post_password_required() ) { ?>
		Esta entrada está protegida. Introduzca la contraseña para poder ver los comentarios.
	<?php
		return;
	}
?>
<div id="comentarios_n">
<?php if (have_comments()): ?>
	<h2><?php comments_number('Ningún comentario', '1 Comentario', '% Comentarios' );?> en '<?php the_title() ?>'</h2>
	<ul class="commentlist">
	 <?php wp_list_comments('callback=twentyten_comment'); ?>
	</ul>
 <?php else : ?>
	<?php if ('open' == $post->comment_status): ?>
	 <?php else : ?>
		<p class="nocomments">Los comentarios han sido cerrados.</p>
	<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status): ?>

<?php if (get_option('comment_registration') && !$user_ID): ?>
<p>Debes <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">ingresar</a> para poder comentar.</p>
<?php else: ?>
<section id="respond"></section>
<h2>Dejar mi comentario <span class="cancel-comment-reply"><?php cancel_comment_reply_link("Cancelar respuesta"); ?></span></h2>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<ul class="commentlist">
	<li>
<?php if ($user_ID): ?>

	    <div class="com_avat"><?php echo get_avatar( $comment, 50 ); ?></div>
		<div id="comment-<?php comment_ID(); ?>" class="the_comment">
		<div class="comment-author">
		<div class="comment-body"><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> - <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Cerrar sesión" style="font-size:11px">Cerrar sesión</a><br /><br />
		<textarea id="comment" name="comment" rows="6" onkeyup="limite(this)"></textarea> 
        <input type="submit" name="submit" id="submit" value="Publicar comentario" title="Publicar comentario" class="boton">
        </div>
	</div></div>
<?php else : ?>
<div class="bloque">Nombre:<br /><input type="text" name="author" id="author" maxlength="30" class="input" onfocus="if(this.value=='Anónimo')this.value=''" onblur="if(this.value==0)this.value='Anónimo'" value="<?php echo $comment_author; ?>"  <?php if ($req) echo "aria-required='true'"; ?>/></div>
			<div class="bloque">E-mail:<br /><input id="email" type="email" name="email" maxlength="40" value="<?php echo $comment_author_email; ?>" class="input" <?php if ($req) echo "aria-required='true'"; ?>/></div>   
			<div class="bloque">URL: (Opcional)<br /><input type="text" name="url" id="url" maxlength="40" class="input" value="<?php echo $comment_author_url; ?>" <?php if ($req) echo "aria-required='true'"; ?>/></div>
<textarea id="comment" name="comment" rows="6" onkeyup="limite(this)"></textarea> 
        <input type="submit" name="submit" id="submit" value="Publicar comentario" title="Publicar comentario" class="boton">
<?php endif; ?>    
</li>
</ul>   
             	
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</form>

<?php endif; ?>
</div>
<?php endif; ?>