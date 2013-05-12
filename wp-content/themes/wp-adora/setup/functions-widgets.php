<?php

	add_action( 'widgets_init', 'adora_load_widgets' );

function adora_load_widgets() {
	register_widget( 'Adora_Widget_CategFooter' );
	register_widget( 'Adora_Widget_ProductsFooter' );
	register_widget( 'Adora_Widget_ArticlesFooter' );
	register_widget( 'Adora_Widget_ProductsSimilar' );
}

class Adora_Widget_ProductsSimilar extends WP_Widget {

	function Adora_Widget_ProductsSimilar() {
		$widget_ops = array( 'classname' => 'ermad_widget-similar-products', 'description' => __('A widget that displays similar products on product page', 'adora') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ermad_widget-similar-products' );
		$this->WP_Widget( 'ermad_widget-similar-products', __('Adora - Similar Products', 'adora'), $widget_ops, $control_ops );
	}
	


	function widget( $args, $instance ) {
		extract( $args );
		global $post;
		
		$title = apply_filters('widget_title', $instance['title'] );
		$products = $instance['products'];
		
		echo $before_widget;

		if ( $title ) 
			echo $before_title . $title . $after_title;

		if ( $products ){
			wp_reset_query();
	
			$post_terms = wp_get_post_terms($post->ID, 'producttype');
			$post_product_id = $post->ID;
			$post_count = 0;
			
			foreach($post_terms as $term){
	
				$wpq = array ('taxonomy'=>'producttype','term'=>$term->slug);
				$myquery = new WP_Query($wpq);
				
				if ($myquery->have_posts()) :
				  while ($myquery->have_posts()) : $myquery->the_post(); 
					
					if ($post->ID != $post_product_id && $post_count < $products+1 ){
					
						$image_id = get_post_thumbnail_id();  
						$image_url = wp_get_attachment_image_src( $image_id, 'product-related');
						
						echo '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
						echo '<div class="img"><a href="'.get_permalink().'"><img src="'.$image_url[0].'" alt="'.get_the_title().'" /></a></div>';
						echo '<p>'.get_the_excerpt().'</p>';
						echo '<div class="hr"></div>';
						
						$post_count++;
					}
				
				  endwhile;
				endif;

			}
		}
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['products'] = strip_tags( $new_instance['products'] );
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Adora - Similar products', 'adora'), 
							'products' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'products' ); ?>"><?php _e('Number of products:', 'adora'); ?></label>
			<input id="<?php echo $this->get_field_id( 'products' ); ?>" name="<?php echo $this->get_field_name( 'products' ); ?>" value="<?php echo $instance['products']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

class Adora_Widget_ArticlesFooter extends WP_Widget {

	function Adora_Widget_ArticlesFooter() {
		$widget_ops = array( 'classname' => 'ermad_widget-articles', 'description' => __('A widget that display latest blog articles', 'adora') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'adora-widget-blog-articles' );
		$this->WP_Widget( 'adora-widget-blog-articles', __('Adora - Blog Articles', 'adora'), $widget_ops, $control_ops );
	}
	


	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$articles = $instance['articles'];

		/*
			<li>
				<a href="#" class="title">Interview : Fifth gear - Last Grand Prix  Results</a>
				<a href="#" class="author">Anton Mihai</a> <span class="date"> - Oct - 24, 2010 </span> <a href="#" class="comments">14</a>
			</li>
		*/
		
		echo $before_widget;

		if ( $title ) 
			echo $before_title . $title . $after_title;

		if ( $articles ){
			wp_reset_query();
			$wp_query = new WP_Query(array( 
			'post_type'		=> 'post',
			'order'			=> 'desc',
			'showposts'	=> $articles
			));
			
			$countItems = 0;
			$className = 'class="first"';
			echo '<ul class="interviews">';
				
				if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();
					$countItems++;
					
					if ($countItems>1){ $className=null; }
			
					echo '<li '.$className.' >';
						echo '<a href="'.get_permalink().'" class="title">'.get_the_title().'</a>';
						echo '<a href="#" class="author">'.get_the_author().'</a> <span class="date"> - '.get_the_time('M - j, Y').' </span>';
						
						if (get_comments_number()){ echo ' <a href="'.get_permalink().'#comments" class="comments">'.get_comments_number().'</a>'; }
					echo '</li>';
				endwhile;
				else :
					echo '<li>* No articles to show here! *</li>';
				endif;
			echo '</ul>';
		}
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['articles'] = strip_tags( $new_instance['articles'] );
		
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Adora - Blog Articles', 'adora'), 
							'articles' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'articles' ); ?>"><?php _e('Number of articles:', 'adora'); ?></label>
			<input id="<?php echo $this->get_field_id( 'articles' ); ?>" name="<?php echo $this->get_field_name( 'articles' ); ?>" value="<?php echo $instance['articles']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
	
class Adora_Widget_ProductsFooter extends WP_Widget {

	function Adora_Widget_ProductsFooter() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ermad_widget-products', 'description' => __('A widget that display products by category', 'adora') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'adora-widget-product-categs' );
		$this->WP_Widget( 'adora-widget-product-categs', __('Adora - Product Categs', 'adora'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$lines = $instance['lines'];
		//$show_sex = isset( $instance['show_sex'] ) ? $instance['show_sex'] : false;

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display lines from widget settings if one was input. */
		if ( $lines )
			
			$items = 0 ;
			$categNr = count($categories);
			
			$categories = get_terms('producttype', 'orderby=count&hide_empty=0');
				
			echo '<ul class="double clearfix">';
			
			foreach ($categories as $categ) {
				$items++;
				if ( $items <= ($lines*2) ){
					echo '<li><a href="'.get_term_link($categ->slug, 'producttype').'">'.$categ->name.' <span>('.$categ->count.')</span></a></li>';  
				}
			}
			
			echo '</ul>';
			
			
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['lines'] = strip_tags( $new_instance['lines'] );

		/* No need to strip tags for sex and show_sex. 
		$instance['sex'] = $new_instance['sex'];
		$instance['show_sex'] = $new_instance['show_sex'];
		*/
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array( 'title' => __('Adora - Product Categs', 'adora'), 
							'lines' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'lines' ); ?>"><?php _e('Number of lines:', 'adora'); ?></label>
			<input id="<?php echo $this->get_field_id( 'lines' ); ?>" name="<?php echo $this->get_field_name( 'lines' ); ?>" value="<?php echo $instance['lines']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
	
class Adora_Widget_CategFooter extends WP_Widget {

	function Adora_Widget_CategFooter() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ermad_widget-categs', 'description' => __('A widget that display the blog categories', 'adora') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'adora-widget-blog-categs' );
		$this->WP_Widget( 'adora-widget-blog-categs', __('Adora - Blog Categs', 'adora'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$lines = $instance['lines'];
		//$show_sex = isset( $instance['show_sex'] ) ? $instance['show_sex'] : false;

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display lines from widget settings if one was input. */
		if ( $lines )
			$items = 0 ;			
			$categories=  get_categories('post','orderby=count&hide_empty=0'); 
				
			echo '<ul class="double clearfix">';
			
			foreach ($categories as $categ) {
				$items++;
				
				if ( $items <= ($lines*2) ){
					echo '<li><a href="#">'.$categ->name.' <span>('.$categ->count.')</span></a></li>';
				}
			}
			
			echo '</ul>';
			
			
			
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['lines'] = strip_tags( $new_instance['lines'] );

		/* No need to strip tags for sex and show_sex. 
		$instance['sex'] = $new_instance['sex'];
		$instance['show_sex'] = $new_instance['show_sex'];
		*/
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array( 'title' => __('Adora - Blog Categs', 'adora'), 
							'lines' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'lines' ); ?>"><?php _e('Number of lines:', 'adora'); ?></label>
			<input id="<?php echo $this->get_field_id( 'lines' ); ?>" name="<?php echo $this->get_field_name( 'lines' ); ?>" value="<?php echo $instance['lines']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

?>