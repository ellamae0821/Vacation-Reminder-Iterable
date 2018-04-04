<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once("circpro.helpers.php");
require_once("voiceport.php");

function print_pre($object) {
	?><pre><?php print_r($object); ?></pre><?php
}

$num_subscriber_id = '-';
$request_stop_date = '2018-04-04';

function getLog($num_subscriber_id, $request_stop_date) {
	$dbhost = 'localhost';
	$dbuser = 'online_ella';
	$dbpass = '-';
	$db = 'dev';
	$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );
	var_dump( $db_conn );
	var_dump( mysql_select_db( $db ) );

	$sql = "SELECT * FROM tbl_vacation_request_log WHERE
			num_name_id = '$num_subscriber_id' AND
			dte_stop_date = '$request_stop_date'";
	$query = mysql_query($sql);
	$cust_info = mysql_fetch_assoc($query);

	print_pre($cust_info);
	// return $cust_info;

	$circproNameId = $cust_info['num_name_id'];
	$circproStopDate = $cust_info['num_name_id'];
	$result = vacationStatus($circproNameId);
	print_pre($result);
	

	if($circproStopDate== $request_stop_date)
		{
			$write_result = "UPDATE tbl_vacation_request_log 
			SET chr_result = 'success'
			WHERE num_name_id = '$circproNameId'";
			$query_update = mysql_query($write_result);
			echo "Records updated successfully! - SUCCESS";
		}else{
			$write_result = "UPDATE tbl_vacation_request_log 
			SET chr_result = 'fail'
			WHERE num_name_id = '$circproNameId'";
			$query_update = mysql_query($write_result);
			echo "Records updated successfully! - FAIL";
		}	
}
getLog('-','2018-04-04');


// function crossChecker($num_subscriber_id, $request_stop_date)
// {
// 	require_once("circpro.helpers.php");
// 	require_once("voiceport.php");

// 	$log_details = getLog($num_subscriber_id, $request_stop_date);
// 	print_pre($log_details['num_name_id']);
// 	// // $get = getlog()['circproNameId'];
// 	// $circproId = $log_details['num_name_id'];
// 	$result = vacationStatus($log_details['num_name_id']);
// 	print_pre($result);

// }
// crossChecker('-','2018-04-04');

?>