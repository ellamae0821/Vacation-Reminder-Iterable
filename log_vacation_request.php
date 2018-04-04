<?php
/*
 vacation_request_log function logs the user's vacation request activity to the tbl_vacation_request database
*/


// function vacation_request_log($first_name,$last_name,$email,$stop_date,
// 							  $restart_date, $name_id, $account_no, $publication_id
// 							  )
// {
// 	$dte_created = date('Y-m-d H:i:s');
	
// 	$sql = "INSERT INTO tbl_vacation_request_log (chr_first_name,";
// 	$sql .= "chr_last_name, chr_email, dte_stop_date, dte_restart_date, dte_created, ";
// 	$sql .= "num_name_id, num_account_no, num_publication_id) ";
// 	$sql .= "VALUES (";
// 	$sql .= "'$first_name',";
// 	$sql .= "'$last_name',";
// 	$sql .= "'$email',";
// 	$sql .= "'$stop_date',";
// 	$sql .= "'$restart_date',";
// 	$sql .= "'$dte_created',";
// 	$sql .= "'$name_id',";
// 	$sql .= "'$account_no,";
// 	$sql .= "'$publication_id')";

	
// 	mysql_query($sql);
// }



//------------------------------------------------------------ TEST ------------------------------------------------------------
$dbhost = 'localhost';
$dbuser = 'online_ella';
$dbpass = '-';
$db = 'dev';
$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );

var_dump( $db_conn );
var_dump( mysql_select_db( $db ) );

function vacation_request_log($first_name,$last_name,$email,$stop_date,
							  $restart_date, $name_id, $account_no, $publication_id
							  )
{
	$dte_created = date('Y-m-d H:i:s');

	$sql = "INSERT INTO tbl_vacation_request_log (chr_first_name,";
	$sql .= "chr_last_name, chr_email, dte_stop_date, dte_restart_date, dte_created, ";
	$sql .= "num_name_id, num_account_no, num_publication_id) ";
	$sql .= "VALUES (";
	$sql .= "'$first_name',";
	$sql .= "'$last_name',";
	$sql .= "'$email',";
	$sql .= "'$stop_date',";
	$sql .= "'$restart_date',";
	$sql .= "'$dte_created',";
	$sql .= "'$name_id',";
	$sql .= "'$account_no,";
	$sql .= "'$publication_id')";

	mysql_query($sql);
}
	
 vacation_request_log('Ella Mae', 'Arana', 'araname22@gmail.com', '2018-04-04', '2018-04-10', 
 	 '-', '-', '1000016');

?>
