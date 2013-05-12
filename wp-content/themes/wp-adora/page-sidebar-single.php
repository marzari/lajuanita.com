<?php
/**
 * Template Name: Sidebar Single
 *
 * A custom page template with single sidebar.
 *
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
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adora' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php endwhile; ?>

				<?php comments_template( '', true ); ?>

				</div>
				
				<div>
					<?php if ( !function_exists('dynamic_sidebar')  || !dynamic_sidebar('sidebar-page') )  ?>
				</div>

		</div>

<?php get_footer(); ?>
