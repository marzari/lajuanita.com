<?php
/**
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

	get_header(); 
	
	if (is_mobile()){
		include('index-mobile.php');
	}else{
		include('index-full.php');
	}
	
	
	get_footer(); 
	
?>
