<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div class="section">
			<h1><?php
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				
				printf( __( 'Food by category: '.$term->name, 'adora' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			?></h1>
		</div>
		
		
		<div class="section hr"></div>
		
			<?php
				
				$wp_post_cont = 0 ;
				$wp_raw_count = 0 ;
				
				wp_reset_query();
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$wp_query = new WP_Query(array( 'post_type' => 'products','taxonomy'=>'producttype','term'=>$term->slug ));
				
				if ( have_posts() ){
					while ($wp_query->have_posts()) : $wp_query->the_post();
						$wp_post_cont++;
						$wp_row_count++;
						
						if ($wp_row_count==1){
							//echo "\n".'<!-- raw:0'.$wp_row_count.' -->';
							echo "\n".'<div class="section articles all-small clearfix">';
							}
					
						//echo "\n<!-- product -->";
						echo "\n".'<div class="product-post" id="post-'.$post->ID.'">';		
				
							the_title( "\n".'<h2><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' );	
							
								echo "\n".'<div class="info">'.get_the_term_list( $post->ID, 'producttype', $before ='', $sep='', $after='' );
									get_post_rating($post->ID);
								echo "\n".'</div>';
							
								echo "\n".'<div class="imgLarge wd205">';
									$arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
									if($arrImages) {
										foreach($arrImages as $oImage) {
											$image_url = wp_get_attachment_image_src( $oImage->ID, 'product-showcase');
											echo '<img  width="175" height="230" src="'.$image_url[0].'" alt="" />';
										}
									}
								echo "\n".'</div>';
							
								echo "\n".'<p>'.get_the_excerpt().'</p>';
								echo "\n".'<a class="more button" href="'.get_permalink().'">'.__('Read more','adora').'</a>';
						echo "\n".'</div>';
						//echo "\n".'<!-- /product -->';
						
					if ($wp_row_count == 4){
						echo "\n".'</div>';
						//echo "\n".'<!-- raw:0'.$wp_row_count.' -->';
						
						$wp_row_count = 0;
						}
						
					 endwhile; 				 
					 
					if ($wp_row_count > 0 && $wp_row_count < 4 ){  echo '</div>'; }		 
						
				}else{
					echo 'There are no products to show!';
				}
				 ?>		
				 
		<div class="section hr"></div>
		
		<div class="section pagination clearfix">
			<?php 
				get_pagination(4);
			?>
		</div>
	
<?php get_footer(); ?>
