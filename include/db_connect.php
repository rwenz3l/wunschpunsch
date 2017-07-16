<?php
// Path to Database
$database_path = "../data/requests.db";

// Database Connection
$db = new SQLite3($database_path);

// Create Table "reqeusts" into Database if not exists 
$query = "CREATE TABLE IF NOT EXISTS requests (name TEXT, filled INTEGER, comments TEXT)";
$db->exec($query);

// $add_comments = "ALTER TABLE requests ADD COLUMN comments TEXT";
// $db->exec($add_comments);

?>