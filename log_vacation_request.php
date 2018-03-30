<?php


// function for global.resources.php

/**
 * vacation_request_log function logs the user's vacation request activity to the tbl_vacation_request database
 * @param  array customer_info
 * @return obj updates the database
 */


function vacation_request_log($arr)
{

	$sql = "INSERT INTO tbl_vacation_request_log ";
	$sql .= "(chr_email, chr_first_name, chr_last_name, dte_stop_date,";  
	$sql .= " dte_restart_date, dte_created, dte_updated)";
	$sql .= " VALUES ('";
	$sql .= str_replace("'","\'",$arr["circProNameId"]) . "','";
	$sql .= str_replace("'","\'",$arr["email"]) . "','";
	$sql .= str_replace("'","\'",$arr["fname"]) . "','";
	$sql .= str_replace("'","\'",$arr["lname"]) . "','";
	$sql .= $arr["stop_date"] . "','";
	$sql .= $arr["restart_date"] . "','";
	$sql .= date("Y-m-d H:i:s"). "','";
	$sql .= date("Y-m-d H:i:s") . "')'";
	
	mysql_query($sql) or die();

}




// $customer_info = array();
// $customer_info['circProNameId'] = '123456';
// $customer_info['email'] = 'araname22@gmail.com';
// $customer_info['fname'] = 'na';
// $customer_info['lname'] = 'ara';
// $customer_info['stop_date'] = '2018-04-02';
// $customer_info['restart_date'] = '2018-04-10';


// 	function vacation_request_log($arr)
// 	{
// 		ini_set( 'display_errors', 1 );
// 		ini_set( 'display_startup_errors', 1 );
// 		error_reporting( E_ALL );
		
// 		$dbhost = 'localhost';
// 		$dbuser = 'online_ella';
// 		$dbpass = '-';
// 		$db = 'dev';
// 		$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );
	

// 		var_dump( $db_conn );
// 		var_dump( mysql_select_db( $db ) );

// 		// $sql = "INSERT INTO tbl_vacation_request_log ";
// 		// $sql .= "(chr_email, ";  
// 		// $sql .= "chr_first_name, chr_last_name, dte_stop_date, dte_restart_date,";
// 		// $sql .= "dte_created, dte_updated)";
// 		// $sql .= " VALUES ('";
// 		// $sql .= str_replace("'","\'",$customer_info["circProNameId"]) . "','";
// 		// $sql .= $customer_info["email"] . "','";
// 		// $sql .= $customer_info["fname"] . "','";
// 		// $sql .= $customer_info["lname"] . "','";
// 		// $sql .= $customer_info["stop_date"] . "','";
// 		// $sql .= $customer_info["restart_date"] . "','";
// 		// $sql .= $customer_info["restart_date"] . "','";// for now, while working on how to insert current timestamp
// 		// $sql .= $customer_info["restart_date"] . "')'";// for now, while working on how to insert current timestamp
		
// 		$result = mysql_query($sql);

//         // Closing connection
// 		mysql_close($db_conn);

// 	}


?>
