<?php
/**
 *
 * @package WordPress
 * @subpackage Ermark Adora
  *
 */

get_header(); ?>

		<div class="section single-side clearfix">
			<div>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php if ( is_front_page() ) { ?>
									<h2 class="entry-title"><?php the_title(); ?></h2>
								<?php } else { ?>
									<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php } ?>

								<div>
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adora' ), 'after' => '</div>' ) ); ?>
									<?php edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- .entry-content -->
							</div><!-- #post-## -->

							<?php //comments_template( '', true ); ?>

			<?php endwhile; ?>
			</div>
			
			<div>
				<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-page') )  ?>
			</div>
		</div>

<?php get_footer(); ?>
