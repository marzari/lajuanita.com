<?php
/*
 * 	Send E-mail  via JSON
 */
		
		if (defined('MOBILE-VERSION')){
			if (array_key_exists('mobile',$_REQUEST)){
				define('MOBILE-SUBMIT', true);
			}
		}else{
			require_once('../../../wp-config.php');
			require_once('../../../wp-includes/wp-db.php');
			require_once('../../../wp-includes/pluggable.php');
		}
	
	
 		$name_error = null;
		$email_error = null;
		$email_sent = false;
		$subject_error = null;
		$message_error = null;
		
		$admin_email = get_option('admin_email');
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From:<".$admin_email.">\r\n";
		$headers .= "Reply-To: ".$sender."\r\n";
		
		if(trim($_REQUEST['c_name'] == "")){
			$name_error = __('You forgot to fill in your name', 'adora');
			$error = true;
		}else{
			$c_name = trim($_REQUEST['c_name']);
		}

		if(trim($_REQUEST['c_email'] === "")){
			$email_error = __('Your forgot to fill in your email address', 'adora');
			$error = true;
		}else if(!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_REQUEST['c_email']))){
			$email_error = __('Wrong email format', 'adora');
			$error = true;
		}else{
			$c_email = trim($_REQUEST['c_email']);
		}

		if(trim($_REQUEST['c_message'] === "")){
			$message_error = __('You forgot to fill in your name', 'adora');
			$error = true;
		}else{
			$c_message = trim($_REQUEST['c_message']);
		}

		$c_website = trim($_REQUEST['c_website']);
		
		if($error != true) {
			$email_to = get_option('ermad_contact_mail'); //change this with your email address
			$message_body = "<p>
								<b>Name:</b> $c_name
							</p>
							<p>
								<b>Email:</b> $c_email
							</p>
							<p>
								<b>Website:</b> $c_website
							</p>
							<p>
								<b>Message:</b> $c_message
							</p>";

			mail($email_to, "Contact form - ".get_option('siteurl'), $message_body, $headers);
		
			$email_sent = true;
		}
		
		if ($email_sent==true && !defined('MOBILE-VERSION')){
			echo __('** The e-mail has been send sucessfuly, thank you!','adora');
		}
?>