<?php

function vacation_request_log()
	{
		ini_set( 'display_errors', 1 );
		ini_set( 'display_startup_errors', 1 );
		error_reporting( E_ALL );
		
		$dbhost = 'localhost';
	    $dbuser = 'online_ella';
	    $dbpass = 'Hfu5py6Ku7T9UJmd';
	    $db = 'dev';
		$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );

		var_dump( $db_conn );
		var_dump( mysql_select_db( $db ) );

		$sql = "INSERT INTO `tbl_vacation_request_log` (num_id, num_subscriber_id, chr_email, ";  
		$sql .= "chr_first_name, chr_last_name, dte_stop_date, dte_restart_date,";
		$sql .= "dte_created, dte_updated)";
		$sql .= " VALUES (NULL, '1234567', 'earana@staradvetiser.com', 'newtest', 'arana', '2018-03-08', "; 
		$sql .= " '2018-04-13', CURRENT_TIMESTAMP, '0000-00-00 00:00:00')" ;
		
        $result = mysql_query($sql);

        echo "New Vacation request logged";

	}

	vacation_request_log();
?>