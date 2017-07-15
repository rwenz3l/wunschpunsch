<?php
$message = ""; // initial message 

// Includs database connection
include "db_connect.php";

// Updating the table row with submited data according to rowid once form is submited 
if( isset($_POST['submit_data']) ){

	// Gets the data from post
	$id = $_POST['id'];
	$name = $_POST['name'];
	$filled = $_POST['filled'];

	// Makes query with post data
	$query = "UPDATE requests set name='$name', filled='$filled' WHERE rowid=$id";

	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connection.php"
	if( $db->exec($query) ){
		$message = "Data is updated successfully.";
	}else{
		$message = "Sorry, Data is not updated.";
	}
}

$id = $_GET['id']; // rowid from url
// Prepar the query to get the row data with rowid
$query = "SELECT rowid, * FROM requests WHERE rowid=$id";
$result = $db->query($query);
$data = $result->fetchArray(); // set the row in $data
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Update Data</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div style="width: 500px; margin: 20px auto;">

		<!-- showing the message here-->
		<div><?php echo $message;?></div>

		<table class="table table-hover table-condensed table-striped table-bordered">
			<form accept-charset="utf-8" action="" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<tr>
				<td>Name:</td>
				<td><input name="name" type="text" value="<?php echo $data['name'];?>" style="width:100%"></td>
			</tr>
			<tr>
				<td>Done:</td>
				<td>
					<input name="filled" type="checkbox" value=1
					checked="<?php if($data['filled'] == 1){echo checked;}?>">
				</td>
			</tr>
			<tr>
				<td>Comments:</td>
				<td>
					<textarea name="myTextBox" cols="50" rows="3"></textarea>
				</td>
			</tr>
			<tr>
				<td><a href="../index.php">Back</a></td>
				<td><input name="submit_data" type="submit" value="Update Data"></td>
			</tr>
			</form >
		</table>
	</div>
</body>
</html>