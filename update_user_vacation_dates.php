<?php




/*
	update_user_vacation_dates function will update a user's info on iterable with stop_date & restart_date.
	This will then trigger a reminder email to be sent on x number of days before the stop date. 
*/

function update_user_vacation_dates($email,$publicationId,$circProNameId,$stop_date,$restart_date )
{
	require_once($_SERVER['DOCUMENT_ROOT']."/myaccount/resources/scripts/Email_Service.php");
	$email_service = new Email_Service( "-", false, true );

	$user = $email_service->user_get_by_email($email);
	$updatedSubscriptions = array();
	foreach ($user['content']['user']['dataFields']['subscriptions'] as $key => $subscription) 
	{
		if( $subscription['publicationId'] == $publicationId && $subscription['circProNameId'] == $circProNameId)
		{
			$subscription['stop_date'] = $stop_date;
			$subscription['restart_date'] = $restart_date;
		}
		$updatedSubscriptions [] = $subscription;
	}
	$update = $email_service->user_update_by_email($email, array( "subscriptions" => $updatedSubscriptions ) );
}


//------------------------------------------------------------ TEST ------------------------------------------------------------

function update_user_vacation_dates($email,$publicationId,$circProNameId,$stop_date,$restart_date )
{
	require_once("Email_Service.php");
	$email_service = new Email_Service( "-", false, true );

	$user = $email_service->user_get_by_email($email);

	echo "<pre>";
	print_r($user);		
	echo "<pre>";

	$updatedSubscriptions = array();
	foreach ($user['content']['user']['dataFields']['subscriptions'] as $key => $subscription) 
	{
		if( $subscription['publicationId'] == $publicationId && $subscription['circProNameId'] == $circProNameId)
		{
			$subscription['stop_date'] = $stop_date;
			$subscription['restart_date'] = $restart_date;
		}
		$updatedSubscriptions [] = $subscription;
	}
	$update = $email_service->user_update_by_email($email, array( "subscriptions" => $updatedSubscriptions ) );
}

update_user_vacation_dates('araname22@gmail.com', '1000016', '1581412', '2018-04-05', '2018-04-06');

echo "<pre>";
print_r($update);		
echo "<pre>";


//--------------------------------------------------------------------------------------------

// require_once('Email_Service.php');
// $iterable = new Email_Service('8973c0961bcc48daa470281282ebc545', true, true);

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
