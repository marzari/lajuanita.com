<?php
/**
 *
 * A custom page template with double sidebar.
 *
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

?>

		<div class="section double-side clearfix">
			<div>

			<?php
				
				$items_per_page = get_option('ermad_blog_items', 4);
				
				wp_reset_query();
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$wp_query = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => $items_per_page, 'paged' =>$paged ));
				
				 while ($wp_query->have_posts()) : $wp_query->the_post();
					echo '<div class="article">';
						the_title( '<h2><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' );
						
						echo '<div class="info">';
						echo get_the_tag_list( $before = '<div class="tags">', $sep = ', ', $after = '</div>' );
						
						if (get_comments_number()) {
							if (get_comments_number()>1){
								echo '<span class="comments">'.get_comments_number().' '.__('Comments','adora').'</span>';
							}else{
								echo '<span class="comments">'.__('1 comment','adora').'</span>';
							}
						}else{
							echo '<span class="comments">'.__('No Comments','adora').'</span>';
						}
					  
					  echo '<span class="date">'.get_the_time('j F').' <span>'.get_the_time('G:i').'</span></span>
						</div>';
						
						
						if ( has_post_thumbnail() ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'article-blog' );
							echo '<div class="imgLarge wd550"><img src="'.$thumb[0].'"  alt="" /></div>';
						} else {
							// the current post lacks a thumbnail
						}
						
						the_excerpt();
						
						echo '<a class="more" href="'.get_permalink().'">'.__('read more','adora').'</a>';
					echo '</div>';
					
					echo '<div class="hr"></div>';		
				endwhile;
				
				echo '<div class="section pagination clearfix">';
					get_pagination($items_per_page);
				echo '</div>';
				
			?>
			</div>
			
			<div>
				<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-blog-left') )  ?>
			</div>
			
			<div>
				<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-blog-right') )  ?>
			</div>
		</div>
