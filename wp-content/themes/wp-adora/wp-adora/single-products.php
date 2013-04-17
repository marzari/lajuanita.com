<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
**/

	if (is_mobile()){
		include('single-products-mobile.php');
	}else{
		include('single-products-full.php');
	}