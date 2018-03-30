<?php



/**
 * update_user_vacation_dates function will update a user's info on iterable with a stop_date & restart_date 
 * @param  new Email Service 
 * @param  array 	contains email, publicationId, circProNameId, stop_date and restart_date
 */


//function for Email Service 
	function update_user_vacation_dates($arr){
		$user = user_get_by_email($arr['email']);
		$updatedSubscriptions = array();
		foreach ($user['content']['user']['dataFields']['subscriptions'] as $key => $subscription) {
			if( $subscription['publicationId'] == $arr['publicationId'] && $subscription['circProNameId'] == $arr[circProNameId])
			{
				$subscription['stop_date'] = $arr['stop_date'];
				$subscription['restart_date'] = $arr['restart_date'];
			}
			$updatedSubscriptions [] = $subscription;
		}
		$update = user_update_by_email($arr['email'], array( "subscriptions" => $updatedSubscriptions ) );
	}




//--------------------------------------------------------------------------------------------

	// require_once('Email_Service.php');
	// $iterable = new Email_Service('-', true, true);

	// function humanize($data){
	// 	echo "<pre>";
	// 	print_r($data);
	// 	echo "<pre>";
	// }
	
	// function update_user_vacation_dates($iterable, $arr ){
	// 	$user = $iterable->user_get_by_email($arr['email']);
	// 	$updatedSubscriptions = array();
	// 	foreach ($user['content']['user']['dataFields']['subscriptions'] as $key => $subscription) {
	// 		if( $subscription['publicationId'] == $arr['publicationId'] && $subscription['circProNameId'] == $arr[circProNameId])
	// 		{
	// 			$subscription['stop_date'] = $arr['stop_date'];
	// 			$subscription['restart_date'] = $arr['restart_date'];
	// 		}
	// 		$updatedSubscriptions [] = $subscription;
	// 	}
	// 	$update = $iterable->user_update_by_email($arr['email'], array( "subscriptions" => $updatedSubscriptions ) );
	// }

?>
