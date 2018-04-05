<?php
	require_once("circpro.helpers.php");
	require_once("voiceport.php");
	
	ini_set( 'display_errors', 1 );
	ini_set( 'display_startup_errors', 1 );
	error_reporting( E_ALL );

	function print_pre($object) {
		?><pre><?php print_r($object); ?></pre><?php
	}
	date_default_timezone_set("Pacific/Honolulu");
	$date = date("Y-m-d");

	$r = daily_vacation_request($date);


	foreach( $r as $key => $v_request)
	{	
		print_pre($v_request);
		$circpro_vacation = vacationStatus($v_request['num_account_no']);
		print_pre($circpro_vacation);

		if($circpro_vacation['stop-date'] == $v_request['dte_stop_date'])
		{
			update_log_result($v_request['num_account_no'], "success");
		}else{
			update_log_result($v_request['num_account_no'], "boooo");
		}
	}

	function daily_vacation_request($date) 
	{
		$dbhost = 'localhost';
		$dbuser = 'online_ella';
		$dbpass = '-';
		$db = 'dev';
		$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );
		var_dump( $db_conn );
		var_dump( mysql_select_db( $db ) );

		$sql = "SELECT * FROM tbl_vacation_request_log WHERE Date(dte_created) ='$date'";
		$result = mysql_query($sql);
		$request_today = mysql_fetch_assoc($result);
		$vacation = array();

	  	while($row = mysql_fetch_assoc($result)){
		    $vacation [] = $row;
		  }
		// print_pre($vacation);
		return $vacation;   
	}

	
	function update_log_result($account_no, $status) 
	{
		$dbhost = 'localhost';
		$dbuser = 'online_ella';
		$dbpass = '-';
		$db = 'dev';
		$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );
		var_dump( $db_conn );
		var_dump( mysql_select_db( $db ) );

		$sql = "UPDATE tbl_vacation_request_log 
		SET chr_result = '$status'
		WHERE num_account_no = '$account_no'";
		$result = mysql_query($sql);
		echo "Records updated successfully!" . ($sql);

		return $result;   
	}


?>