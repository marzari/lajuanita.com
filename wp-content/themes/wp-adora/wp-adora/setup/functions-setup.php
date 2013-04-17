<?php
	load_theme_textdomain( 'adora', TEMPLATEPATH.'/lang' );

	if (get_option('ermad_reservations_enabled','false')=='true'){
		include('reservations-code.php');
	}

	add_theme_support( 'post-thumbnails', array( 'products', 'post', 'slide' ) );
	set_post_thumbnail_size( 50, 50, true );
		
	add_image_size( 'single-post-thumbnail', 9999, 520);

	add_image_size( 'article-slider', 850,250, true);
	add_image_size( 'article-blog', 520,180, true);

	add_action('init', 'loadSetupReference');						// CSS & Javascript
	add_action('admin_menu', 'ermarkad_add_admin');

	
	/*
	**
	** Products Hooks
	**
	*/
	
	add_action('admin_menu', 'setupProductsMeta');
	add_action('save_post', 'updateProductsMetaSource');

	add_action("manage_posts_custom_column",  "metaProductsColumnsDisplay");
	add_action('admin_head', 'manage_products_css');
	
	add_filter("manage_edit-products_columns", "metaProductsColumnsEdit");
	
	add_image_size( 'product-details', 340,310, true);
	add_image_size( 'product-showcase', 175,230, true);
	add_image_size( 'product-related', 135,135, true);
	add_image_size( 'product-menu-thumbnail', 75,75, true);
	add_image_size( 'product-thumbnail', 45,45, true);

	
	$currency_simbol = get_option('ermad_products_currency', '$');
	define('ERMAD_CURRENCY_SYMBOL',$currency_simbol );
	

	/*
	**
	** Ermark Hooks
	**
	*/
	
	add_action('ermark_notice_bar', 'addReservationForm');
	

$themename = "Ermark Adora";
$shortname = "ermad";
$setuppage = "adora-setup.php";

$options = array (
	/**/
	array(         "type" => "toolbar", 
		           "mode" => "open", 
				   "name" => __('Ermark Options Panel','adora'),
			"description" => __('Customize the theme options.','adora')
			),
			
	array(         "type" => "toolbar", 
		           "mode" => "close"),	
	
	array("type" => "full-panel", "mode"=>"open"),
		
		array("type" => "tabs-bar", "mode"=>"open"),
			array("type" => "tab", "id"=>'tab_ct_01', "name"=>__("Settings",'adora'), 'selected'=>'true'),
			array("type" => "tab", "id"=>'tab_ct_02',"name"=>__("Layout", 'adora'), 'selected'=>'false'),
			array("type" => "tab", "id"=>'tab_ct_03',"name"=>__("Social",'adora'), 'selected'=>'false'),
			array("type" => "tab", "id"=>'tab_ct_04',"name"=>__("Reservations", 'adora'), 'selected'=>'false'),
			array("type" => "tab", "id"=>'tab_ct_06',"name"=>__("Products", 'adora'), 'selected'=>'false'),
			array("type" => "tab", "id"=>'tab_ct_07',"name"=>__("Blog", 'adora'), 'selected'=>'false'),
			array("type" => "tab", "id"=>'tab_ct_05',"name"=>__("Newsletter",'adora') , 'selected'=>'false'),
		array("type" => "tabs-bar", "mode"=>"close", 'selected'=>'false'),
		
	array("type" => "full-panel", "mode"=>"content"),
		
		
		/**
		*
		*	General settings
		*
		**/
		array("type" => "panel", "name" => "Home page", "mode"=>"open" , "tab" => "tab_ct_01"),
		
			array(      "id" => $shortname."_frontslider",
			 "section-title" => __('Homepage slider','adora'),
       "section-description" => __('You can activate or deactivate the homepage slider.','adora'),
			         "label" => __('Show slider on home page','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
					   
			array(      "id" => $shortname."_sliderlinks",
			 "section-title" => __('Slides Links','adora'),
       "section-description" => __('You can activate or deactivate links on slider.','adora'),
			         "label" => __('Use links on slide','adora'),
					  "type" => "checkbox",
					   "std" => "false"),
				

			array(    "type" => "select", 
						"id" => $shortname."_theme_color",
			 "section-title" => __('Choose the theme color','adora'),
				   "options" => array('Light', 'Brown'),
       "section-description" => __('Adora comes in two colors, you can use the one you like from here.'),
					   "std" => "Brown",
					  ),
					   
					   
			array(    "type" => "text", 
						"id" => $shortname."_frontshowcase_items",
			 "section-title" => __('Showcase products','adora'),
       "section-description" => __('Set the number of items to be listed on frontpage showcase.'),
					   "std" => "4",
					  ),
					  
					  
				array(      "id" => $shortname."_frontshowcase_badge",
				 "section-title" => __("Showcase badge",'adora'),
		   "section-description" => __("In the right side of the section you can show a custom badge",'adora'),
						 "label" => __("Show badge",'adora'),
						  "type" => "checkbox",
						   "std" => "false"),
					  
					  
				array(      "id" => $shortname."_logo_animated",
				 "section-title" => __("Animated logo",'adora'),
		   "section-description" => __("You can use the animated or the static version of the logo.",'adora'),
						 "label" => __("Use the animated logo",'adora'),
						  "type" => "checkbox",
						   "std" => "true"),
						   
						   
				array(      "id" => $shortname."_logo_hover",
				 "section-title" => __("Logo hover",'adora'),
		   "section-description" => __("The logo fades when you move the cursor over.",'adora'),
						 "label" => __("Use effect",'adora'),
						  "type" => "checkbox",
						   "std" => "true"),
						   
		array("type" => "panel", "mode"=>"close"),
		
		/**
		*
		*	Blog settings
		*
		**/
		array("type" => "panel", "name" => "Blog page", "mode"=>"open" , "tab" => "tab_ct_07"),   
					   
			array(    "type" => "text", 
						"id" => $shortname."_blog_items",
			 "section-title" => __('Blog articles','adora'),
       "section-description" => __('Set the number of articles to be listed per page.'),
					   "std" => "4",
					  ),
						   
			array(    "type" => "text", 
						"id" => $shortname."_blog_comment_text",
			 "section-title" => __('Comment text','adora'),
       "section-description" => __('The text before the comments.'),
					   "std" => "Just leave us a comment if you don't mind.",
					  ),
						   
						   
						   
		array("type" => "panel", "mode"=>"close"),
	
	
		/**
		*   
		*	Reservations settings
		*   
		**/
		array("type" => "panel", "name" => "Reservations", "mode"=>"open" , "tab" => "tab_ct_04"),
			array(      "id" => $shortname."_reservations_enabled",
			 "section-title" => __('Activate reservations','adora'),
       "section-description" => __('You can activate the reservation sistem.','adora'),
			         "label" => __('Use reservations','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
				
			array(      "id" => $shortname."_reservations_notifications",
			 "section-title" => __('Reservations notifications','adora'),
       "section-description" => __('Send me an e-mail as soon as someone makes a reservation.','adora'),
			         "label" => __('Send notification','adora'),
					  "type" => "checkbox",
					   "std" => "false"),
					   
				array(    "type" => "text", 
							"id" => $shortname."_reservations_notifymail",
				 "section-title" => __('Notification mail','adora'),
		   "section-description" => __('Set an e-mail address to recive notifications','adora'),
						   "std" => "",
						  ),
						  
				array(    "type" => "text", 
							"id" => $shortname."_reservations_confirmation",
				 "section-title" => __('Confirmation text','adora'),
		   "section-description" => __('The text showed when the reservation has been sucessfuly sent!','adora'),
						   "std" => __('The reservation has been send, we will contact you soon!', 'adora'),
						  ),
						  
			array(    "type" => "select", 
						"id" => $shortname."_reservations_menu_position",
			 "section-title" => __('Choose the menu position','adora'),
				   "options" => array(__('Left side','adora'), __('Right side','adora')),
       "section-description" => __('Choose the position of the menu once the reservation form will appear.','adora'),
					   "std" => __("Left side",'adora'),
					  ),
						  
		array("type" => "panel", "mode"=>"close"),
		
		
	/**
		*
		*	Products settings
		*
		**/
		array("type" => "panel", "name" => "Products", "mode"=>"open" , "tab" => "tab_ct_06"),
		
			array(      "id" => $shortname."_products_ratings_enabled",
			 "section-title" => __('Ratings','adora'),
       "section-description" => __('You can let your visitors to rate the products.','adora'),
			         "label" => __('Use ratings','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
					   
			array(      "id" => $shortname."_products_menu_of_the_day",
			 "section-title" => __('Menu of the day','adora'),
       "section-description" => __('Use an offer section on prices page.','adora'),
			         "label" => __('Show section','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
					   
			array(      "id" => $shortname."_products_ingredients",
			 "section-title" => __('Food ingredients','adora'),
       "section-description" => __('Show ingredients sub section on product page .','adora'),
			         "label" => __('Show section','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
					   
			array(      "id" => $shortname."_products_price",
			 "section-title" => __('Product price','adora'),
       "section-description" => __('Show the product price in the left side of the title on product page .','adora'),
			         "label" => __('Show price','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
					    
			array(      "id" => $shortname."_products_preview_enabled",
			 "section-title" => __('Large preview','adora'),
       "section-description" => __('Allow the visitor to click on product image to see a larger preview','adora'),
			         "label" => __('Use large prevew','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
					   
			array(    "type" => "select", 
						"id" => $shortname."_products_preview_size",
			 "section-title" => __('Choose preview size','adora'),
				   "options" => array(__('full','adora'), __('large','adora'), __('medium','adora')),
       "section-description" => __('Choose the size of the preview image showing when you click the product image.','adora'),
					   "std" => __("large",'adora'),
					  ),
					   
					   
			array(    "type" => "text", 
						"id" => $shortname."_products_menu_description",
			 "section-title" => __('Menu of the day description','adora'),
	   "section-description" => __('The description text below the products','adora'),
					   "std" => __('Some kind of little description just enought to get in almost two full lines.', 'adora'),
					  ),
					  
			array(    "type" => "text", 
						"id" => $shortname."_products_currency",
			 "section-title" => __('Currency Symbol','adora'),
	   "section-description" => __('Type the currency you want to use ( more codes <a href="http://www.ascii.cl/htmlcodes.htm">here</a>)','adora'),
					   "std" => __('$', 'adora'),
					  ),
						  
		array("type" => "panel", "mode"=>"close"),
		
		array("type" => "panel", "name" => "Prices page", "mode"=>"open" , "tab" => "tab_ct_06"),
		
			array(      "id" => $shortname."_products_categ_limit",
			 "section-title" => __('Limit category items','adora'),
       "section-description" => __('Show just a limited number of items from each category','adora'),
			         "label" => __('Limit items','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
					   
			array(    "type" => "text", 
						"id" => $shortname."_products_categ_items",
			 "section-title" => __('Category items','adora'),
	   "section-description" => __('Show only a few items per category','adora'),
					   "std" => '2',
					  ),
					   
		array("type" => "panel", "mode"=>"close"),
		
		array("type" => "panel", "name" => "Showcase page", "mode"=>"open" , "tab" => "tab_ct_06"),
		
			array(    "type" => "text", 
						"id" => $shortname."_products_showcase_limit",
			 "section-title" => __('Limit showcase items','adora'),
       "section-description" => __('Show just a limited number of items on showcase Page Template','adora'),
					   "std" => '4',
					  ),
					   
		array("type" => "panel", "mode"=>"close"),
	
		/**
		*
		*	Footer Panel
		*
		**/
		array("type" => "panel", "name" => __('Footer settings','adora'), "mode"=>"open", "tab" => "tab_ct_02",),			   
						  
				array(    "type" => "text", 
							"id" => $shortname."_credits_line1",
				 "section-title" => __('Credits - Line 1','adora'),
		   "section-description" => __('Change the first line of credits information','adora'),
						   "std" => "<strong>2010</strong> &copy; Copyright <strong>Ermark Adora HTML</strong>",
						  ),
						  
				array(    "type" => "text", 
							"id" => $shortname."_credits_line2",
				 "section-title" => __('Credits - Line 2','adora'),
		   "section-description" => __('Change the last line of credits information','adora'),
						   "std" => __('A Theme by Ermark Studio','adora'),
						  ),
		array("type" => "panel", "mode"=>"close"),
		
		
		/**
		*
		*	Newsletter
		*
		**/
		array("type" => "panel", "name" => __("Newsletter Settings",'adora'), "mode"=>"open", "tab" => "tab_ct_05"),			   
						  
				array(    "type" => "text", 
							"id" => $shortname."_newsletter_title",
				 "section-title" => __("Newsletter title",'adora'),
		   "section-description" => __("The title of the newsletter section.",'adora'),
						   "std" => __("Subsribe to our newsletter",'adora'),
						  ),
						  
				array(    "name" => "Newsletter text",
							"id" => $shortname."_newsletter_text",
				 "section-title" => __("Newsletter text",'adora'),
		   "section-description" => __("Newsletter text on the newsletter section.",'adora'),
						   "std" => __("Please subscribe to our newsletter to recive the latest news and offers about our products. Your e-mail address will not be revealed to anyone.",'adora'),
						  "type" => "textarea"),
						  
		array("type" => "panel", "mode"=>"close"),
		
		array("type" => "panel", "name" => __("Collected e-mails",'adora'), "mode"=>"open", "tab" => "tab_ct_05"),			   
						  
				array(    "name" => "E-mails list",
							"id" => $shortname."_newsletter_list",
				 "section-title" => __("E-mails",'adora'),
		   "section-description" => __("Here are the e-mails collected using the notice bar form.",'adora'),
						   "std" => "",
						  "type" => "showbox"),
						  
		array("type" => "panel", "mode"=>"close"),
		
		
		/**
		*
		*	Mobile settings
		*
		**/
		array("type" => "panel", "name" => __("Mobile version",'adora'), "mode"=>"open", "tab" => "tab_ct_01"),			   
						  
				array(    "type" => "text", 
							"id" => $shortname."_mobile_home_title",
				 "section-title" => __("Home wellcome title",'adora'),
		   "section-description" => __("The title of the wellcome message on mobile version.",'adora'),
						   "std" => "#",
						  ),
						  
				array(    "name" => "Welcomme message",
							"id" => $shortname."_mobile_home_text",
				 "section-title" => __("Welcome",'adora'),
		   "section-description" => __("Customize your welcome message on mobile version.",'adora'),
						   "std" => __("Classic car collection is owned by an automobile enthusiast and avid collector, is rumored to own one of the largest car collections in the world that includes various models manufactured in diffrent years.",'adora'),
						  "type" => "textarea"),
						  
				array(      "id" => $shortname."_mobile_enabled",
				 "section-title" => __("Show section",'adora'),
		   "section-description" => __("Activate or deactivate the mobile version",'adora'),
						 "label" => __("Use mobile version",'adora'),
						  "type" => "checkbox",
						   "std" => "true"),
						   
				array(      "id" => $shortname."_mobile_force",
				 "section-title" => __("Mobile version only",'adora'),
		   "section-description" => __("You can force the site to use the mobile version on desktop also",'adora'),
						 "label" => __("Force mobile version",'adora'),
						  "type" => "checkbox",
						   "std" => "false"),
		array("type" => "panel", "mode"=>"close"),
		
		
		/**
		*
		*	Contact settings
		*
		**/
		array("type" => "panel", "name" => __("Contact settings",'adora'), "mode"=>"open", "tab" => "tab_ct_01"),			   
						  
				array(    "type" => "text", 
							"id" => $shortname."_contact_mail",
				 "section-title" => __("Contact Mail",'adora'),
		   "section-description" => __("Setup your e-mail address to recive e-mails from contact page",'adora'),
						   "std" => "#",
						  ),
						  
		array("type" => "panel", "mode"=>"close"),
	
		/**
		*
		*	Social settings
		*	
		**/
		array("type" => "panel", "name" => "Twitter", "mode"=>"open" , "tab" => "tab_ct_03"),
		
			array(    "type" => "text", 
						"id" => $shortname."_twitter_account",
			 "section-title" => __("Twitter account",'adora'),
       "section-description" => __("Specify your twitter account to show the latest tweets.",'adora'),
					   "std" => "ermarkstudio",
					  ),

			array(    "type" => "text", 
						"id" => $shortname."_twitter_label",
			 "section-title" => __("Bar Twitter Label",'adora'),
       "section-description" => __("The label before the bird icon.",'adora'),
					   "std" => __("Ermark on twitter",'adora'),
					  ),				  
					 
			array(      "id" => $shortname."_twitter_enabled",
			 "section-title" => __("Twitter settings",'adora'),
       "section-description" => __("Display the latest tweet on the content bar",'adora'),
			         "label" => __("Show the latest tweet",'adora'),
					  "type" => "checkbox",
					   "std" => "true"),
		array("type" => "panel", "mode"=>"close"),
		
		array("type" => "panel", "name" => "Facebook", "mode"=>"open" , "tab" => "tab_ct_03"),
			array(      "id" => $shortname."_products_social_facebook",
			 "section-title" => __('Social rating','adora'),
       "section-description" => __('Give your visitors to share foods on facebook using the "Like" button.','adora'),
			         "label" => __('Add Facebook "Like"','adora'),
					  "type" => "checkbox",
					   "std" => "true"),
		array("type" => "panel", "mode"=>"close"),
		
		
		/**
		*
		*	Call to action panel
		*
		**/
		array("type" => "panel", "name" => __("Call to action",'adora'), "mode"=>"open", "tab" => "tab_ct_01"),			   
				array(    "type" => "text", 
							"id" => $shortname."_toaction_label",
				 "section-title" => __("Buton text",'adora'),
		   "section-description" => __("You can change the label of the button just adding a new value in place.",'adora'),
						   "std" => __("View Collection",'adora'),
						  ),
						  
				array(    "type" => "text", 
							"id" => $shortname."_toaction_link",
				 "section-title" => __("Button link",'adora'),
		   "section-description" => __("Specify the link for the page you want to direct the user.",'adora'),
						   "std" => "#",
						  ),
						  
				array(    "name" => "Info",
							"id" => $shortname."_toaction_text",
				 "section-title" => __("Text",'adora'),
		   "section-description" => __("Customize your call to action text to atract more users.",'adora'),
						   "std" => __("Classic car collection is owned by an automobile enthusiast and avid collector, is rumored to own one of the largest car collections in the world that includes various models manufactured in diffrent years.",'adora'),
						  "type" => "textarea"),
						  
				array(      "id" => $shortname."_toaction_enabled",
				 "section-title" => __("Show section",'adora'),
		   "section-description" => __("Hide or show the 'Call to action' sction from home page.",'adora'),
						 "label" => __("Show this section",'adora'),
						  "type" => "checkbox",
						   "std" => "true"),
		array("type" => "panel", "mode"=>"close"),
	
	
	array("type" => "full-panel", "mode"=>"close"),
);


function ermarkad_add_admin() {

    global $themename, $shortname, $setuppage, $options;
	
	//header('source:'.basename(__FILE__));
	//header('get-page: ['.$_GET['page'].']['.$setuppage.']');
	
	$currentSession = $options;
	
	if (is_array($_REQUEST) && array_key_exists('page', $_REQUEST)){
		
	
    if ( $_REQUEST['page'] == $setuppage) {
			if ( array_key_exists('action', $_REQUEST) &&  ('save' == $_REQUEST['action'] )) {
				foreach ($options as $value) {
				
					if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='checkbox' || $value['type']=='select') && array_key_exists($value['id'], $_REQUEST) ) {
						if ($value['type']=='checkbox' && $_REQUEST[ $value['id'] ]=='on') { $_REQUEST[ $value['id'] ]='true'; }
						update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 					
					}else{
						if ($value['type']=='checkbox'){
							update_option( $value['id'], 'false' ); 
						}
					}
				}
			} else if( array_key_exists('action', $_REQUEST) &&  ('reset' == $_REQUEST['action'] )) {
				foreach ($options as $value) {
					if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='checkbox' || $value['type']=='select')) {
						update_option( $value['id'], $value['std'] ); 
					}
				}

				header("Location: themes.php?page=adora-setup.php&reset=true");
				die;
			}else if(array_key_exists('action', $_REQUEST) &&  ('install' == $_REQUEST['action'])) {
				foreach ($options as $value) {
					if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='checkbox' || $value['type']=='select')) {
						update_option( $value['id'], $value['std'] ); 
					}
				} 
			
				update_option('ermad_first_run', 'true');
				header("Location: themes.php?page=adora-setup.php&install=true");		
			}
			
		}
	
	}
	
	$icon_path = get_bloginfo( 'template_directory' ).'/setup/images/icon.png';
    
	add_admin_menu_separator(29);
	

	add_menu_page('Ermark Adora Admin'	, 'Ermark Adora','edit_themes'	, 'adora-setup.php'	, 'ermarkad_options'	, $icon_path, 30);

    add_submenu_page('adora-setup.php'		, 'Theme Options'	, 'Adora Options'	,'edit_themes'	, 'adora-setup.php'	, 'ermarkad_options'	);
    add_submenu_page('adora-setup.php'		, 'Documentation'	, 'Documentation'	, 'read'		, 'http:&#47;&#47;www.ermark.ro/support/adora/documentation'		, ''					);
    add_submenu_page('adora-setup.php'		, 'Ermark Themes'	, 'Ermark Themes'	, 'read'		, 'http:&#47;&#47;www.ermark.ro/support/themes'		, ''					);
	
	if (!get_option('ermad_first_run', false)){
		add_submenu_page('adora-setup.php'		, 'Theme Install'	, 'Theme Install'	,'edit_themes'	, 'adora-setup.php&action=install'	, 'ermarkad_install'	);
		//themes.php?page=adora-setup.php&reset=true
	}
}

function ermarkad_options() {
    global $themename, $shortname, $options;
	$count_tabs = 0;

    if ( array_key_exists('saved', $_REQUEST) && $_REQUEST['saved'] ){ 
		echo '<div id="message" class="updated fade"><p><strong>'.__('Adora settings saved.','adora').'</strong></p></div>';
		}
		
    if ( array_key_exists('saved', $_REQUEST) && $_REQUEST['reset'] ) {
		echo '<div id="message" class="updated fade"><p><strong>'.__('Adora settings reset.','adora').'</strong></p></div>';
		}

    if ( array_key_exists('saved', $_REQUEST) && $_REQUEST['install'] ) {
		echo '<div id="message" class="updated fade"><p><strong>'.__('The theme has been installed!','adora').'</strong></p></div>';
		}

		
	echo '<div id="setup"><form method="post" >';
				
	foreach ($options as $value) {
		switch ( $value['type'] ) {
					
			case "toolbar":
				if ($value['mode']=="open"){
					echo '<div class="toolbar">
							<div class="toolbar-dashed" >
							<div class="toolbar-body" >
								<h3>'.$value['name'].'<span>'.$value['description'].'</span></h3>
								<div class="tools">';
									
								do_action('ermark_admin_bar');
								
						   echo '</div>';				
				}
						
				if ($value['mode']=="close"){
					echo '  </div>
					        </div>
						  </div>';
				}
				
				break;
				
			case "tab": 
				if ($value['selected']=='true'){
					echo '<li id="'.$value['id'].'" class="selected">'.$value['name'].'</li>';
				}else{
					echo '<li id="'.$value['id'].'" >'.$value['name'].'</li>';
				}
				break;
				
				
			case "full-panel": 
				if ($value['mode']=="open"){
					echo '<div class="full-panel clearfix">';
				}
							
				if ($value['mode']=="content"){
					echo '<div class="full-content clearfix">';
				}
				
				if ($value['mode']=="close"){
					echo '</div></div>';
				}
				
				break;
				
			case "tabs-bar": 
				if ($value['mode']=="open"){
					echo '<ul class="tabs">';
				}
				
				if ($value['mode']=="close"){
					echo '</ul>';
				}
				break;
				
			case "panel": 
				if ($value['mode']=="open"){
					echo '<div class="panel '.$value['tab'].' clearfix">
							<div class="panel-bar"><div><div><h3>'.$value['name'].'</h3><div class="controls"></div></div></div></div>
							<div class="panel-content">';
				}
				
				if ($value['mode']=="close"){
					echo '</div></div>';
				}
				break;

			case "open": 
				echo '<div class="section">';
				break;


			case "close":
				echo '</div>';
				break;

				
			case "label":
				echo '<label>'.$value['name'].'</label>';
				break;

				
			case "title":
				echo '<h2>'.$value['name'].'</h2>';
				break;
			
			
			case "maintitle":
				echo '<div style="display:block;background:url('.bloginfo('template_directory').'/images/adminheader.jpg) no-repeat bottom left #1f628c;height:60px;margin:10px 0;"></div>';
				echo $value['name'];
				break;

				
			case "titleWithSaveButton":
				echo '<h2><span>'.$value['name'].'</span><input name="save" type="submit" value="Save changes" /></h2><div class="inner">';
				break;

				
				
			case 'text':
				$textVal = '';
				if ( get_option( $value['id'] ) != "") {  $textVal = stripslashes(get_option( $value['id'] ));  } else {  $textVal = $value['std']; }
				
				echo '<div class="section clearfix">
						<div class="field-section">
							<h4>'.$value['section-title'].'</h4>
							<span>'.$value['section-description'].'</span>
					    </div>
					    <div class="field tx">
					        <input style="border:1px solid #CCCCCC;padding:4px;" name="'.$value['id'].'" id="'.$value['id'].'" type="'.$value['type'].'" value="'.$textVal.'"/>							
						</div>
					  </div>';
				break;

				
			case 'textarea':
				echo '<div class="section clearfix">
						<div class="field-section clearfix">
							<h4>'.$value['section-title'].'</h4>
							<span>'.$value['section-description'].'</span>
					    </div>
					  <div class="field ar">
						<textarea style="border:1px solid #CCCCCC;padding:4px;" name="'.$value['id'].'" type="'.$value['type'].'" cols="" rows="">';
							if ( get_option( $value['id'] ) != "") { 
								echo stripslashes(get_option($value['id']) ); 
							} else { 
								echo $value['std'];  
							}
				echo '</textarea>
					   </div>
					</div>';
				break;
				
			case 'showbox':
				echo '<div class="section clearfix">
						<div class="field-section clearfix">
							<h4>'.$value['section-title'].'</h4>
							<span>'.$value['section-description'].'</span>
					    </div>
					  <div class="field ar">
						<div style="border:1px solid #CCCCCC;padding:4px;color:brown;background:#fff;-moz-border-radius:4px;-webkit-border-radius:4px;">';
							if ( get_option( $value['id'] ) != "") { 
								$list = unserialize(get_option($value['id']));
								
								if (is_array($list)){
									foreach($list as $key=>$item){
										echo '<div>'.$item.',</div>';
									}
								}else{
									echo '<div>'.__('No e-mails for the moment.','adora').'</div>';
								}
							}else{
								echo '<div>'.__('No e-mails for the moment.','adora').'</div>';
							}
				echo '</div>
					   </div>
					</div>';
				break;

				
			case 'select':
				echo '<div class="section clearfix">
						<div class="field-section">
						<h4>'.$value['section-title'].'</h4>
						<span>'.$value['section-description'].'</span>
					  </div>';
					 
				$current = get_option( $value['id'] );
				echo ' <div class="field sl"> ';
				
				echo '<select name="'.$value['id'].'" id="'.$value['id'].'">';
					foreach ($value['options'] as $key => $option) {
						echo '<option';
							if ( get_option( $value['id'] ) == $option) { 
								echo ' selected="selected"'; 
							}
						echo '>'.$option.'</option>';
					}
				echo '</select>';
				
				echo '</div></div>';
				break;

				
			case "checkbox":
				$currentVal = get_option($value['id']);
				
				if ($currentVal=='true'){
					$checked = " checked ";
				}else{ 
					$checked = "";
				}
				
				echo '<div class="section clearfix">
						<div class="field-section">
						<h4>'.$value['section-title'].'</h4>
						<span>'.$value['section-description'].'</span>
					  </div>
					  <div class="field ch">
					     <input type="checkbox" name="'.$value['id'].'" id="'.$value['id'].'" '.$checked.' />
						 <label>'.$value['label'].'</label>
				      </div></div>';
				break;
		}
	}
	
		echo '<input name="save" type="submit" value="'.__('Save changes','adora').'" />';
		echo '<input type="hidden" name="action" value="save" />';
	echo '</form>';
	
	echo '<form method="post">';
		echo '<input  style="right:120px;" name="reset" type="submit" value="',__('Reset','adora').'" />';
		echo '<input type="hidden" name="action" value="reset" />';
	echo '</form>';
}

function loadSetupReference(){
	$theme_color = strtolower(get_option('ermad_theme_color', 'light'));
	
	if (is_admin()){
		wp_enqueue_script('ermark-setup-js', get_bloginfo( 'template_directory' ).'/setup/js/custom-setup.js');    		
		
		wp_enqueue_style('ermark-setup-css', get_bloginfo( 'template_directory' ).'/setup/css/options-panel.css');
	}else{
		wp_enqueue_style('theme-style', get_bloginfo( 'template_directory' ).'/style.css');
		
		if (!session_id() ){ 
			session_start(); 
		}
		
		if (array_key_exists('style',$_GET)){
			
			if (session_id()){
				$color = $_GET['style'];
				
				if ($color=='light') { $_SESSION['style'] = 'light'; }
				if ($color=='brown') { $_SESSION['style'] = 'brown'; }
			}
		}
		
		if (array_key_exists('style', $_SESSION)){
			$theme_color = $_SESSION['style'];
		}
		
		switch ( $theme_color ){
			case 'light': wp_enqueue_style('theme-light', get_bloginfo( 'template_directory' ).'/theme-light.css');break;
			case 'brown': wp_enqueue_style('theme-brown', get_bloginfo( 'template_directory' ).'/theme-brown.css');break;
		}
	
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', false, '1.4.2', true);

		wp_enqueue_script('jquery');
		
		wp_enqueue_script('ermark-adora-ingallery', get_bloginfo( 'template_directory' ).'/js/jquery.inGallery.js', array('jquery'),'1.0', true );    		
		wp_enqueue_script('ermark-adora-colorbox', get_bloginfo( 'template_directory' ).'/js/jquery.colorbox.js', array('jquery'),'1.0', true );    		
		wp_enqueue_script('ermark-adora-custom', get_bloginfo( 'template_directory' ).'/js/custom-adora.js', array('jquery'),'1.0', true );    		
	}
}

function setupProductsMeta() {
    add_meta_box( 'adora_product_setup',__('Product settings','adora'), 'setupProductsMetaSource', 'products', 'normal', 'high' );
}

function setupProductsMetaSource() {
		global $post;
		
		$custom = get_post_custom($post->ID);
		$product_price = $custom["product_price"][0];
		$product_description = $custom["product_description"][0];
		$product_offer = $custom["product_inoffer"][0];
		
		echo '
		<div id="product-options">
			<label style="display:block;">'.__('Price:','adora').'</label><input style="width:250px;" name="product_price" value="'.$product_price.'" />';
		
		if ($product_offer=="yes"){
			echo '<label style="display:block;">'.__('Todays offer:','adora').'</label><select style="width:250px;" name="product_inoffer"><option value="no">No</option><option value="yes" selected="selected">Yes</option></select>';
		}else{
			echo '<label style="display:block;">'.__('Todays offer:','adora').'</label><select style="width:250px;" name="product_inoffer"><option value="no">No</option><option value="yes">Yes</option></select>';
		}
		
		echo '
			<label style="margin-top:15px;display:block;">'.__('Ingredients:','adora').'</label><textarea style="width:320px;height:80px;" name="product_description">'.$product_description.'</textarea>		
		</div>';
}

function updateProductsMetaSource() {
	global $post;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post->ID;
	}

	update_post_meta($post->ID, "product_price", $_POST["product_price"]);
	update_post_meta($post->ID, "product_description", $_POST["product_description"]);
	update_post_meta($post->ID, "product_inoffer", $_POST["product_inoffer"]);
}


function metaProductsColumnsEdit($product_columns){
	$product_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"thumb" => __('Thumb','adora'),
		"title" => __('Product title','adora'),
		"price" => __('Price','adora'),
	);
	return $product_columns;
}
 
function metaProductsColumnsDisplay($product_columns){
	global $post;
	
	$custom = get_post_custom($post->ID);
	
	switch ($product_columns)
	{
		case "price":
			echo $custom["product_price"][0];
			break;
			
		case "thumb":
			the_post_thumbnail( 'product-thumbnail' );
			break;
	}
}
			

function manage_products_css() {
	if (array_key_exists('post_type', $_REQUEST) && ($_REQUEST['post_type']=="products")){	
		echo '
		<style type="text/css">
			.column-thumb { width:60px;text-align:center; }
			.column-price { width:50px;text-align:center; }
		</style>';
	}
}
 

function dates_inbetween($date1, $date2, $format = 'd-m-Y', $label_format = 'd F'){

    $day = 60*60*24;

    $date1 = strtotime($date1);
    $date2 = strtotime($date2);

    $days_diff = round(($date2 - $date1)/$day);

    $dates_array = array();

    $dates_array[date($format,$date1)] = date($label_format,$date1);
    
    for($x = 1; $x < $days_diff; $x++){
        $dates_array[date($format,($date1+($day*$x)))] = date($label_format,($date1+($day*$x)));
    }

    $dates_array[ date($format,$date2)] = date($label_format,$date2);

    return $dates_array;
}

function add_admin_menu_separator($position) {
  global $menu;
  $index = 0;
  foreach($menu as $offset => $section) {
    if (substr($section[2],0,9)=='separator')
      $index++;
    if ($offset>=$position) {
      $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
      break;
    }
  }
}

function productsFacebookLike(){
	global $post;
	
	if (get_option('ermad_products_social_facebook','true')=='false') { return null; }
	
	echo '
		<div class="social clearfix">
		
			<iframe src="http://www.facebook.com/plugins/like.php?
			href='.urlencode( get_permalink($post->ID) ).'&amp;
			layout=button_count&amp;
			show_faces=false&amp;
			width=100&amp;
			action=like&amp;
			font=segoe+ui&amp;
			colorscheme=dark&amp;
			height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:21px;float:right;" allowTransparency="true"></iframe> 
			
			<span class="facebook"> Share this on Facebook</span>
		</div>
	';
}

/**
* A pagination function
* @param integer $range: The range of the slider, works best with even numbers
* Used WP functions:
* get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4
* previous_posts_link(' « '); - returns the Previous page link
* next_posts_link(' » '); - returns the Next page link
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
      echo "<a href=" . get_pagenum_link(1) . ">&laquo; first </a>";
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
      echo "<a href='" . get_pagenum_link($max_page) . "'> last &raquo;</a>";
    }
  }
}

	function loadProductsInOffer(){
		$args=array(
		   'post_type'=>'any',
		   'showposts'=>3,
		   'meta_key'=>'product_inoffer',
		   'meta_value'=>'yes'
		);
	
			$myquery = new WP_Query($args);
			if ($myquery->have_posts()){
			  echo '<ul class="products_offer">';
			  while ($myquery->have_posts()) : $myquery->the_post(); 
					$custom = get_post_custom($post->ID);
					
					echo '<li>';
						echo '<strong>'.get_the_title().'</strong>';
						edit_post_link('Edit');
						echo '<span>'.erm_price_format($custom["product_price"][0]).'</span>';
					echo '</li>';
			  endwhile;
 			  echo '</ul>';
			}else{
				echo 'There are no offers today!';
			}
	}

	function loadProductsCateg($products_per_categ = 2, $full_view = false ){
		wp_reset_query();
		
		global $post;
		
		$products_per_categ = get_option('ermad_products_categ_items', 2);
		$products_full = get_option('ermad_products_categ_limit', 'false');
		
		if ($products_full == "false"){
			$product_class = "categ-visible";
		}else{
			$product_class = "categ-hidden";
		}
		
		//*****************************************************************
			$custom = get_post_custom($post->ID);
			if (array_key_exists('_ewf-categs-array',$custom)){
				$ewf_categs_array = $custom["_ewf-categs-array"][0];
				} 
			
			
			$ewf_tmp_categs_array = explode(',',$ewf_categs_array);
			$ewf_categs_array = null;
			
			if (count($ewf_tmp_categs_array)>1 ){
				foreach($ewf_tmp_categs_array as $key=>$value){ 
					$ewf_categs_array[$value] = null;
					
				}
			}
		//*****************************************************************
		$categories = array();
		
		if (array_key_exists('_ewf-categs-array',$custom) && $ewf_categs_array != null){
			//echo '<pre>';
			//	print_r($ewf_categs_array);
			//echo '</pre>';
			
			//**
			//** Loading elements in specified order
			//**
			
			//echo '*';
			foreach($ewf_categs_array as $categ_id => $categ_val){
				$categories[] = get_term($categ_id, 'producttype');
			}
		}else{
			//**
			//** Loading default elements
			//**
			
			//echo '**';
			$categories = get_terms('producttype', 'orderby=count&hide_empty=1');
		}
		
		/*
		echo '<pre>';
			print_r($categories);
		echo '</pre>';
		*/
		
		
		$count_categ = 0;
		
		
		$src = array();
		$src['menu'] = '<div id="prices-menu" class="clearfix view-full">';
		$src['full_categ'] = null;
		
		foreach ($categories as $categ) {
			$wpq = array ('taxonomy'=>'producttype','term'=>$categ->slug);
			$count_post = 0;
			
			$count_categ++;
			if ($count_categ % 2 == 0) { $categ_class = 'right'; } else { $categ_class = 'left'; }
			
			$src['limited_categ'] = '<ul class="prices clearfix '.$product_class.' '.$categ_class.'"  id="limited-categ-'.$categ->term_taxonomy_id.'">
							<li class="categ">
								<h3> - '.$categ->name.' -  </h3>';
								
								if ($products_full=='true') {
									$src['limited_categ'] .= '<a href="#" class="more-products">'.__('view more','adora').'</a>';
									}
									
							$src['full_categ'] .= '</li>';
			
			
			$src['full_categ'] .= '<div class="prices-categ '.$product_class.'" id="categ-'.$categ->term_taxonomy_id.'" >';
			$src['full_categ'] .= '<ul class="prices clearfix '.$categ_class.'">
							<li class="categ">
								<h3> - '.$categ->name.' - </h3>';
							
							if ($products_full=='true') {
								$src['full_categ'] .= '<a href="#" class="less-products">'.__('view all','adora').'</a>';
								}
			
			$src['full_categ'] .= '</li>';
							
				
			$myquery = new WP_Query($wpq);
			if ($myquery->have_posts()) :
			  while ($myquery->have_posts()) : $myquery->the_post(); 
					$count_post++;
					$custom = get_post_custom($post->ID);
					
					if ($count_post % 2 == 0) { $post_class = 'right product-post'; } else { $post_class = 'left product-post'; }
						
					$src['current_product']='
						<li class="item-'.$post_class.'" id="post-'.$post->ID.'">
							<div class="img" >';
							
					$src['current_product'].= get_the_post_thumbnail($post->ID,'product-menu-thumbnail');
					$src['current_product'].='</div>
							<div class="item-prices" ><h3><a href="'.get_permalink().'">'.$post->post_title .'</a></h3>
								<span>'.erm_price_format($custom["product_price"][0]).'</span>
							</div>';
														
							
							if ( get_option('ermad_products_ratings_enabled')=="true"){
								$src['current_product'].='<div class="item-rating">';
								
								$rating = wp_erm_rating::post_get_rating($post->ID);
								switch ($rating){
									case 0:
										$rating_arr = array('off','off','off','off','off');
										break;
										
									case 1:
										$rating_arr = array('on','off','off','off','off');
										break;
									
									case 2:
										$rating_arr = array('on','on','off','off','off');
										break;
									
									case 3:
										$rating_arr = array('on','on','on','off','off');
										break;
									
									case 4:
										$rating_arr = array('on','on','on','on','off');
										break;
									
									case 5:
										$rating_arr = array('on','on','on','on','on');
										break;
								}
									
								$src['current_product'].='
									<a href="#" class="star '.$rating_arr[0].'" rel="1">1</a> 
									<a href="#" class="star '.$rating_arr[1].'" rel="2">2</a> 
									<a href="#" class="star '.$rating_arr[2].'" rel="3">3</a> 
									<a href="#" class="star '.$rating_arr[3].'" rel="4">4</a> 
									<a href="#" class="star '.$rating_arr[4].'" rel="5">5</a> 
									<span class="state"></span>
								</div>';
							}
							
							$src['current_product'].='<p>'.substr($custom["product_description"][0],0,140).'...</p>
					    </li>';
					
					if ($count_post<$products_per_categ+1){
						$src['limited_categ'] .= $src['current_product'];
					}
					
					$src['full_categ'] .= $src['current_product'];
			  endwhile;
			endif;
			
			$src['menu'] .= $src['limited_categ'].'</ul>';		
			$src['full_categ'] .= '</ul> </div>';		
		}
		
		$src['menu'] .= '</div>';		
		
		if ($products_full == "true"){
			echo $src['menu'];
			echo $src['full_categ'];
		}else{
			echo $src['full_categ'];
		}
			
	}

	function loadProductsCategMobile($products_per_categ = 2 ){
		global $post;
		$categories = get_terms('producttype', 'orderby=count&hide_empty=1');
		$count_categ = 0;
		
		$src = array();
		$src['menu'] = '<div id="prices-menu" class="clearfix">';
		$src['full_categ'] = null;
		
		foreach ($categories as $categ) {
			$wpq = array ('taxonomy'=>'producttype','term'=>$categ->slug, 'orderby' => 'date', 'order' => 'ASC' );
			$count_post = 0;
			
			$count_categ++;
			if ($count_categ % 2 == 0) { $categ_class = 'right'; } else { $categ_class = 'left'; }
			
		 
			
			$src['full_categ'] .= '<div class="prices-categ" id="categ-'.$categ->term_taxonomy_id.'" >';
			$src['full_categ'] .= '<ul class="prices clearfix '.$categ_class.'">
							<li class="categ">
								<h3 class="title-categ">'.$categ->name.'</h3>
							</li>';
							
				
			$myquery = new WP_Query($wpq);
			if ($myquery->have_posts()) :
			  while ($myquery->have_posts()) : $myquery->the_post(); 
					$count_post++;
					$custom = get_post_custom($post->ID);
					
					if ($count_post % 2 == 0) { $post_class = 'right product-post'; } else { $post_class = 'left product-post'; }
						
					$src['current_product']='
						<li class="item-'.$post_class.' clearfix" id="post-'.$post->ID.'">
							<h3>'.$post->post_title .'<span>'.erm_price_format($custom["product_price"][0]).'</span></h3>';
							
							$src['current_product'].= '<div class="clearfix">';
							$src['current_product'].= get_the_post_thumbnail($post->ID,'product-menu-thumbnail');
							$src['current_product'].='<p>'.$custom["product_description"][0].'...</p>';
										
							$src['current_product'].='</div>
					    </li>';
					
					if ($count_post<$products_per_categ+1){
						$src['limited_categ'] .= $src['current_product'];
					}
					
					$src['full_categ'] .= $src['current_product'];
			  endwhile;
			endif;
			
			$src['menu'] .= $src['limited_categ'].'</ul>';		
			$src['full_categ'] .= '</ul> </div>';		
		}
		
		$src['menu'] .= '</div>';		
		
		echo $src['full_categ'];
	}

	function addReservationForm(){
		global $theme_color;
		
		$extra_class = null;
		if (get_option("ermad_reservations_menu_position","Left side") == "Left side"){ $extra_class = "posLeft"; }
		if (get_option("ermad_reservations_menu_position","Left side") == "Right side"){ $extra_class = "posRight"; }
		
		echo '
				<div class="reservations '.$extra_class.'">
					<div class="form">
						<form method="post" action="">

							<div class="clearfix">
								<div class="fdName">	
									<label>'.__('Name','adora').'</label>
									<input class="name" type="text" name="name" value="" />
								</div>
								<div class="phone">	
									<label>'.__('Phone','adora').'</label>
									<input class="fdPhone" type="text" name="phone" value="" maxlength="12" />
								</div>
							</div>
							
							<div class="clearfix">
								<div class="fdDate">	
									<label>'.__('Date:','adora').'</label>
									<select class="resDate" name="date">';

										$dayCount = 0;
										$daysArray = dates_inbetween( date('Ymd'), date("Ymd", strtotime("+7 days")) );
										$daySelected = 'selected="selected"';
										
										foreach($daysArray as $date=>$label){
											echo '<option '.$daySelected.' value="'.$date.'">'.$label.'</option>';
											$daySelected = null;
										}
									echo '
									</select>
								</div>
								<div class="fdTime">	
									<label>'.__('Time:','adora').'</label>
									<select class="resTime" name="time">
										<option value="09:00">09:00</option>
										<option value="10:00">10:00</option>
										<option value="11:00">11:00</option>
										<option value="12:00">12:00</option>
										<option value="13:00">13:00</option>
										<option value="14:00">14:00</option>
										<option value="15:00">15:00</option>
										<option value="16:00">16:00</option>
										<option value="17:00">17:00</option>
										<option value="18:00">18:00</option>
										<option value="19:00">19:00</option>
										<option value="20:00">20:00</option>
										<option value="21:00">21:00</option>
									</select>
								</div>
								<div class="fdGuest">	
									<label>'.__('Guest no:','adora').'</label>
									<input class="persons" type="text" name="persons" value="" maxlength="2" />
								</div>
							</div>
							
							<div class="clearfix">
								<label>'.__('Extra details','adora').'</label>
								<div class="textarea"><textarea class="details" cols="25" rows="5"></textarea></div>
							</div>
							
							<div class="clearfix">';
							
									if ($theme_color=='light'){
										echo '<a href="#"  class="btReserve btSubmit ctButton">'.__('Bookmark reservation','adora').'</a>';
									}else{
										echo '<a href="#"  class="btReserve btSubmit ctButton">'.__('Bookmark!','adora').'</a>';
									}
									
							echo '
								<a href="#"  class="btReserve btCancel ctButton">'.__('Close','adora').'</a>
							</div>
						</form>
					</div>	
					<div class="success">
						<h2>';
						echo get_option('ermad_reservations_confirmation', __('Thank you!', 'adora'));
						echo'  
						</h2>
					</div>			
				</div>';
	}
	
	function get_theme_color(){
		if (session_id()){
			if (array_key_exists('style',$_SESSION)){
				$theme_color = strtolower($_SESSION['style']);
			}else{
				$theme_color = strtolower(get_option('ermad_theme_color', 'light'));
			}
		}else{
			$theme_color = strtolower(get_option('ermad_theme_color', 'light'));
		}
		
		return $theme_color;
	}
	
	function addStyler(){
		global $user_ID;
		
		if( current_user_can('level_10')){}
		
		
		echo '<div class="styler">
				<a class="style-light" href="?style=light"></a>
				<a class="style-brown" href="?style=brown"></a>
			</div>';
	}
	

	
	function erm_price_format($price="0", $simbol="&#8364;",$positiol="1"){
		return $price.ERMAD_CURRENCY_SYMBOL;
	} 
	
	function get_post_rating($post_id = 0, $class='minimal', $count = false){
		if ($post_id==0){
			global $post;
			$post_id = $post->ID;
		}
		
		if ( get_option('ermad_products_ratings_enabled')=="true"){
			$src = '<div class="item-rating-small clearfix '.$class.'" >';
			
			$rating = wp_erm_rating::post_get_rating($post_id);
			switch ($rating){
				case 0:
					$rating_arr = array('off','off','off','off','off');
					break;
					
				case 1:
					$rating_arr = array('on','off','off','off','off');
					break;
				
				case 2:
					$rating_arr = array('on','on','off','off','off');
					break;
				
				case 3:
					$rating_arr = array('on','on','on','off','off');
					break;
				
				case 4:
					$rating_arr = array('on','on','on','on','off');
					break;
				
				case 5:
					$rating_arr = array('on','on','on','on','on');
					break;
			}
				
			$src .= '
				<a href="#" class="star '.$rating_arr[0].'" rel="1">1</a> 
				<a href="#" class="star '.$rating_arr[1].'" rel="2">2</a> 
				<a href="#" class="star '.$rating_arr[2].'" rel="3">3</a> 
				<a href="#" class="star '.$rating_arr[3].'" rel="4">4</a> 
				<a href="#" class="star '.$rating_arr[4].'" rel="5">5</a>';
				
				if ($count){
					$src.= '<span class="count">'.wp_erm_rating::count_post_votes($post_id).' votes so far!</span>';
				}
				
				$src.=  '<span class="state"></span>';
			$src.=  '</div>';
		
			echo $src;
		}
	}
	
?>