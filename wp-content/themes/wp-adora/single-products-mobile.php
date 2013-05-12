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

		<div class="section double-side clearfix">
			<div>
				<div class="article">
					<h1 id="post-<?php the_ID(); ?>"  <?php post_class(); ?> ><?php the_title(); ?></h1>
					<div class="info">
						<div class="tags"><a href="#">Blog</a>, <a href="#">Features</a></div>
						
						<?php
							if (get_comments_number()) {
								echo '<span class="comments">'.get_comments_number().'Comments</span>';
							}else{
								echo '<span class="comments">No Comments</span>';
							}
						?>
						
						<span class="date">12 Oct, 2010 <span>22:30</span></span>
					</div>
					
					<?php the_content(); ?>
					
				</div>
				<div class="hr"></div>
							
				<?php comments_template( '', true ); ?>

						
				<div class="section hr"></div>
				
			</div>
		</div>

<?php endwhile; ?>

<?php get_footer(); ?>
