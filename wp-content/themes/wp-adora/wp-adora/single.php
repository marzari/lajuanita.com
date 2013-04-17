<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
**/

	get_header(); 
	
	if (is_mobile()){
		include('single-mobile.php');
	}else{
		include('single-full.php');
	}
	
	get_footer(); 
