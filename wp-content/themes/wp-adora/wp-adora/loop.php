<?php
/**
 * The loop that displays posts.
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'adora' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'adora' ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Page Not Found', 'adora' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'adora' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>



<?php 

	while ( have_posts() ) : the_post();

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
				</div>
				';
				
				
				if ( has_post_thumbnail() ) {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'article-blog' );
					echo '<div class="imgLarge wd550"><img src="'.$thumb[0].'" /></div>';
				}
				
				the_excerpt();
				
				echo '<a class="more" href="'.get_permalink().'">'.__('read more','adora').'</a>';
			echo '</div>';
			
			echo '<div class="hr"></div>';		
	
	endwhile;  

	?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'adora' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'adora' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
