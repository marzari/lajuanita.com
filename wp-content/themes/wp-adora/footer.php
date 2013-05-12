<?php
/**
 * The footer for our theme.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 */
 
	if (is_mobile()){
		include('footer-mobile.php');
	}else{
		include('footer-full.php');
	}
?>