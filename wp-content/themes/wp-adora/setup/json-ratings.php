<?php 

	//require_once('../../../../wp-config.php');
	/*
	require_once('../../../wp-includes/wp-db.php');
	require_once('../../../../../wp-includes/pluggable.php');
	require_once('../../../../../wp-admin/includes/upgrade.php');
	*/

	require_once('functions-ratings.php');
	
	if (array_key_exists('rating',$_POST)){
		header('Content-type: text/json');
		
		$rating = intval( $_POST['rating'] );
		$post_id = intval( str_replace('post-','',$_POST['post'] ));
		
		if ($rating>0 && $post_id>0){
			echo wp_erm_rating::post_add_rating($post_id, $rating);
		}else{
			echo json_encode(array('success'=>0,'err'=>100,'data'=>'['.$post_id + ' - ' + $rating.']','message'=>__('An error has occurred!','adora')));
		}
	}

?>
