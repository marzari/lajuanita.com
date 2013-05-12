<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
**/

?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div class="section double-side clearfix">
			<div>
				<div class="article">
					<h1 id="post-<?php the_ID(); ?>"  <?php post_class(); ?> ><?php the_title(); ?></h1>
					<div class="info">
						<?php
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
							
						echo '<span class="date">'.get_the_time('j F').' <span>'.get_the_time('G:i').'</span></span>';
						?>
					</div>
					
					<?php the_content(); ?>
					
				</div>
				<div class="hr"></div>
							
				<?php comments_template( '', true ); ?>

						
				
				<div class="hr"></div>
			</div>
			
			<div>
				<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-blog-left') )  ?>
			</div>
			
			<div>
				<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-blog-right') )  ?>
			</div>
		</div>

<?php endwhile; ?>