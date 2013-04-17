<?php
/**
 * A custom page template without sidebar, full width.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */
		echo '<div class="section">';
		 if ( have_posts() ) while ( have_posts() ) : the_post(); 
			 if ( is_front_page() ) { 
				echo '<h2 class="entry-title">'.get_the_title().'</h2>';
			 } else { 
				echo '<h1 class="entry-title">'.get_the_title().'</h1>';
			 } 

			the_content();
			
			wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adora' ), 'after' => '</div>' ) );
			
			edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' );
		endwhile;
		echo '</div>';
		
	?>	
		<hr/>
		
		<div class="section">
			<?php  loadProductsCategMobile(); ?>
		</div>
<?php 
