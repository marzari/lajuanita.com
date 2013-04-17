<?php
	$ermark_theme_path = dirname(__FILE__ );
	
	define('ERMARK_THEME_ID'			,'adora');
	define('ERMARK_ADORA_VERSION'		,'1.0.03');
	
	include_once ('setup/functions-setup.php');
	include_once ('setup/functions-shortcodes-columns.php');
	include_once ('setup/functions-shortcodes.php');
	include_once ('setup/functions-mobile.php');
	include_once ('setup/functions-widgets.php');
	include_once ('setup/functions-ratings.php');
	include_once ('setup/functions-categories.php');
	include_once ('setup/functions-type-slide.php');
	
	
	//** Add theme update support from Ermark server
	//**
	if (file_exists($ermark_theme_path.'/setup/functions-update.php')) { 
		include_once ('setup/functions-update.php'); 
		}

	//** Add theme styler support for Showcase
	//**
	if (file_exists($ermark_theme_path.'/setup/functions-styler.php')) { 
		include_once ('setup/functions-styler.php'); 
		}		
	
	

		
	load_theme_textdomain( 'adora', TEMPLATEPATH.'/lang/' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/lang/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	
	
	add_action('init', 'register_post_type_products');
	add_action('init', 'register_post_taxonomies', 0 );  


if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'menu-left' => __('Top Menu - Left','adora'),
		  'menu-right' => __('Top Menu - Right','adora'),
		  'menu-mobile' => __('Mobile Menu','adora'),
		)
	);
}

//if (function_exists('wp_register_sidebar_widget')){

	register_sidebar(array(
	'name'			=> __('Notice Bar - Left','adora'),
	'description'   => __('The left side widget','adora'),
	'id'            => 'notice-widget-left',
	'before_widget' => '<div class="widget-notice">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));

	register_sidebar(array(
	'name'			=> __('Notice Bar - Right','adora'),
	'description'   => __('The right side widget','adora'),
	'id'            => 'notice-widget-right',
	'before_widget' => '<div class="widget-notice">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Sidebar Page','adora'),
	'description'   => __('The page sidebar','adora'),
	'id'            => 'sidebar-page',
	'before_widget' => '<div class="widget-sidebar-page">',
	'after_widget'  => '<div class="hr"></div></div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Sidebar Product','adora'),
	'description'   => __('The product sidebar','adora'),
	'id'            => 'sidebar-product',
	'before_widget' => '<div class="widget-sidebar-product">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Sidebar Blog left','adora'),
	'description'   => __('The page sidebar','adora'),
	'id'            => 'sidebar-blog-left',
	'before_widget' => '<div class="widget-sidebar-blog">',
	'after_widget'  => '<div class="hr"></div></div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Sidebar Blog right','adora'),
	'description'   => __('The page sidebar','adora'),
	'id'            => 'sidebar-blog-right',
	'before_widget' => '<div class="widget-sidebar-blog">',
	'after_widget'  => '<div class="hr"></div></div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Footer Left','adora'),
	'description'   => __('In the footer the left column','adora'),
	'id'            => 'footer-widget-left',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Footer Center Left','adora'),
	'description'   => __('In the footer the center left column','adora'),
	'id'            => 'footer-widget-center-left',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Footer Center Right','adora'),
	'description'   => __('In the footer the center right column','adora'),
	'id'            => 'footer-widget-center-right',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
	'name'			=> __('Footer Right','adora'),
	'description'   => __('In the footer the right column','adora'),
	'id'            => 'footer-widget-right',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>',
	));
//}

function register_post_taxonomies() {
	register_taxonomy( 'producttype', 'products', 
		array( 'hierarchical' => false, 
					   'slug' => 'pdtype',
		              'label' => __('Categories','adora'), 
				  'query_var' => true,
			   'hierarchical' => true,
				    'rewrite' => true ));  
}

function register_post_type_products() {
	register_post_type('products', 
	
		array(
		'labels' => array(
			'name' => __( 'Products','adora' ),
			'singular_name' => __( 'Product','adora' ),
			'add_new' => __( 'Add New','adora' ),
			'add_new_item' => __( 'Add New Product','adora' ),
			'edit' => __( 'Edit','adora' ),
			'edit_item' => __( 'Edit Product','adora' ),
			'new_item' => __( 'New Product','adora' ),
			'view' => __( 'View Product', 'adora' ),
			'view_item' => __( 'View Product', 'adora' ),
			'search_items' => __( 'Search Products', 'adora' ),
			'not_found' => __( 'No products found', 'adora' ),
			'not_found_in_trash' => __( 'No products found in Trash', 'adora' ),
			'parent' => __( 'Parent product', 'adora' ),
			),
		'public' => true,
		'rewrite' => true, 
		'slug' => 'product',
		'show_ui' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt')
		));
}




class My_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		

		$current_url = strtolower($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$item_url = str_replace(array('http://', 'https://'),'',strtolower($item->url));
		
		if ($item_url==$current_url){ 
			$class_selection = 'class="selected"'; 
		}else{ 
			$class_selection = ''; 
		}
		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '" '.$class_selection.'>';
	
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= '<span>' . $item->description . '</span>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class Walker_mobile_menu extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		

		$current_url = strtolower($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$item_url = str_replace(array('http://', 'https://'),'',strtolower($item->url));
		
		if ($item_url==$current_url){ 
			$class_selection = 'class="selected"'; 
		}else{ 
			$class_selection = ''; 
		}
		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '" '.$class_selection.'>';
	
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


function adora_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div class="img comment"> <?php echo get_avatar( $comment, 40 ); ?> </div>	
			<div class="comment-info">
				<span class="author"><?php comment_author();  ?></span>
				<span class="date"><?php comment_date(); ?> <span><?php comment_date('h:m'); ?></span></span>
			</div>
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'adora' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-body">
				<?php comment_text(); ?>
				
				<?php edit_comment_link( __( 'Edit', 'adora' ), ' ' );?>
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			
		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'adora' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('Edit', 'adora'), ' ' ); ?></p>
		<?php
				break;
		endswitch;
	}


?>