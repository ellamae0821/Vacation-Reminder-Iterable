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


function post_vacation_request() {	

	$email = 'earana@staradvertiser.com';

	$user = $iterable->user_get_by_email($email);
	phpLog($user);
	$updatedSubscriptions = array();

	// $sub = $user['content']['user']['dataFields']['real_subscriptions'];
	foreach ($user['content']['user']['dataFields']['real_subscriptions'] as $key => $subscription) {
																					//without ampersand we only iterate over a copy of the array and does not affect original array .
		if( $subscription['publicationId'] == "1000016" && $subscription['circProNameId'] == "1581412")
		{

			$subscription['stop_date'] = "2019-05-29";
			$subscription['restart_date'] = "2019-05-30";


		}
		$updatedSubscriptions [] = $subscription;

	}
	$update = $iterable->user_update_by_email($email, array( "real_subscriptions" => $updatedSubscriptions ) );

}

?>