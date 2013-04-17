<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Adora
 */

get_header(); ?>

	<div class="section clearfix">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'adora' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'adora' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>

	</div>

<?php get_footer(); ?>