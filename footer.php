</div>

</div>
<div id="footer">
 <div class="contenido">
  <?php if(get_option('wppractical_footer_menu') == "si") { wp_nav_menu(array('theme_location' => 'menu')); } ?>
  <?php if(!get_option('wppractical_texto_footer')){ ?>
 &copy; Todos los derechos Reservados <?php echo date("Y"); ?>
  <?php } else echo stripslashes(get_option('wppractical_texto_footer'));
  if(get_option('wppractical_url_perfil_google')){
	echo '- <a href="'.get_option('wppractical_url_perfil_google').'" rel="author">'.get_option('wppractical_nombre_perfil_google').'</a>';  
  } ?>
 </div>
</div>
<?php wp_footer(); ?>
<?php echo stripslashes(get_option('wppractical_footer_codigos')); ?>
<?php if(!is_home()) { ?>
<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/funciones/coment.js"></script>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
<script type="text/javascript">{lang: 'es-419'}</script>
<?php } ?>
</body>
</html>