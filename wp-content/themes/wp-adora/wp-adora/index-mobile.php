<?php
/**
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */
?>

<hr/>
<h1 class="main_titles"><?php echo get_option('ermad_mobile_home_title');  ?></h1>
<p><?php echo get_option('ermad_mobile_home_text');  ?></p>
	
<?php 

	wp_reset_query();
	$wp_query = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 4 ));
	
	 while ($wp_query->have_posts()) : $wp_query->the_post();
		echo '<hr/>
		<div class="post">
			<div class="post_date">
				<span class="day_date">'.get_the_time('j').'</span>
				<span class="month_date">'.get_the_time('M').'</span>
			 </div>
			  
			<div class="post_title_author">
				<h1 class="post_titles"><a href="'.get_permalink().'">'.$post->post_title.'</a></h1>
				Author: <span class="post_author">'.get_the_author().'</span>
			</div>						  
			
			<p>'.get_the_excerpt().'</p>
			<a class="read_more" href="'.get_permalink().'">read more</a>
		</div>';
	endwhile;
?>