<?php
/**
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */
?>


<?php get_header(); ?>

		<?php 
			if (get_option('ermad_frontslider')=='true'){
			$template_dir = get_bloginfo('template_directory');
			
			wp_reset_query();
			$wp_slider_query = new WP_Query(array( 'post_type' => 'slide', 'posts_per_page' => -1, 'post_status' => 'publish', 'orderby'=>'DATE', 'order'=>'ASC' ));
			$wp_slide_count = 0;
			
			$slider_err = null;
			
			if ($wp_slider_query->post_count){
					echo '
					<div class="section" id="slider">
						<div id="slider-wrapper">
						<div class="img-wrapper" id="slides">';
			
						
						 while ($wp_slider_query->have_posts()) : $wp_slider_query->the_post();		
								$wp_slide_count++;
								$custom = get_post_custom($post->ID);
								 
								$image_id = get_post_thumbnail_id();  
								$image_url = wp_get_attachment_image_src($image_id,'article-slider');  
								
								if (array_key_exists('slide_url', $custom)){
									$slide_url = $custom["slide_url"][0];
								}else{
									$slide_url = '#';
								}
								
								if (array_key_exists('slide_link_title', $custom)){									
									$slide_link_title = $custom["slide_link_title"][0];
								}else{
									$slide_link_title = __('more', 'adora');
								}
							
								if ($image_id){
									if (get_option('ermad_sliderlinks')=='true'){
										echo '<a href="'.$slide_url.'" title="'.$slide_link_title.'"><img src="'.$image_url[0].'" alt="slide-'.$wp_slide_count.'" /></a>';				
									}else{
										echo '<img src="'.$image_url[0].'" alt="slide-'.$wp_slide_count.'" />';				
									}
								}else{
									$slider_err .= '<div class="error">Error : Slide <strong>"'.get_the_title().'"</strong> does not have a featured image!</div>';
								}
						 endwhile; 		 
						 
					echo '
						</div>
						</div>
						<div class="pager"></div>
					</div>';
					
			}else{
				$slider_err .= '<div class="error">Error : There are no slides published to show!</div>';
			}
			
			if ($slider_err != null){
				echo $slider_err;
			}
		}
		
		?>
		
		
		<?php 
		/*
			if (get_option('ermad_frontslider')=='true'){
			$template_dir = get_bloginfo('template_directory');
			
			echo '
			<div class="section" id="slider">
				<div id="slider-wrapper">
				<div class="img-wrapper" id="slides">';
	
				wp_reset_query();
				$wp_query = new WP_Query(array( 'post_type' => 'post', 'category_name'=>'slider', 'orderby'=>'date', 'order'=>'ASC'));
				 while ($wp_query->have_posts()) : $wp_query->the_post();		
				 
						$image_id = get_post_thumbnail_id();  
						$image_url = wp_get_attachment_image_src($image_id,'article-slider');  
					
						if (get_option('ermad_sliderlinks')=='true'){
							echo '<a href="'.get_permalink($post->ID).'"><img src="'.$image_url[0].'" alt="" /></a>';				
						}else{
							echo '<img src="'.$image_url[0].'" alt="" />';				
						}
				 endwhile; 		
				 
			echo '
				</div>
				</div>
				<div class="pager"></div>
			</div>';
		}
		*/
		?>
		
		
		<?php if (get_option('ermad_toaction_enabled')=='true'){
				echo '
				<div class="section clearfix">
					<h3 class="info">'.stripslashes_deep(get_option('ermad_toaction_text')).'</h3>
					<a href="'.get_option('ermad_toaction_link').'" class="collection">'.stripslashes_deep(get_option('ermad_toaction_label')).'</a>
				</div>
				<div class="section hr"></div>';
			}
		?>
		
		
		<?php 
			$view_badge = get_option('ermad_frontshowcase_badge', false);
			do_shortcode('[showcase items='.get_option('ermad_frontshowcase_items', 4).' badge='.$view_badge.' ]');
		?>
		<!-- <div class="badge"></div> -->
		
<?php get_footer(); ?>
