<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
**/
?>

<?php 

	if ( have_posts() ) while ( have_posts() ) : the_post();
		echo '<hr/>
		<div class="post">
			<div class="post_date">
				<span class="day_date">'.get_the_time('j').'</span>
				<span class="month_date">'.get_the_time('M').'</span>
			 </div>
			  
			<div class="post_title_author">
				<h1 class="post_titles"><a href="'.get_permalink().'">'.$post->post_title.'</a></h1>
				'.__('Author:','adora').' <span class="author">'.get_the_author().'</span>
			</div>';						  
			
		echo '<p>'.get_the_content().'</p>
		</div>';
		
		echo '<hr/>';
		
		comments_template( '', true );
	endwhile;
	
?>