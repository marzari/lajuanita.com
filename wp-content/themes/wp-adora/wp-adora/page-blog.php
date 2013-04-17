<?php
/**
 * Template Name: Page blog
 *
 * A custom page template with double sidebar.
 *
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

	get_header();

	if (is_mobile()){
		include('page-blog-mobile.php');
	}else{
		include('page-blog-full.php');
	}
	
	get_footer(); 

?>