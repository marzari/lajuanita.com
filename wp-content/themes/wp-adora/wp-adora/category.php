<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
	<div class="section double-side clearfix">
		<div>
		
				<h1 class="page-title"><?php
					printf( __( 'Category Archives: %s', 'adora' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
					
				<div class="hr"></div>
				
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				get_template_part( 'loop', 'category' );
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
