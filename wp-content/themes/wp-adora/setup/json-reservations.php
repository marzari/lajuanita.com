<?php 

/*
 * endpoint for ajax requests
 */
header('Content-type: text/json');
//if(!isset($_REQUEST["method"]) || !isset($_REQUEST["post_id"]))exit();

require_once('../../../../wp-config.php');
require_once('../../../../wp-includes/wp-db.php');
require_once('../../../../wp-includes/pluggable.php');

$user_id=wp_get_current_user()->ID;

$responseObj=array();

if (array_key_exists('action', $_POST)){

	switch ($_POST['action']){
		case 'saveReservation':
			
			$_POST['name'] = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$_POST['phone'] = filter_var( $_POST['phone'], FILTER_SANITIZE_STRING );
			$_POST['date'] = filter_var( $_POST['date'], FILTER_SANITIZE_STRING );
			$_POST['time'] = filter_var( $_POST['time'], FILTER_SANITIZE_STRING );
			$_POST['details'] = filter_var( $_POST['details'], FILTER_SANITIZE_STRING );
			$_POST['persons'] = intval($_POST['persons']);
			
			$new_reservation = array(
				'post_type' => 'reservations',
				'post_title' => $_POST['name'],
				'post_status' => 'private',
				'post_author' => 1,
			);
			
			$reservation_id =  wp_insert_post($new_reservation);
			update_post_meta($reservation_id, 'reservation_phone' 			, $_POST['phone'] );
			update_post_meta($reservation_id, 'reservation_persons' 		, $_POST['persons'] );
			update_post_meta($reservation_id, 'reservation_date' 			, $_POST['date'] );
			update_post_meta($reservation_id, 'reservation_time' 			, $_POST['time'] );
			update_post_meta($reservation_id, 'reservation_details' 		, $_POST['details'] );
			update_post_meta($reservation_id, 'reservation_confirmed' 		, '0' );
			
			if (get_option('ermad_reservations_notifications','false')=='true'){
				sendMail($_POST['name'],$_POST['phone'], $_POST['date'], $_POST['time'], $_POST['persons'], $_POST['details']);
			}
			
			$responseObj["success"]=true;
			break;
	}
	
}

		
	function sendMail($name, $phone, $date, $time, $persons, $details ){
		$email = get_option('ermad_reservations_notifymail');
		
		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$header .= "From: Reservations <".$email.">\r\n";
		//$header .= "Reply-To: ".$sender."\r\n";

		$success = mail($email, "New Reservation - ".$name, mailContent($name, $phone, $date, $time, $persons, $details), $header);
		
		if ($success=='true'){
			return 1;
		}else{
			return 0;
		}
	}
		
	function mailContent($name, $phone, $date, $time, $persons, $details){
		$date = date('D d, F Y');
		$picture = 'http://www.gravatar.com/avatar/'.md5($sender).'?s=36';
		
		$src = '
			<html>
			<head>
			   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			   <title>Reservation - '.$name.'</title>
			   <style type="text/css" media="screen">
				  body {
					margin:0;
					padding:0;
				  }

				  a {
					color: #cc0000;
				  }

				  span.date{
					font-family: Georgia;
					font-size: 12px;
					font-weight: normal;
					color: #999999;
					margin: 0;
					padding: 0;
					display:block;
					text-transform: uppercase;
				  }
					
				img {
					margin:0 5px 0 0;
					padding:0px;
					float:left;
					border:4px solid #eaeaea;
				}
					
				 span.name {
					font-family: Georgia;
					font-size:22px;
					font-weight: normal;
					color: #000000;
					padding:0;
					margin:0;
				  }

				  p {
					font-family: Georgia;
					font-size: 13px;
					font-weight: normal;
					color: #333333;
					margin: 0 0 20px 0;
					padding: 0;
				  }

				  td.mainbar p.top a {
					font-family: Georgia;
					font-size: 10px;
					font-weight: normal;
					color: #cc0000;
				  }

				  td.footer {
					font-family: Georgia;
					font-size: 11px;
					font-weight: normal;
					color: #333333;
					padding: 10px 0 10px 0;
				  }

				  td.footer span {
					font-weight: bold;
				  }
			   </style>

			</head>
			<body>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			   <tr>
				  <td align="center">
					 
					 <table width="580" border="0" cellspacing="0" cellpadding="0">
						<tr>
						   <td>
							  
							  <table width="580" border="0" cellspacing="20" cellpadding="0">
								 
								 <tr>
									<td width="580" align="left" valign="top" class="mainbar">
										<p><strong>Name:</strong> '.$name.'</p>
										<p><strong>Phone:</strong> '.$phone.'</p>
										<p><strong>Date:</strong> '.$date.'</p>
										<p><strong>Time:</strong> '.$time.'</p>
										<p><strong>Persons:</strong> '.$persons.'</p>
										
										<p><strong>Details:</strong> '.$details.'</p>
									</td>
								 </tr>
							  </table>
							  
						   </td>
						</tr>
						<tr>
						   <td align="center" valign="top" class="footer"></td>
						</tr>
					 </table>
					 
				  </td>
			   </tr>
			</table>

			</body>
			</html>
			';
		return $src;
	}

echo json_encode($responseObj);

?>