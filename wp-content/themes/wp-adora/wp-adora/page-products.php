<?php
/**
 * Template Name: Products page
 *
 * A custom page template without sidebar, full width.
 *
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

if (is_mobile()){
	include('page-products-mobile.php');
}else{
	include('page-products-full.php');
}