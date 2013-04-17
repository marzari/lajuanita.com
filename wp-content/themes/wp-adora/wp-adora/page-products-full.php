<?php
/**
 *
 * A custom page template without sidebar, full width.
 *
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

	//$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	get_header();
	
	
	echo '<div class="section clearfix">';
		 if ( have_posts() ) while ( have_posts() ) : the_post(); 
			 if ( is_front_page() ) { 
				echo '<h2 class="entry-title">'.get_the_title().'</h2>';
			 } else { 
				echo '<h1 class="entry-title">'.get_the_title().'</h1>';
			 } 
			

			
			the_content();

			wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adora' ), 'after' => '</div>' ) );
			
			edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' );
			
		endwhile;
	echo '</div>';
		
	?>
		<div class="section hr"></div>
				
			<?php
				
				wp_reset_query();
				$wp_post_cont = 0 ;
				$wp_raw_count = 0 ;
		
		
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$wp_query = new WP_Query(array( 'post_type' => 'products', 'posts_per_page' => get_option('ermad_products_showcase_limit', 4), 'paged' => $paged ));
				
				while ($wp_query->have_posts()) : $wp_query->the_post();
					$wp_post_cont++;
					$wp_row_count++;

					if ($wp_row_count==1){
						echo '<div class="section articles all-small clearfix">';
						}
					
					echo '<div class="product-post" id="post-'.$post->ID.'">';		
			
						the_title( '<h2><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' );	
						
						echo '<div class="info">'.get_the_term_list( $post->ID, 'producttype', $before ='', $sep='', $after='' );
							get_post_rating($post->ID);
						echo '</div>';
						
						echo '<div class="imgLarge wd205">';
							$arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
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
						echo '</div>';
					}
				endwhile; 			
	
				if ($wp_row_count > 0 && $wp_row_count < 4 ){  echo '</div>'; }		 
				 
				 ?>	
		
		<div class="section hr"></div>
		
		<div class="section pagination clearfix">
			<?php  get_pagination( get_option('ermad_products_showcase_limit', 4) ); ?>
		</div>




<?php 





get_footer(); ?>
