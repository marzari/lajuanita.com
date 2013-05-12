<?php
/**
 * The template for displaying Comments.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'adora' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h5><?php
				printf( _n( 'One Response to "%2$s"', '%1$s Responses to "%2$s"', get_comments_number(), 'adora' ),
				number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h5>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'adora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'adora' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="all-comments">
				<?php
					wp_list_comments( array( 'callback' => 'adora_comments' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'adora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'adora' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php echo __( 'Comments are closed.', 'adora' ); ?></p>
	
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 	if ( comments_open() ) : ?>

<h5><?php echo __('Deixe um comentário','adora') ?></h5>

<div class="clearfix spt">
	<form method="post" id="commentform" action="<?php echo bloginfo('wpurl'); ?>/wp-comments-post.php">
		<div class="form-comment">
			<div class="left">
				<div>
					<label><?php echo __('Seu nome','adora'); ?></label>
					<div class="input"><input name="author" id="author" value=""  type="text" /></div>
				</div>
				
				<div>
					<label><?php echo __('E-mail','adora'); ?></label>
					<div class="input"><input type="text"  name="email" id="email" value="" /></div>
				</div>
				
				<div>
					<label><?php echo __('Website (opicional)','adora'); ?></label>
					<div class="input"><input type="text" name="url" id="url" value="" /></div>
				</div>
				
				<?php
					if (!is_mobile()){
						echo '<a href="#" class="form-button">'.__('Enviar comentário','adora').'</a>';
					}				
				?>
				
				
				
			</div>
			
			<div class="right">
				<div>
					<label><?php echo __('Sua mensagem','adora'); ?></label>
					<div class="textarea"><textarea name="comment" id="comment" rows="5" cols="25"></textarea></div>
					<?php
						if (is_mobile()){
							echo '<input type="submit" style="width:inherit;" value="'.__('Submit comment','adora').'">';
						}				
					?>
				</div>
			</div>
		</div>
		
		<div><input name="comment_post_ID" value="<?php echo $post->ID ?>" type="hidden" /></div>
	</form>
</div>

<?php endif; // end ?>

</div><!-- #comments -->
