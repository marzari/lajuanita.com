<?php
/**
 * Template Name: Full Width
 *
 * A custom page template without sidebar, full width.
 *
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

get_header(); ?>

		<div class="section clearfix">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php if ( is_front_page() ) { ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php } else { ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php } ?>


				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adora' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' ); ?>
			<?php endwhile; ?>
		</div>

<?php get_footer(); ?>
