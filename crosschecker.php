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

function crosscheck_vacation_status($num_subscriber_id, $request_stop_date) {
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

	$num_name_log = $cust_info['num_name_id'];
	$stop_date_log = $cust_info['dte_stop_date'];
	$result = vacationStatus($num_name_log);
	print_pre($result);


	if($stop_date_log == $result['stop-date'])
		{
			$write_result = "UPDATE tbl_vacation_request_log 
			SET chr_result = 'success'
			WHERE num_name_id = '$num_name_log'";
			$query_update = mysql_query($write_result);
			echo "Records updated successfully! - SUCCESS";
		}else{
			$write_result = "UPDATE tbl_vacation_request_log 
			SET chr_result = 'fail'
			WHERE num_name_id = '$num_name_log'";
			$query_update = mysql_query($write_result);
			echo "Records updated successfully! - FAIL";
		}	
}
crosscheck_vacation_status('-','2018-04-04');



?>