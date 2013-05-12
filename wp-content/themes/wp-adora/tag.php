<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<div class="section double-side clearfix">
		<div>
		
		<h1 class="page-title">
		<?php
			printf( __( 'Tag Archives: %s', 'adora' ), '<span>' . single_tag_title( '', false ) . '</span>' );
		?>
		</h1>

		<?php
			wp_reset_query();
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			$wp_query = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 4, 'paged' => $paged, 'tag'=>$tag ));
			
			 while ($wp_query->have_posts()) : $wp_query->the_post();
				echo '<div class="article">';
					the_title( '<h2><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' );
					
					echo '<div class="info">';
					echo get_the_tag_list( $before = '<div class="tags">', $sep = ', ', $after = '</div>' );
					
				  echo '<span class="comments">'.get_comments_number().' Comments</span>
						<span class="date">'.get_the_time('j F').' <span>'.get_the_time('G:i').'</span></span>
					</div>
					';
					
					
					if ( has_post_thumbnail() ) {
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
						echo '<div class="imgLarge wd550"><img src="'.$thumb[0].'" /></div>';
					} else {
						// the current post lacks a thumbnail
					}
					
					
					the_content();
					echo '<a class="more" href="'.get_permalink().'">Leia mais..</a>';
				echo '</div>';
				
				echo '<div class="hr"></div>';		
			endwhile;
			
		?>
		</div>
		
		<div>
			<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-blog-left') )  ?>
		</div>
		
		<div>
			<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-blog-right') )  ?>
		</div>
	</div>

<?php get_footer(); ?>



<?php //get_template_part( 'loop', 'tag' ); ?>
