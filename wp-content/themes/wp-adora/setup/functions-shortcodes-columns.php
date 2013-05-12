<?php

	@ini_set('pcre.backtrack_limit', 500000);
	
	add_shortcode("section", "ermark_sc_section");
	add_shortcode("column", "ermark_sc_column");
	
	
	function ermark_sc_section ( $atts, $content = null ){
		global $post;
		
		$wp_metadata = get_post_custom();
		$wp_template = null;
		
		if (array_key_exists('_erm-page-layout',$wp_metadata) && $wp_template == null){
			$wp_template = $wp_metadata['_erm-page-layout'][0];
		}
		
		if (array_key_exists('_wp_page_template', $wp_metadata) && $wp_template == null){
			$wp_template = $wp_metadata['_wp_page_template'][0];
		}
		
		$class = null;
		
		extract(shortcode_atts(array(
			"columns" => 2
		), $atts ));
		
		switch($wp_template){
			case 'page-contact.php':
				$class = "medColumns clearfix";
				break;
			
			default:
				$class = "columns-0".$columns." clearfix";
				break;
		}
		
		return '<div class="'.$class.'">'. do_shortcode($content) . '</div>';
	}
	
	function ermark_sc_column ( $atts, $content ){
		return '<div>' . do_shortcode($content) . '</div>';
	}
	
	if ( !function_exists('ermark_shortcode_fix') ) :
		function ermark_shortcode_fix($content) {
			$new_content = '';
			
			$pattern_full = '{(\[raw\].*?\[/raw\])}is';
			$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
			$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
			
			foreach ($pieces as $piece) {
				if (preg_match($pattern_contents, $piece, $matches)) {
					$new_content .= $matches[1];
				} else {
					$new_content .= wptexturize(wpautop($piece));		
				}
			}
			
			return $new_content;
		}

		remove_filter('the_content', 'wpautop');
		remove_filter('the_content', 'wptexturize');

		add_filter('the_content', 'ermark_shortcode_fix', 99);
		add_filter('widget_text', 'ermark_shortcode_fix', 99);

	endif;

?>