<?php
/**
 *
 * A custom page template without sidebar, full width.
 *
 *
 * @package WordPress
 * @subpackage Ermark Adora
 *
 */

	get_header();
	
	echo '<div class="section clearfix">';
		 if ( have_posts() ) while ( have_posts() ) : the_post(); 
			 if ( is_front_page() ) { 
				echo '<h2 class="entry-title">'.the_title().'</h2>';
			 } else { 
				echo '<h1 class="entry-title">'.the_title().'</h1>';
			 } 

			the_content();
			
			wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adora' ), 'after' => '</div>' ) );
			
			edit_post_link( __( 'Edit', 'adora' ), '<span class="edit-link">', '</span>' );
			
		endwhile;
	echo '</div>';
		
	?>
		<div class="section hr"></div>
		
		<div class="section all-small clearfix articles">
		
			<?php
				
				wp_reset_query();
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			
				$wp_query = new WP_Query(array( 'post_type' => 'products', 'posts_per_page' => 4, 'paged' => $paged ));
				
				 while ($wp_query->have_posts()) : $wp_query->the_post();
					echo '<div>';
			
						the_title( '<h2><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' );
						echo '<div class="info">Tags  <span>| 8 Comments</span> </div>';
						
						
						// Get images for this post
						$arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
						
						the_content();
						echo '<a class="more button" href="'.get_permalink().'">'.__('mais...','adora').'</a>';
					echo ' </div>';
					
				 endwhile; 				 
				
				 ?>
		</div>			
		
		<div class="section hr"></div>
		
		<div class="section pagination clearfix">
			<?php 
				get_pagination(4);
			?>
		</div>

<?php 



/**
* A pagination function
* @param integer $range: The range of the slider, works best with even numbers
* Used WP functions:
* get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4
* previous_posts_link(' � '); - returns the Previous page link
* next_posts_link(' � '); - returns the Next page link
*/
function get_pagination($range = 4){
  // $paged - number of the current page
  global $paged, $wp_query;
  // How much pages do we have?
  if ( !$max_page ) {
    $max_page = $wp_query->max_num_pages;
  }
  // We need the pagination only if there are more than 1 page
  if($max_page > 1){
    if(!$paged){
      $paged = 1;
    }
    // On the first page, don't put the First page link
    if($paged != 1){
      echo "<a href=" . get_pagenum_link(1) . "> First </a>";
    }
	
    // We need the sliding effect only if there are more pages than is the sliding range
    if($max_page > $range){
      // When closer to the beginning
      if($paged < $range){
        for($i = 1; $i <= ($range + 1); $i++){
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
        }
      }
      // When closer to the end
      elseif($paged >= ($max_page - ceil(($range/2)))){
        for($i = $max_page - $range; $i <= $max_page; $i++){
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
        }
      }
      // Somewhere in the middle
      elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
          echo "<a href='" . get_pagenum_link($i) ."'";
          if($i==$paged) echo "class='current'";
          echo ">$i</a>";
        }
      }
    }
    // Less pages than the range, no sliding effect needed
    else{
      for($i = 1; $i <= $max_page; $i++){
        echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged) echo "class='current'";
        echo ">$i</a>";
      }
    }

    // On the last page, don't put the Last page link
    if($paged != $max_page){
      echo "<a href=" . get_pagenum_link($max_page) . "> Last </a>";
    }
  }
}


get_footer(); ?>
