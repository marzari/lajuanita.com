<?php 
	load_theme_textdomain( 'adora', TEMPLATEPATH.'/lang' );
	
	add_action('init', 'register_post_type_reservations');

	add_action('admin_head', 'manage_reservations_css');

	add_action('admin_menu', 'setupReservationsMeta');
	add_action('save_post', 'updateReservationsMetaSource');

	add_filter("manage_edit-reservations_columns", "metaReservationsColumnsEdit");
	add_action("manage_posts_custom_column",  "metaReservationsColumnsDisplay");

	
	$reservation_hilight_css = '/**/';
	
	function register_post_type_reservations() {
		register_post_type('reservations', 
		
			array(
			'labels' => array(
				'name' => __( 'Reservations', 'adora' ),
				'singular_name' => __( 'Reservation','adora' ),
				'add_new' => __( 'Add New','adora' ),
				'add_new_item' => __( 'Add New Reservation','adora' ),
				'edit' => __( 'Edit', 'adora' ),
				'edit_item' => __( 'Edit Reservation', 'adora' ),
				'new_item' => __( 'New Reservation', 'adora' ),
				'view' => __( 'View Reservation','adora' ),
				'view_item' => __( 'View Reservation','adora' ),
				'search_items' => __( 'Search Reservations', 'adora' ),
				'not_found' => __( 'No reservations found', 'adora' ),
				'not_found_in_trash' => __( 'No reservactions found in Trash', 'adora'),
				'parent' => __( 'Parent Reservations', 'adora' ),
				),
			'public' => false,
			'rewrite' => false,
			'show_ui' => true,
			'supports' => array('title')
			));
	}
	
	function metaReservationsColumnsEdit($reservation_columns){
		$reservation_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __('Name', 'adora'),
			"phone" => __('Phone', 'adora'),
			"persons" => __('Persons', 'adora'),
			"rzdate" => __('Date', 'adora'),
			"time" => __('Time', 'adora'),
			"details" => __('Details','adora'),
			//"confirm" => __('Confirmed','adora'),
		);
		return $reservation_columns;
	}

 
	function metaReservationsColumnsDisplay($reservation_columns){
		global $reservation_hilight_css;
		global $post;
		
		$reservation_current_date = date('d-m-Y');
		$custom = get_post_custom($post->ID);
		
		/*
		if ($reservation_current_date == $custom["reservation_date"][0]){
			echo '*TODAY* ['.$post->ID.']';
			$reservation_hilight_css.=' #post-'.$post->ID.'{ background:gold; }';
		}
		*/
		
		switch ($reservation_columns)
		{
		
			case "rzdate":
				echo $custom["reservation_date"][0];
				break;

			case "time":
				echo $custom["reservation_time"][0];
				break;
				
			case "phone":
				echo $custom["reservation_phone"][0];
				break;
				
			case "details":
				echo $custom["reservation_details"][0];
				break;
				
			case "persons":
				echo $custom["reservation_persons"][0];
				break;

			case "confirm":
				echo '<input type="button" class="btResConfirmYes" value="'.__('Yes','adora').'" /> <input type="button" class="btResConfirmNo" value="'.__('No','adora').'" />';
				break;
			
		}
	}

	function setupReservationsMeta() {
		 add_meta_box( 'adora_reservations_setup','Reservation settings', 'setupReservationsMetaSource', 'reservations', 'normal', 'high' );
	}

	function updateReservationsMetaSource() {
		global $post;
		update_post_meta($post->ID, "reservation_details", $_POST["reservation_details"]);
		update_post_meta($post->ID, "reservation_date", $_POST["reservation_date"]);
		update_post_meta($post->ID, "reservation_time", $_POST["reservation_time"]);
		update_post_meta($post->ID, "reservation_phone", $_POST["reservation_phone"]);
		update_post_meta($post->ID, "reservation_persons", $_POST["reservation_persons"]);
	}

	function setupReservationsMetaSource() {
			global $post;
			
			$custom = get_post_custom($post->ID);
		
			$reservation_details = $custom["reservation_details"][0];
			$reservation_phone = $custom["reservation_phone"][0];
			$reservation_date = $custom["reservation_date"][0];
			$reservation_time = $custom["reservation_time"][0];
			$reservation_persons = $custom["reservation_persons"][0];
			
			echo '
			<div class="resSetupSection" id="reservation-datetime">
				<label style="display:block;">'.__('Date & Time:').'</label>		
				
				<select class="reservation_date" name="reservation_date">';
				
					$dayCount = 0;
					//$daysArray = dates_inbetween( date('Ymd'), date("Ymd", strtotime("+7 days")) );
					$resDate = strtotime($reservation_date);
					$daysArray = dates_inbetween( date('d-m-Y',strtotime($reservation_date.' -4 days')), date('d-m-Y',strtotime($reservation_date.' +4 days')) );
								

					foreach($daysArray as $date=>$label){
						if ($date==$reservation_date) { 
							$daySelected = 'selected="selected"';	 
						} else { 
							$daySelected = null; 
						}
						
						echo '<option '.$daySelected.' value="'.$date.'">'.$label.'('.$date.')</option>';
					}
				
				echo '</select> 
				
				<select class="reservation_time" name="reservation_time">';
				for ($i=9; $i<25; $i++ ){
					if ($reservation_time == $i.':00'){
						echo '<option value="'.$i.':00" selected="selected">'.$i.':00</option>';
					}else{
						echo '<option value="'.$i.':00">'.$i.':00</option>';
					}
				}
				echo '
				</select>
			</div>
			
			<div class="resSetupSection">
				<label style="display:block;">'.__('Phone:','adora').'</label><input style="width:220px;" class="reservation_phone" value="'.$reservation_phone.'" name="reservation_phone" />
			</div>
			
			<div class="resSetupSection">
				<label style="display:block;">'.__('Description: ','adora').'</label><textarea style="width:220px;" class="reservation_description" name="reservation_details">'.$reservation_details.'</textarea>
			</div>
			
			<div class="resSetupSection">
				<label style="display:block;">'.__('Persons: ','adora').'</label><input style="width:220px;" class="reservation_description" name="reservation_persons" value="'.$reservation_persons.'" />
			</div>';
	}

	function manage_reservations_css() {
		global $reservation_hilight_css;
		
		if (array_key_exists('post_type', $_REQUEST) && ($_REQUEST['post_type']=="reservations")){	
			echo '
			<style type="text/css">
				.resSetupSection {
					padding-bottom:25px;
					padding-top:10px;
				}
				
				.resSetupSection label {
					padding-bottom:2px;
				}
				
				.reservation_description {
					width:400px;
				}
				
				.reservation_time {
					width:65px;
				}
				
				.reservation_date {
					width:330px;
				}
				
				.column-confirm 	{ width:9%;text-align:left; 	}
				.column-phone 		{ width:9%;text-align:left; 	}
				.column-rzdate 		{ width:80px;text-align:left; 	}
				.column-time  		{ width:60px;text-align:left; 	}
				.column-title  		{ width:25%;text-align:left; 	}
				.column-persons 	{ width:80px;text-align:left; 	}
			</style>';
		}
	}

?>