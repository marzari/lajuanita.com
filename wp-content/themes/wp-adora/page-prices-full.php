<?php
/**
 *
 * A custom page template without sidebar, full width.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */
	
	get_header();
	
	echo '<div class="section clearfix">';
		if (get_option('ermad_products_menu_of_the_day', 'false')=='true') {
			echo '<div class="menuDescription">';		
		}
		
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
		
	
		if (get_option('ermad_products_menu_of_the_day', 'false')=='true') {
			echo '</div>';
			echo '<div class="menuDayOffer">';
				echo '<p>'.get_option('ermad_products_menu_description', 'Go to admin panel to edit this description, you must add text for two lines for shure.').'</p>';
				loadProductsInOffer();
			echo '</div>';
		}
	
	echo '</div>';
		
	?>	
		<div class="section hr"></div>
		
		<div class="section clearfix">
		
			<div id="wrapper-prices-center" >
			<div id="wrapper-prices-bottom" >
			<div id="wrapper-prices-top" >

			<?php  loadProductsCateg(); ?>
				 
			</div>			
			</div>			
			</div>			
		</div>			
		
		<div class="section hr"></div>

<?php 


get_footer(); ?>
