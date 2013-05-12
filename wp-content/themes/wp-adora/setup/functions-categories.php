<?php
	add_action('admin_menu', 'ewf_categsMetaBox');
	
	add_action('admin_head', 'ewf_categsMetaRequires');
	add_action('admin_init', 'ewf_categsMetaInitialize');
	
	add_action('save_post', 'ewf_categsMetaBoxSettingsUpdate');
		
	
	function ewf_categsMetaInitialize(){
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-dropable');
		wp_enqueue_script('jquery-ui-dragable');
		wp_enqueue_script('jquery-ui-sortable');
	}
	
	function ewf_categsMetaBox() {
		global $post;
		
		if (is_array($_GET) && array_key_exists('post', $_GET)){
			$post_id = intval($_GET['post']);
			$custom = get_post_custom($post_id); 
		
			if (array_key_exists('_wp_page_template', $custom) && $custom['_wp_page_template'][0] == 'page-prices.php' )
				add_meta_box( 'ewf-categs-order',__('Categories Setup',EWF_SETUP_THEME_DOMAIN), 'ewf_categsMetaBoxCode', 'page', 'normal', 'high');
				
		}
	}
	
	
	function ewf_categsMetaBoxSettingsUpdate() {
		global $post;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post->ID;
		}
		 
		update_post_meta($post->ID, "_ewf-categs-array", $_POST["ewf-categs-array"]);
	}

	function ewf_categsMetaBoxCode() {
			global $post;
					
			$categ_count = 0;
			$ewf_categs_array = null;
			
			$custom = get_post_custom($post->ID);
			$categories = get_categories('orderby=count&hide_empty=0&taxonomy=producttype');
			
			/*
			echo '<pre>';
				print_r($custom);
			echo '</pre>';
			
			*/
			
			if (array_key_exists('_ewf-categs-array',$custom)){
				$ewf_categs_array = $custom["_ewf-categs-array"][0];
				} 
			
			
			$ewf_tmp_categs_array = explode(',',$ewf_categs_array);
			$ew_categs_final = array();
			
			foreach($ewf_tmp_categs_array as $key=>$value){ 
				$ew_categs_final[$value] = null;
			}
			
			//$ewf_tmp_categs_array = $ew_categs_final;
			/*
			echo '<pre>';
				print_r($ewf_tmp_categs_array);
				print_r($ew_categs_final);
			echo '</pre>';
			*/
			
			//echo '['.$ewf_categs_array.']';
			
			echo '<div class="clearfix">';
				echo '<ul class="ewf-categs-meta-list">';
				
				
				foreach ($categories as $categ) {
					$categ_count++; 
					
					if (!array_key_exists($categ->cat_ID, $ew_categs_final) && $ewf_categs_array != null){ 
						echo '<li class="removed">
								<a href="categ_'.$categ_count.'" rel="'.$categ->cat_ID.'">'.$categ->name.'</a>
								<div></div>
							</li>';
					}else{
						echo '<li>
								<a href="categ_'.$categ_count.'" rel="'.$categ->cat_ID.'">'.$categ->name.'</a>
								<div></div>
							</li>';
					}
				}
				 
				echo '</ul>';
			echo '</div>';
			
			echo '<input type="hidden" id="ewf-categs-array" name="ewf-categs-array" value="'.$ewf_categs_array.'" />';
			echo '<pre>';
				print_r( json_decode($ewf_categs_array) );
			echo '</pre>';
	} 
	
	function ewf_categsMetaRequires(){
		echo '
		<style>
		
			/*----- Metabox - Categories -----*/			
				.ewf-categs-meta-list 					{ margin:0;padding:0;list-style-type:none; }
				.ewf-categs-meta-list li 				{ background:grey;height:25px;margin-bottom:2px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;background: url("../images/gray-grad.png") repeat-x scroll left top #DFDFDF;text-shadow: 0 1px 0 #FFFFFF;line-height:25px;padding-left:23px;position:relative;cursor:pointer; } 
				.ewf-categs-meta-list li:hover 			{ background:#DFDFDF url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAPpJREFUeNpi/P//PwMlgImBQjAMDGBB5qxkZGRgZGDwADJbgLjmDwPDDhYkPjC4d4SjBTqKC4AaGH4DFYeWlBiDaKDSamT+H2xOAEUjDM8H8ucBbZzLwHDmR3Lyf2R6IQOD8SI09SCM4oVvEGoHEBvPnTuXIdrbG0SfBbpk6Q8GhrP/CAXiV4ghHt8ZGAKDDQ2N52zdehZEAzVH/4eEBX4vKAH5zUDnPpSV/Q+ikxkYCpH5Sli8gMphYJCzZmBIygQqlmVg8Afype0ZGKJAfCsGhhQgXxHdAEbkvMDIyMgPpDigXvsFiRQwmx1K/wCqf4/sA8ahn5kAAgwAg/CW/Vmop9QAAAAASUVORK5CYII=) no-repeat 4px 4px; } 
				 
				.ewf-categs-meta-list li.removed 		{ background:#DFDFDF url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAPpJREFUeNpi/P//PwMlgImBQjAMDGBB5qxkZGRgZGDwADJbgLjmDwPDDhYkPjC4d4SjBTqKC4AaGH4DFYeWlBiDaKDSamT+H2xOAEUjDM8H8ucBbZzLwHDmR3Lyf2R6IQOD8SI09SCM4oVvEGoHEBvPnTuXIdrbG0SfBbpk6Q8GhrP/CAXiV4ghHt8ZGAKDDQ2N52zdehZEAzVH/4eEBX4vKAH5zUDnPpSV/Q+ikxkYCpH5Sli8gMphYJCzZmBIygQqlmVg8Afype0ZGKJAfCsGhhQgXxHdAEbkvMDIyMgPpDigXvsFiRQwmx1K/wCqf4/sA8ahn5kAAgwAg/CW/Vmop9QAAAAASUVORK5CYII=) no-repeat 4px 4px; } 
				.ewf-categs-meta-list div				{ display:none;background:url(data:image/gif;base64,R0lGODlhEAALAPQAAP///wAAANra2tDQ0Orq6gYGBgAAAC4uLoKCgmBgYLq6uiIiIkpKSoqKimRkZL6+viYmJgQEBE5OTubm5tjY2PT09Dg4ONzc3PLy8ra2tqCgoMrKyu7u7gAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCwAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQJCwAAACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQJCwAAACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQJCwAAACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAkLAAAALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkECQsAAAAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAkLAAAALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkECQsAAAAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA) no-repeat center center;height:16px;width:16px;position:absolute;right:5px;top:5px; }
				
				.ewf-categs-meta-holder 				{ background:#FFFFE0 !important; }
				
				#ewf-categs-array { width:100%; }
				
		</style>';

	}
	
	?>