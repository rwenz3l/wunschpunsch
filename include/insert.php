<?php
$message = ""; // initial message
echo($_POST['request_data']);
if( isset($_POST['request_data']) ){
	
	// Includes database connection
	include "db_connect.php";

	// Gets the data from post
	$name = $_POST['request_data'];

	// Makes query with post data
	$query = "INSERT INTO requests (name) VALUES ('$name')";
	
	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connection.php"
	if( $db->exec($query) ){
		$message = "Data is inserted successfully.";
	}else{
		$message = "Sorry, Data is not inserted.";
	}
}
?>