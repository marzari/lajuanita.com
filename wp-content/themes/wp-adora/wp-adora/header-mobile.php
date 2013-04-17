<?php
/**
 * The Header for our mobile theme.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 */
 
	$theme_color = strtolower(get_option('ermad_theme_color', 'Light'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>	
	<meta name = "viewport" content = "width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" />
	<meta name="HandheldFriendly" content="True" />	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
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
	<link rel="icon" href="icon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon" />	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/style-mobile-<?php echo $theme_color; ?>.css" />   
	<link rel="stylesheet" type="text/css"  media="all" href="#" id="orient_css" />
	<script type="text/javascript">  
		  window.onorientationchange = function() {		  
		  var orientation = window.orientation;
		  switch(orientation) {
		    case 0:		        		        
		        document.getElementById("orient_css").href = "#";
		        break; 
		       
		    case 90:		        		        
		        document.getElementById("orient_css").href = "<?php bloginfo( 'template_directory' ); ?>/style-iphone-landscape.css";
		        break;
		   
		    case -90: 		        		        
		        document.getElementById("orient_css").href = "<?php bloginfo( 'template_directory' ); ?>/style-iphone-landscape.css";
		        break;
		  }
		}		     
   </script>     
</head>
<body>
	<div id="wrapper">
		<div id="main_menu">
			<?php 
				$walker = new Walker_mobile_menu;
				
				wp_nav_menu( array( 
				'theme_location' => 'menu-mobile',
				'walker' => $walker
				)); 			
			?>
		</div>
		
		<div id="landscape_logo"><a href="<?php echo get_bloginfo('wpurl'); ?>" id="header_logo"></a></div>
	
		<div id="content">
		<div class="section">