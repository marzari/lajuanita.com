<?php
/**
 *
 * Template Name: Prices List
 * 
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

	get_header(); 
	
	if (is_mobile()){
		include('page-prices-mobile.php');
	}else{
		include('page-prices-full.php');
	}
	
	
	get_footer(); 
	
?>
