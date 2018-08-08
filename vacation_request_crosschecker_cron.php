<?php 
	
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	error_reporting( E_ALL );

	require_once( $_SERVER['DOCUMENT_ROOT'] . "/myaccount/resources/scripts/circpro.helpers.php" );
	require_once( $_SERVER['DOCUMENT_ROOT'] . "/myaccount/resources/scripts/voiceport.php");
	require_once( $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/php/mysql.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/myaccount/resources/scripts/Email_Service.php");

	date_default_timezone_set("Pacific/Honolulu");
	$date = date("Y-m-d");

	$r = daily_vacation_request($date);
	// print_pre($r);

	foreach( $r as $key => $v_request )

	{	
		$circpro_vacation = vacationStatus($v_request['num_account_no']);
		echo "<br/>";
		echo "Email: " . $v_request['chr_email'];
		echo "<br/>";
		echo "Account Number: " . $v_request['num_account_no'];
		echo "<br/>";
		echo "Iterable Stop Date: " . $v_request['dte_stop_date'];
		echo "<br/>";
		echo "Circpro Stop Date: " . date("Y-m-d", strtotime($circpro_vacation['stop-date']));
		echo "<br/>";
		echo "<br/>";
		echo "Iterable Start Date: " . $v_request['dte_restart_date'];
		echo "<br/>";
		echo "Circpro Start Date: " . date("Y-m-d", strtotime($circpro_vacation['start-date']));
		print_pre($circpro_vacation);

		if( date("Y-m-d", strtotime($circpro_vacation['stop-date'])) == $v_request['dte_stop_date'])
		{
			update_log_result("Success", $v_request['num_id']);
			update_iterable_user_vacation_dates($v_request['chr_email'], $v_request['num_publication_id'], $v_request['num_name_id'], $v_request['dte_stop_date'], $v_request['dte_restart_date']);
			echo "<br/> SUCCESS";
		} else{
			update_log_result("Failed", $v_request['num_id']);
			echo "<br/> FAILED ";
		}
		echo "<br/>______________________________________________________________________________________";
	}

	function daily_vacation_request($date) 
	{

		$sql = "SELECT * FROM tbl_vacation_request_log WHERE Date(dte_created) ='$date'";
		$sql_r = mysql_query($sql);
		if ($sql_r)
		{
			$vacation = array() ;

			while( $row = mysql_fetch_assoc($sql_r) )
			{
				$vacation [] = $row;
			}
			return $vacation;
		}	

	}

	function update_log_result($status, $num_id) 
	{
		$current_datetime = date( "Y-m-d H:i:s" );
		$sql = "UPDATE tbl_vacation_request_log 
		SET chr_result = '$status',
		dte_updated='$current_datetime'
		WHERE num_id=$num_id";
		$result = mysql_query($sql);
		echo "UPDATE_LOG_RESULT () - SQL :" . ($sql);
		
		return $result;   
	}

	function update_iterable_user_vacation_dates($email,$publicationId,$circProNameId,$stop_date,$restart_date )
	{	
		$email_service = new Email_Service( "-", false, true );

		$user = $email_service->user_get_by_email($email);
		$updatedSubscriptions = array();

		if( !empty($user['content'])) {
			$iterable_subscription = $user['content']['user']['dataFields']['subscriptions'] ;
			if($iterable_subscription){
				foreach ($iterable_subscription as $key => $subscription) 
				{	
					if( $subscription['publicationId'] == $publicationId && $subscription['circProNameId'] == $circProNameId)
					{
						$subscription['stop_date'] = $stop_date;
						$subscription['restart_date'] = $restart_date;
					}
					$updatedSubscriptions [] = $subscription;
					$update = $email_service->user_update_by_email($email, array( "subscriptions" => $updatedSubscriptions ) );
				}
			}
		}else{
			$subscription['circProNameId'] = $circProNameId;
			$subscription['publicationId'] = $publicationId;
			$subscription['stop_date'] = $stop_date;
			$subscription['restart_date'] = $restart_date;
			$updatedSubscriptions[] = $subscription;
			$update = $email_service->user_update_by_email($email, array( "subscriptions" => $updatedSubscriptions ) );
			print_pre($subscription);
		}
			

	}

	function print_pre($object) {
		?><pre><?php print_r($object); ?></pre><?php
	}