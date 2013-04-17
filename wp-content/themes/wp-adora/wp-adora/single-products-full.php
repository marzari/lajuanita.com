<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
**/

get_header(); ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php
		
		$custom = get_post_custom($post->ID);
		
		?>

		<div class="section double-side clearfix">
			<div>
				<div class="article single-product product-post" id="post-<?php echo $post->ID; ?>">
					<div class="price clearfix">
						<h1 <?php post_class(); ?> ><?php the_title(); ?></h1>
						
						<?php 
							if (get_option('ermad_products_price', 'true') == 'true'){
								echo '<span>'.erm_price_format($custom["product_price"][0]).'</span>';
							}
							?>
					</div>
					<?php
						
						echo '<div class="clearfix">';
							echo '<div class="details">';
								the_content(); 		
								
								if (get_option('ermad_products_ingredients','true')=='true'){
									echo '<div class="ingredients">';
										echo '<h4>'.__('Ingredients:','adora').'</h4>';
										echo '<p>'.$custom["product_description"][0].'</p>';
									echo '</div>';
								}
								
								echo '<div class="clearfix">';
									get_post_rating(0, 'full', true);
								echo '</div>';
							echo '</div>';
						
							$image_id = get_post_thumbnail_id();  
							$image_url = wp_get_attachment_image_src( $image_id, 'product-details');
							
							$preview_size = get_option('ermad_products_preview_size', 'large');
							$original_image_url = wp_get_attachment_image_src( $image_id, $preview_size );
							
							echo '<div class="img">';
								if (get_option('ermad_products_preview_enabled', 'false')=='true'){
									echo '<a href="'.$original_image_url[0].'" title="'.get_the_title().'" rel="size-'.$preview_size.'">';
								}
								
									echo '<img src="'.$image_url[0].'" alt="Product Image" />';
								
								if (get_option('ermad_products_preview_enabled', 'false')=='true'){
									echo '</a>';
								}
							echo '</div>';
						echo '</div>';

						productsFacebookLike();
						
						edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' );
					?>							
				</div>
				
				<div class="hr"></div>
							
				<?php comments_template( '', true ); ?>

						
				<div class="hr"></div>
				
				
			</div>
			
			<div>
				<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-product') )  ?>
			</div>
			
			<div>
				<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-blog-right') )  ?>
			</div>
		</div>

<?php endwhile; ?>

<?php get_footer(); ?>
