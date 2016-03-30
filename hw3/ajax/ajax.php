<?php
	//Initial Setup
	//TODO: find the adventure.sql file and load it into your database using phpMyAdmin
	//TODO: set your database connection credentials in the config.php file
	
	// TODO: Instead of zero, get the labelno that ajax.js sent and sanitize as an int
	$labelno = 0;

	// negative labelno has no meaning
	if ($labelno < 0) {
		echo 'Invalid labelno.';
		die();
	}

	// TODO: import the given adventure.sql into your database.
	//       this gives you the table called adventure

	// TODO: Include the config file here and connect to mysql
	$mysqli = new mysqli();
	
	// connection error for MYSQL
	if ($mysqli->connect_errno) {
		print($mysqli->connect_error);
		die();
	}
	

	// TODO: create and execute a sql query to select the appropriate 
	//       adventure record based on labelno
	$query = "";
	$result = "";

	if (!$result) {
		echo 'Query error';
		die();
	}
	
	$list = $result->fetch_assoc();

	header('Content-Type: application/json');
	echo json_encode(array(
		'dataindex' => $labelno,
		'storyline' => $list['story-line']
		// TODO: Select the following fields from the database that 
		//       correspond to that labelNo.
		// TODO: package the json to give to the ajax.js

	));
	
?>