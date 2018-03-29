<?php
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	error_reporting( E_ALL );


	require_once('Email_Service.php');

	$iterable = new Email_Service('-', true, true);


	function phpLog($data){
		echo "<pre>";
		print_r($data);
		echo "<pre>";
	}

	$email = 'earana@-.com';
	$publicationId = '1000016';
	$circProNameId = '1581412';
	$stop_date = "2018-05-29";
	$restart_date = "2018-06-01";


	function vacation_reminder($iterable, $email, $publicationId, $circProNameId, $stop_date, $restart_date ){
		//calls the user by email to check where to insert dates
		$user = $iterable->user_get_by_email($email);
		phpLog($user);
		//stores the updated subscription
		$updatedSubscriptions = array();
		foreach ($user['content']['user']['dataFields']['real_subscriptions'] as $key => $subscription) {
			if( $subscription['publicationId'] == $publicationId && $subscription['circProNameId'] == $circProNameId)
			{
				$subscription['stop_date'] = $stop_date;
				$subscription['restart_date'] = $restart_date;
				echo $key;
			}
			$updatedSubscriptions [] = $subscription;
		}
		$update = $iterable->user_update_by_email($email, array( "real_subscriptions" => $updatedSubscriptions ) );
	}
	
	vacation_reminder($iterable, $email, $publicationId, $circProNameId, $stop_date, $restart_date )

?>