<?php
	add_filter( 'widget_text', 'do_shortcode');
	
	add_shortcode("hr", "ermark_sc_hr");
	add_shortcode("showcase", "ermark_sc_showcase");
	add_shortcode("map", "ermark_sc_map");
	
	add_shortcode("section", "ermark_sc_section");
	add_shortcode("column", "ermark_sc_column");
	
	add_shortcode("form-contact", "ermark_sc_contact");
	
	add_shortcode("h1", "ermark_sc_h1");
	add_shortcode("h2", "ermark_sc_h2");
	add_shortcode("h3", "ermark_sc_h3");
	add_shortcode("h4", "ermark_sc_h4");
	add_shortcode("h5", "ermark_sc_h5");
	
	add_shortcode("more", "ermark_sc_more");

	function ermark_sc_more ($atts, $content = null ){
		extract(shortcode_atts(array(
			"href" => ''
		), $atts));
		
		return '<a class="more" href="'.$href.'">'.$content.'</a>';
	}
	
	function ermark_sc_h1 ( $atts, $content = null ){
		return '<h1>'.$content.'</h1>';
	}

	function ermark_sc_h2 ( $atts, $content = null ){
		return '<h2>'.$content.'</h2>';
	}
	
	function ermark_sc_h3 ( $atts, $content = null ){
		return '<h3>'.$content.'</h3>';
	}
	
	function ermark_sc_h4 ( $atts, $content = null ){
		return '<h4>'.$content.'</h4>';
	}
	
	function ermark_sc_h5 ( $atts, $content = null ){
		return '<h5>'.$content.'</h5>';
	}
	

	function ermark_sc_hr ( $atts, $content = null ){
		return '<div class="hr"></div>';
	}	
	
	function ermark_sc_action ( $atts, $content = null ){
		return '<div class="hr"></div>';
	}	
	
	function ermark_sc_contact( $atts, $content = null ){
		global $post;
		global  $name_error;
		global  $email_error;
		global  $message_error;
		
		$src = null;

		$mobile = is_mobile();
		
		$src.='<form id="contact-form" action="'.get_permalink().'" method="post">
					<div>
						<label>'.__('Your name').'</label>';
						if(defined('MOBILE-SUBMIT') && $mobile && $name_error != '') {  $src.='<p class="error">'. $name_error.'</p>'; }
					$src.='<div class="input"><input type="text" value="" name="c_name" id="c_name" class="require"/></div>
					</div>
					<div>
						<label>'.__('E-mail address','adora').'</label>';
						if(defined('MOBILE-SUBMIT') && $mobile && $email_error != '') { $src.='<span class="error">'.$email_error.'</span>'; }
					$src.='<div class="input"><input type="text" value="" name="c_email" id="c_email" class="require"/></div>
					</div>
					<div>
						<label>'.__('Website (optional)','adora').'</label>
						<div class="input"><input type="text" name="c_website" id="c_website" value=""/></div>
					</div>
					<div>
						<label>'.__('Your message').'</label>';
						if(defined('MOBILE-SUBMIT') && $mobile && $message_error != '') { $src.='<p class="error">'.$message_error.'</p>';  }
						$src.='<div class="textarea"><textarea name="c_message" id="c_message" rows="5" cols="25" class="require"></textarea></div>
					</div><div>';
					
					if (is_mobile()){
						$src.='<input type="hidden" name="mobile" value="*"/>';
						$src.= '<input type="submit" class="form-button" value="'.__('Send message','adora').'" >';
					}else{
						$src.= '<a href="#" class="form-button submit-contact">'.__('Send message','adora').'</a>';
					}
						
					$src.= '</div>
			</form>
			
			<p class="form-response"></p>';
			
			return do_shortcode($src);
	}
	
	
	function ermark_sc_map($atts, $content){
		global $post;
		
		$wp_metadata = get_post_custom();
		$wp_template = $wp_metadata['_wp_page_template'][0];
		if (is_mobile()){
			extract(shortcode_atts(array(
				"zoom" => 14,
				"location"=>"Bucharest, Romania",
				"width"=>"276",
				"height"=>"145",
				"border"=>true,
				"class"=>'img dspt',
				"alt"=>"Our location",
				"color"=>"blue",
				"marker"=>"",
			), $atts));
		}else{
			extract(shortcode_atts(array(
				"zoom" => 11,
				"location"=>"Bucharest, Romania",
				"width"=>"340",
				"height"=>"185",
				"border"=>true,
				"class"=>'img dspt',
				"alt"=>"Our location",
				"color"=>"blue",
				"marker"=>"",
			), $atts));
		}
		
		if (strlen($marker)>0){
			$code_marker = '&markers=color:'.$color.'|'.$marker;
		}else{
			$code_marker = '&&'.$marker;
		}
		
		$code_url = 'http://maps.google.com/maps/api/staticmap?center='.$location.'&amp;zoom='.$zoom.'&amp;size='.$width.'x'.$height.'&amp;sensor=true'.$code_marker;
		
		if ($border){
			return '<div class="'.$class.'"><img src="'.$code_url.'" alt="'.$alt.'" /></div>';
		}else{
			return '<img src="'.$code_url.'" alt="'.$alt.'" />';
		}
		
	}
	
	function ermark_sc_showcase($atts, $content){
		global $post;
		
		extract(shortcode_atts(array(
			"items" => 8,
			"hrtop" => false,
			"categ" => null,
			"hrbottom" => false,
			"badge" => false, 
			"order" => 'ASC'
		), $atts));
		
		wp_reset_query();
		
		if($categ==null){
			$wp_query = new WP_Query(array( 'post_type' => 'products','orderby' => 'date', 'order' => $order, 'posts_per_page' => $items ));
		}else{
			$wp_query = new WP_Query(array( 'taxonomy' => 'producttype', 'orderby' => 'date', 'order' => $order, 'term' => $categ, 'posts_per_page' => $items,  ));
		}
		
		$wp_metadata = get_post_custom();
		
		$wp_post_cont = 0;
		$wp_row_count = 0; 
		
		$badge_included = false;
		
		 while ($wp_query->have_posts()) : $wp_query->the_post();
			$custom = get_post_custom($post->ID);
			$wp_post_cont++;
			$wp_row_count++;
			
			if ($wp_row_count==1){
				echo '<div class="section articles all-small clearfix">';
				}

			
			if (!is_object(get_the_term_list( $post->ID, 'producttype', $before ='', $sep='', $after='' ))){
				$terms_new = get_the_term_list( $post->ID, 'producttype', $before ='', $sep='', $after='' );
				}
				
			
			echo '<div class="product-post" id="post-'.$post->ID.'">';		
				the_title( '<h2><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' );
				echo '<div class="info">'.$terms_new;
					get_post_rating($post->ID);
				echo '</div>';
				echo '<div class="imgLarge wd205">';
					$arrImages = get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
					if($arrImages) {
						foreach($arrImages as $oImage) {
							$image_url = wp_get_attachment_image_src( $oImage->ID, 'product-showcase');
							echo '<img  width="175" height="230" src="'.$image_url[0].'" alt="" />';
						}
					}
				echo '</div>';
				 
				echo '<p>'.get_the_excerpt().'</p>';
				echo '<a class="more button" href="'.get_permalink().'">'.__('Read more','adora').'</a>';
			echo ' </div>';
			
			if ($wp_row_count == 4){
				$wp_row_count = 0;
				
				if ($badge == "true" && $badge_included == false){
					echo '<div class="badge"></div>';
					$badge_included = true;
				}
			
				echo '</div>';
			}
		endwhile; 		

		if ($wp_row_count > 0 && $wp_row_count < 4 ){  echo '</div>'; }		 
			

	}
	



?>