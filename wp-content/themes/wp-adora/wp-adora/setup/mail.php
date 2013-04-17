<?php	
	// Set the header to json for jquery
	header('content-type:application/json');
	
	$json_data =array();
	$encoded = null;
		
	if (is_array($_POST)  &&  array_key_exists('action',$_POST) && $_POST['action']=='sendMail'){
			$mail = $_POST['mail'];
			$name = $_POST['name'];
			$message = $_POST['message'];
			
			$success='*';
			$errMsg = null;
			
			if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				$success = sendMail($mail, $name, $message);
				$errMsg = 'The e-mail has been sent successfuly! Hi Hi Hi!';
			}else{
				$success==0;
				$errMsg = 'The e-mail address is not valid!';
			}
			
			$json_data = array(
				'success'=>$success, 
				'message'=>$errMsg );
	}
	echo json_encode($json_data);
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
function sendMail($sender, $name, $message){
	$header  = "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$header .= "From: CV Contact <contact@mycv.com>\r\n";
	$header .= "Reply-To: ".$sender."\r\n";

	$email = 'cv.owner@gmail.com';
	$success = mail($email, "CV Contact - ".$name, mailContent($sender, $name, $message), $header);
	
	if ($success=='true'){
		return 1;
	}else{
		return 0;
	}
}
		
	function mailContent($sender, $name, $message){
		$date = date('D d, F Y');
		$picture = 'http://www.gravatar.com/avatar/'.md5($sender).'?s=36';
		
		$src = '
			<html>
			<head>
			   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			   <title>Template 6 - Single Column</title>
			   <style type="text/css" media="screen">
				  body {
					margin: 0;
					padding: 0;
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

									   <p>
											<img src="'.$picture.'" width="36" height="36" alt="Picture" /> 
											<span class="name">'.$name.'</span>
											<span class="date">'.$date.'</span>
										</p>
										
										<p>'.$message.'</p>
										<p style="text-align:right;"><a href="#">E-mail : '.$sender.'</a></p>
									</td>
								 </tr>
							  </table>
							  
						   </td>
						</tr>
						<tr>
						   <td align="center" valign="top" class="footer">
							  This e-mail is send from your <span>CV</span> contact form</span>.<br>You can change or remove this.
						   </td>
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
		
		
		
		
?>