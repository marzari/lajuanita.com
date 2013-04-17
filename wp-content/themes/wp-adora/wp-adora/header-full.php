<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 */
	
	$theme_color = get_theme_color();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'adora' ), max( $paged, $page ) );

	?></title>
	
	<script type="text/javascript">
		var themePath 		= '<?php bloginfo( 'template_directory' ); ?>/';
		var logoAnimated 	= <?php echo get_option( 'ermad_logo_animated', 'false' ); ?>;
		var logoHover 		= <?php echo get_option( 'ermad_logo_hover', 'false' ); ?>;
		var twitterEnabled 	= <?php echo get_option( 'ermad_twitter_enabled', 'false' ); ?>;
		var slideslinks 	= <?php echo get_option( 'ermad_sliderlinks', 'false' ); ?>;
		var twitterAccount 	= '<?php echo get_option( 'ermad_twitter_account', 'ermarkstudio' ); ?>';
		var themeColor 		= <?php echo "'".$theme_color	."'"; ?>
	</script>
	
	<?php wp_head(); ?>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	?>
	
</head>

<body>
	
	
	<div id="hash-wrapper">
	
	<!-- Notice bar-->
	<div id="notice-wrapper">
		<div id="notice" class="clearfix">
			<div class="all-medium clearfix">
				<?php 
				
					if (!is_active_sidebar('notice-widget-left')){
						echo '<div><h3>Widget left</h3><p>Add widget content here</p></div>';
					}else{
						dynamic_sidebar('notice-widget-left');
					}
					
					if (!is_active_sidebar('notice-widget-right')){
						echo '<div><h3>Widget right</h3><p>Add widget content here</p></div>';
					}else{
						dynamic_sidebar('notice-widget-right');
					}
				
				?>
				
				<div class="double">
					<h3><?php echo get_option( 'ermad_newsletter_title', __("Subscribe to our newsletter",'adora') ) ?></h3>
					<p><?php echo get_option( 'ermad_newsletter_text', __("Please subscribe to our newsletter to recive the latest news and offers about our products. Your e-mail address will not be revealed to anyone.",'adora') ) ?></p>
					<div class="newsletter">
						<div>
							<input type="text" value="<?php echo __('Enter your e-mail address') ?>" /> <a href="#"><?php echo __('Submit','adora'); ?></a>
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="bar" >
				<a href="#" class="touch down"> <?php echo __('Get in touch !', 'adora'); ?> </a>		
				<?php do_action('ermark_notice_bar'); ?>
			</div>
		</div>
	

	</div>
	
	<!-- Header -->
	<div id="header-wrapper">
		<div id="header" >

		<?php
			$walker = new My_Walker;
			
			wp_nav_menu( array( 
			'theme_location' => 'menu-left',
			'menu_class' => 'menu left clearfix',
			'walker' => $walker			) ); 
			
			wp_nav_menu( array( 
			'theme_location' => 'menu-right',
			'menu_class' => 'menu right clearfix',
			'walker' => $walker			) ); 			
		?>

			<div class="logo"><a href="<?php echo get_bloginfo('wpurl'); ?>" title="<?php echo get_bloginfo('name'); ?>"></a></div>
		</div>
	</div>
	
	
	<div id="content-wrapper">
	<div id="content" class="clearfix">