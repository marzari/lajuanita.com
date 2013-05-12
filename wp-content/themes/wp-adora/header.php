<?php if ( !session_id() ){ session_start(); }?>

<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 */
	
	
	
	if (array_key_exists('version', $_GET) && $_GET['version']=='full'){ $_SESSION['version']='full'; }
	
	$theme_color = get_option('ermad_theme_color');
	
	if (is_mobile()){
		include('header-mobile.php');
	}else{
		include('header-full.php');
	}
?>