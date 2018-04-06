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
	print_pre($r);

	foreach( $r as $key => $v_request)
	{	
		$circpro_vacation = vacationStatus($v_request['num_account_no']);
		print_pre($circpro_vacation);
	
		if($circpro_vacation['stop-date'] == $v_request['dte_stop_date'])
		{
			update_log_result("Success", $v_request['num_id']);
		}else{
			update_log_result("Doughnut", $v_request['num_id']);//for testing purposes only. No else statement on actual function
		}
	}


 
	function daily_vacation_request($date) 
	{
		$dbhost = 'localhost';
		$dbuser = 'online_ella';
		$dbpass = '-';
		$db = '-';
		$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );
		var_dump( $db_conn );
		var_dump( mysql_select_db( $db ) );

		$sql = "SELECT * FROM tbl_vacation_request_log WHERE Date(dte_created) ='$date' AND chr_result=''";
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
		$dbhost = 'localhost';
		$dbuser = 'online_ella';
		$dbpass = '-';
		$db = 'dev';
		$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );
		var_dump( $db_conn );
		var_dump( mysql_select_db( $db ) );

		$sql = "UPDATE tbl_vacation_request_log 
		SET chr_result = '$status'
		WHERE num_id = '$num_id'";
		$result = mysql_query($sql);
		echo "Records updated successfully!" . ($sql);
		return $result;   
	}


?>