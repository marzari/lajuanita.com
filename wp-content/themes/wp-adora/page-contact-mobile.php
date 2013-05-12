<?php
/**
 *
 * A custom page template with single sidebar.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */
 define('MOBILE-VERSION',true);
 
 include_once('sendmail.php');
?>
	<div class="section single-side clearfix">
		<div>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adora' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-## -->

			<?php if(isset($email_sent) && $email_sent == true){ ?>
				<p class="email-sent"><?php __('Thank you for contacting. I will answer your email as soon as possible.', 'adora') ?></p>
			<?php } ?>
			
		</div>
		
		<?php endwhile; ?>
	</div>


