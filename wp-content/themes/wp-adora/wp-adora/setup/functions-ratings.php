<?php

	if (defined('ABSPATH')){
		include_once(ABSPATH.'wp-config.php');
		include_once(ABSPATH.'wp-includes/wp-db.php');
		include_once(ABSPATH.'wp-includes/pluggable.php');
		include_once(ABSPATH.'wp-admin/includes/upgrade.php');	
	}else{
		define('ABSPATH','../../../../');
		
		include_once(ABSPATH.'wp-config.php');
		include_once(ABSPATH.'wp-includes/wp-db.php');
		include_once(ABSPATH.'wp-includes/pluggable.php');
		include_once(ABSPATH.'wp-admin/includes/upgrade.php');	
	}
	
class wp_erm_rating {

	public $post_id;
	public $votes_number;
	public $votes_score;
	
	public static $table_rating;
	public static $table_ip;
	
	private function getIP(){
		if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) === TRUE)
			return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) === TRUE)
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		else return $_SERVER['REMOTE_ADDR'];
	}
	
	public static function initialize(){
		global $wpdb;
		
		self::$table_rating = $wpdb->prefix . "erm_rating";
		self::$table_ip = $wpdb->prefix . "erm_rating_ip";
		
		self::install();
	} 
	 
	public static function post_get_rating($post_id){
		global $wpdb;
		
		if (self::$table_rating==null){ self::initialize(); }
		
		$rating = $wpdb->get_results("SELECT rating FROM ".self::$table_rating." WHERE post_id=".$post_id);
		
		if (is_array($rating) && count($rating)>0 ){
			return $rating[0]->rating;
		}else{
			return 0;
		}
	}
	 
	public static function post_add_rating($post_id, $rating){
		global $wpdb;
		
		if (self::$table_rating==null){ self::initialize(); }
		
		$ip = self::getIP();
		$rating = intval($rating);
		
		if (self::is_post_rated($post_id)){
			// if the post have been rated
			if (self::is_post_already_rated($post_id, $ip)){
				// if the post had already been rated from this ip
				$rating = $wpdb->get_results("SELECT rating FROM ".self::$table_rating." WHERE post_id=".$post_id);
				
				return json_encode(array('success'=>0,'rating'=>$rating[0]->rating, 'debug'=>10, 'err'=>120, 'message'=>__('Already voted!','adora')));
			}else{
				$statement = $wpdb->get_results("SELECT rating FROM ".self::$table_ip." WHERE post_id=$post_id");
				$total = $rating;
				$quantity = 1;
				$mode = 0;
				
				foreach( $statement as $key=>$cr_rating){
					$total = $total + $cr_rating->rating;
					$quantity++;
					//echo '['.$quantity.']rating:'.$cr_rating->rating;
				}
				
				if ($total==0 || $quantity==0){
					$mode = '1';
					$average_rating = $rating;
				}else{
					$mode = '2';
					$average_rating = round(($total/$quantity),0);
				}
				
				$statement = $wpdb->query("UPDATE ".self::$table_rating." SET rating=$average_rating WHERE post_id=$post_id");
				
				$sql = "INSERT INTO ".self::$table_ip." (id,post_id,rating,ip) VALUES ( LAST_INSERT_ID(),$post_id, $rating, '$ip' )";
				$wpdb->query($sql);
				
				return json_encode(array('success'=>1,'rating'=>$average_rating, 'quantity'=>$quantity, 'total'=>$total, 'mode'=>$mode,'debug'=>20,'message'=>__('Thank you!','adora')));
			}	
		}else{
			// if the post never been rated
			//$sql = "INSERT INTO $wpdb->likes (id,post_id,rating,) VALUES(LAST_INSERT_ID(),$post_id,$user_id,now() )";
			$sql = "INSERT INTO ".self::$table_rating." (id,post_id,rating) VALUES ( LAST_INSERT_ID(),$post_id, $rating )";
			$wpdb->query($sql);
			
			$sql = "INSERT INTO ".self::$table_ip." (id,post_id,rating,ip) VALUES ( LAST_INSERT_ID(),$post_id, $rating, '$ip' )";
			$wpdb->query($sql);
			
			return json_encode(array('success'=>1,'rating'=>$rating,'debug'=>30,'message'=>__('Thank you!','adora')));
		}
	}
	
	public static function is_post_rated($post_id){
		global $wpdb;
		
		$count = $wpdb->get_var("SELECT count(*) FROM ".self::$table_rating." WHERE post_id=".$post_id);
		return $count;
	}
	
	public static function is_post_already_rated($post_id, $ip){
		global $wpdb;
		
		$count = $wpdb->get_var("SELECT count(*) FROM ".self::$table_ip." WHERE post_id=$post_id AND ip='$ip' ");
		return $count;
	}
	
	public static function count_post_votes($post_id){
		global $wpdb;
		
		$count = $wpdb->get_var("SELECT count(*) FROM ".self::$table_ip." WHERE post_id=$post_id ");
		return $count;
	}
	
	public static function install(){
		global $wpdb;
		$table_sql = "SHOW TABLES LIKE '".self::$table_rating."'";
		
		if(!$wpdb->get_var($table_sql)) {
			//echo '**setup**['.$table_sql.']';
			
			$sql = "CREATE TABLE ".self::$table_rating." (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  post_id int(11) NOT NULL,
			  rating int(2) NOT NULL,
			  UNIQUE KEY id (id)
			);

			CREATE TABLE ".self::$table_ip." (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  post_id int(11) NOT NULL,
			  rating int(11) NOT NULL,
			  ip text NOT NULL,
			  PRIMARY KEY id (id)
			);";
				
			dbDelta($sql);
		}else{
			//echo '**no-setup** ['.$table_sql.']';
		}
	}
	
	
	
}

?>