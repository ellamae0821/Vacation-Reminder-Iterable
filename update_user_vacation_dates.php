<?php
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	error_reporting( E_ALL );

	require_once('Email_Service.php');
	$iterable = new Email_Service('-', true, true);

	function humanize($data){
		echo "<pre>";
		print_r($data);
		echo "<pre>";
	}

	$email = 'ella-';
	$publicationId = '1000016';
	$circProNameId = '1581412';
	$stop_date = "2018-04-01";
	$restart_date = "2018-04-02";

/**
 * update_user_vacation_dates function will add/update a user's field on iterable adding the stop_date & restart date 
 * @param  [type]
 * @param  new Email Service 
 * @param  string 	$email
 * @param  string 	$publicationId
 * @param  string 	$circProNameId
 * @param  string 	$stop_date
 * @param  string 	$restart_date
 */

	function update_user_vacation_dates($iterable, $email, $publicationId, $circProNameId, $stop_date, $restart_date ){
		$user = $iterable->user_get_by_email($email);
		// humanize($user);
		$updatedSubscriptions = array();
		foreach ($user['content']['user']['dataFields']['subscriptions'] as $key => $subscription) {
			if( $subscription['publicationId'] == $publicationId && $subscription['circProNameId'] == $circProNameId)
			{
				$subscription['stop_date'] = $stop_date;
				$subscription['restart_date'] = $restart_date;
				echo $key;
			}
			$updatedSubscriptions [] = $subscription;
		}
		$update = $iterable->user_update_by_email($email, array( "subscriptions" => $updatedSubscriptions ) );
	}
	update_user_vacation_dates($iterable, $email, $publicationId, $circProNameId, $stop_date, $restart_date )

?>
