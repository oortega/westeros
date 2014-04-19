<?php
if (!function_exists('twentyten_comment')):
function twentyten_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ($comment->comment_type):
		case '' :
		?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	    <div class="com_avat"><?php echo get_avatar( $comment, 50 ); ?></div>
		<div id="comment-<?php comment_ID(); ?>" class="the_comment">
		<div class="comment-author"><span class="fecha"><?php printf( __( '%1$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></span>
		<?php if ($comment->comment_approved == '0'): ?>
			<p class="moderar">Tu comentario está pendiente a moderación.</p>
		<?php endif; ?>
		<div class="comment-body"><b><?php printf( __( '%s:', 'twentyten' ), sprintf( '%s', get_comment_author_link() ) ); ?></b>
		<?php comment_text(); ?>
        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
	</div></div>
	<?php break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	    <div class="com_avat"><?php echo get_avatar( $comment, 50 ); ?></div>
		<div id="comment-<?php comment_ID(); ?>" class="the_comment">
		<div class="comment-author"><span class="fecha"><?php printf( __( '%1$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></span>
		<?php if ($comment->comment_approved == '0'): ?>
			<p class="moderar">Tu comentario está pendiente a moderación.</p>
		<?php endif; ?>
		<div class="comment-body"><?php printf( __( '%s:', 'twentyten' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		<?php comment_text(); ?>
        </div>
	</div></div>
<?php break; endswitch;
}
endif;
?>