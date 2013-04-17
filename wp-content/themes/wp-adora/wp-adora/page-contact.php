<?php
/**
 * Template Name: Contact page
 *
 * A custom page template with single sidebar.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */
 
	get_header(); 
	
	if (is_mobile()){
		include('page-contact-mobile.php');
	}else{
		include('page-contact-full.php');
	}
	
	
	get_footer(); 
