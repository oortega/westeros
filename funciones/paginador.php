<?php
function paginador($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<div class="paginador">', 'after' => '</div>',
		'title' => '',
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);
	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);
	if (!$page && !$pages) {
		global $wp_query;
		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}	
	$output = "";
	if ($pages > 1) {	
		$output .= $before.'<span class="titulo">'.$title.'</span>';
		$ellipsis = '<span class="mas">...</span>';
		if ($page > 1 && !empty($previouspage)) {
			$output .= '<a href="'.get_pagenum_link($page - 1).'" class="anterior">'.$previouspage.'</a>';
		}		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;
		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				paginador_loop(1, $anchor), 
				$ellipsis, 
				paginador_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				paginador_loop(1, $anchor), 
				$ellipsis, 
				paginador_loop($block_min, $block_high, $page), 
				$ellipsis, 
				paginador_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				paginador_loop(1, $block_high, $page),
				$ellipsis,
				paginador_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= paginador_loop(1, $pages, $page);
		}
		if ($page < $pages && !empty($nextpage)) {
			$output .= '<a href="'.get_pagenum_link($page + 1).'" class="siguiente">'.$nextpage.'</a>';
		}
		$output .= $after;
	}
	if($echo) {
		echo $output;
	}
	return $output;
}

function paginador_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? '<span class="est">'.$i.'</span>'
			: '<a href="'.get_pagenum_link($i).'" class="paginas" title="Página '.$i.'">'.$i.'</a>';
	}
	return $output;
}
?>