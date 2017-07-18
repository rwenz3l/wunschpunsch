<?php
if ( !isset($_POST['id']) ){
	return;
} else {
	// Include Database Connection
	include "db_connect.php";

	// Get ID-Element from Request
	$id = $_POST['id'];

	// Prepare the deleting query according to rowid
	$query = "DELETE FROM requests WHERE rowid=$id";

	// Run the query to delete record
	if( $db->query($query) ){
		$message = "Record is deleted successfully.";
	}else {
		$message = "Sorry, Record is not deleted.";
	}

	echo($message);
}
?>