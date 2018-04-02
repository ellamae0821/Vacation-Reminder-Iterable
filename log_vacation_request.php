<?php



/*
 vacation_request_log function logs the user's vacation request activity to the tbl_vacation_request database
*/

function vacation_request_log($circProNameId,$first_name,$last_name,$email,$stop_date,
							  $restart_date, $num_subscriber_id, $num_publication_id, $chr_result
							  )
{
	$dte_created = date('Y-m-d H:i:s');

	$sql = "INSERT INTO tbl_vacation_request_log (num_name_id, chr_first_name,";
	$sql .= "chr_last_name, chr_email, dte_stop_date, dte_restart_date, dte_created, ";
	$sql .= "num_subscriber_id, num_publication_id, chr_result) ";
	$sql .= "VALUES (";
	$sql .= "'$circProNameId',";
	$sql .= "'$first_name',";
	$sql .= "'$last_name',";
	$sql .= "'$email',";
	$sql .= "'$stop_date',";
	$sql .= "'$restart_date',";
	$sql .= "'$dte_created',";
	$sql .= "'$num_subscriber_id',";
	$sql .= "'$num_publication_id',";
	$sql .= "'$chr_result')";

	
	mysql_query($sql) or die();
}

//------------------------------------------------------------ TEST ------------------------------------------------------------
$dbhost = 'localhost';
$dbuser = 'online_ella';
$dbpass = '-';
$db = 'dev';
$db_conn = mysql_connect( $dbhost, $dbuser, $dbpass );

var_dump( $db_conn );
var_dump( mysql_select_db( $db ) );

function vacation_request_log($circProNameId,$first_name,$last_name,$email,$stop_date,
							  $restart_date, $num_subscriber_id, $num_publication_id, $chr_result
							  )
{
	$dte_created = date('Y-m-d H:i:s');

	$sql = "INSERT INTO tbl_vacation_request_log (num_name_id, chr_first_name,";
	$sql .= "chr_last_name, chr_email, dte_stop_date, dte_restart_date, dte_created, ";
	$sql .= "num_subscriber_id, num_publication_id, chr_result) ";
	$sql .= "VALUES (";
	$sql .= "'$circProNameId',";
	$sql .= "'$first_name',";
	$sql .= "'$last_name',";
	$sql .= "'$email',";
	$sql .= "'$stop_date',";
	$sql .= "'$restart_date',";
	$sql .= "'$dte_created',";
	$sql .= "'$num_subscriber_id',";
	$sql .= "'$num_publication_id',";
	$sql .= "'$chr_result')";

	
	mysql_query($sql);
}
	
 vacation_request_log('1581412', 'whoami', 'arana', '-@gmail.com', '2018-04-04', '2018-04-10', 
 	'2018-05-09', '123456', '1000016', 'awesomeness!');

?>
