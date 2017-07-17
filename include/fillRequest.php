<?php
$message = ""; // initial message 

// Includs database connection
include "db_connect.php";

if( isset($_POST['id']) ){
    $id = $_POST['id'];

    $filled = $db->querySingle("SELECT filled FROM requests WHERE rowid=$id");    
    $filled = 1 - $filled;
    
    $statement = $db->prepare('UPDATE requests SET filled=:filled WHERE rowid=:id;');
    $statement->bindValue(':id', $id, SQLITE3_INTEGER);
    $statement->bindValue(':filled', $filled, SQLITE3_INTEGER);
    
    // Executes the query
    $result = $statement->execute();
    
    // Close Statement
    $statement->close();
    
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connection.php"
	if( $result ){
		$message = "Data is updated successfully.";
	}else{
		$message = "Sorry, Data is not updated.";
	}
    
    echo($message);
}
?>