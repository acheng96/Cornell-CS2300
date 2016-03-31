<?php
	//Initial Setup
	//TODO: find the adventure.sql file and load it into your database using phpMyAdmin (DONE)
	//TODO: set your database connection credentials in the config.php file (DONE)
	
	// TODO: Instead of zero, get the labelno that ajax.js sent and sanitize as an int (DONE)
	$labelno = filter_input(INPUT_GET, "labelno", FILTER_SANITIZE_NUMBER_INT);

	// negative labelno has no meaning
	if ($labelno < 0) {
		echo 'Invalid labelno.';
		die();
	}

	// TODO: import the given adventure.sql into your database.
	//       this gives you the table called adventure (DONE)

	// TODO: Include the config file here and connect to mysql (DONE)
	require_once '../config.php';
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	// connection error for MYSQL
	if ($mysqli->connect_errno) {
		print($mysqli->connect_error);
		die();
	}

	// TODO: create and execute a sql query to select the appropriate 
	//       adventure record based on labelno (DONE)
	$query = "SELECT * FROM adventure WHERE label='$labelno'";
	$result = $mysqli->query($query);;

	if (!$result) {
		echo 'Query error';
		die();
	}
	
	$list = $result->fetch_assoc();

	header('Content-Type: application/json');
	echo json_encode(array(
		'dataindex' => $labelno,
		'storyline' => $list['story-line'],
		// TODO: Select the following fields from the database that 
		//       correspond to that labelNo. (DONE)
		// TODO: package the json to give to the ajax.js (DONE)
		'choice1plot' => $list['choice1-plot'],
		'choice1button' => $list['choice1-button'],
		'choice2plot' => $list['choice2-plot'],
		'choice2button' => $list['choice2-button'],
		'location' => $list['location'],
		'locationlabel' => $list['location-label'],
		'choice1result' => $list['choice1-result'],
		'choice2result' => $list['choice2-result']
	));
	
?>