<?php 

	add_action('init', 'ewf_register_type_slide');
	
	add_action('admin_menu'	, 'ewf_slide_meta_install');
	add_action('save_post'	, 'ewf_slide_meta_update');
	
	add_post_type_support('slide', 'post-thumbnails');
	
	function ewf_register_type_slide() {
		register_post_type('slide', 
		
			array(
			'labels' => array(
				'name' 					=> __( 'Slides'						,'adora' ),
				'singular_name' 		=> __( 'Slide'						,'adora' ),
				'add_new' 				=> __( 'Add New'					,'adora' ),
				'add_new_item' 			=> __( 'Add New Slide'				,'adora' ),
				'edit' 					=> __( 'Edit'						,'adora' ),
				'edit_item' 			=> __( 'Edit Slide'					,'adora' ),
				'new_item' 				=> __( 'New Slide'					,'adora' ),
				'view' 					=> __( 'View Slide'					,'adora' ),
				'view_item' 			=> __( 'View Slide'					,'adora' ),
				'search_items' 			=> __( 'Search Slides'				,'adora' ),
				'not_found' 			=> __( 'No slides found'			,'adora' ),
				'not_found_in_trash' 	=> __( 'No slides found in Trash'	,'adora' ),
				'parent' 				=> __( 'Parent slides'				,'adora' ),
				),
			'public' 	=> true,
			'rewrite' 	=> false, 
			'slug'		=> 'slide',
			'show_ui' 	=> true,
			'supports' 	=> array('title', 'thumbnail')
			));
	}
	
	function ewf_slide_meta_install() {
		 add_meta_box( 'ewf_slides_meta',__('Slides settings'), 'ewf_slide_meta_source', 'slide', 'normal', 'high' );
	}

	function ewf_slide_meta_update() {
		global $post;
		update_post_meta($post->ID, "slide_url", $_POST["slide_url"]);
		update_post_meta($post->ID, "slide_link_title", $_POST["slide_link_title"]);
	}
 
	function ewf_slide_meta_source() {
			global $post;
			
			$custom = get_post_custom($post->ID);
		
			$slide_url = $custom["slide_url"][0];
			$slide_link_title = $custom["slide_link_title"][0];
			
			if ($slide_link_title == null){
				$slide_link_title = 'more';
				}
			
			echo '
			<div style="padding-top:10px;">
				<label style="display:block;padding:2px;">'.__('Slide URL', 'adora').': </label><input style="width:220px;" name="slide_url" value="'.$slide_url.'">
			</div>
			
			<div style="padding-top:10px;">
				<label style="display:block;padding:2px;">'.__('Link Title', 'adora').': </label><input style="width:220px;" name="slide_link_title" value="'.$slide_link_title.'" />
			</div>';
	}


?>