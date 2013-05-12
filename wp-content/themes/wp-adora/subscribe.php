<?php
/*
 * 	E-mail subscribe via JSON
 */
	
	header('Content-type: text/json');

	require_once('../../../wp-config.php');
	require_once('../../../wp-includes/wp-db.php');
	require_once('../../../wp-includes/pluggable.php');
	
	
	$mails = get_option('ermad_newsletter_list', '*');
	$exists = false;
	
	if (array_key_exists('subscribe',$_POST)){
	
		if ($mails=='*'){
			add_option('ermad_newsletter_list', $value = serialize(array(trim(strtolower($_POST['subscribe'])))), $description = 'The e-mail list for newsletter', $autoload = 'no');
			
			echo json_encode(array('success'=>1,'message'=>__('Thank you for your interest!','adora')));
		}else{
			$new_mails = unserialize($mails);
			$current_mail = trim(strtolower($_POST['subscribe']));
			
			foreach($new_mails as $key=>$oldMail){
				if ($current_mail==$oldMail){
					$exists = true;
				}
			}
			
			if (!$exists){
				$new_mails[] = $current_mail;
				update_option('ermad_newsletter_list', $value = serialize($new_mails));
				
				echo json_encode(array('success'=>1,'message'=>__('Thank you for your interest!','adora')));
			}else{
				echo json_encode(array('success'=>0,'err'=>'101','message'=>__('This e-mail is already registered!','adora')));
			}
		}
		
		//echo  json_encode(array('success'=>0,'err'=>'90','mails'=>'['.$mails.']', 'message'=>__('Something bad happend!')));
	}else{
		echo  json_encode(array('success'=>0,'err'=>'100','message'=>__('No data recived!')));
	}
	
?>