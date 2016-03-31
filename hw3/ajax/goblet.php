<?php
	//The following code checks for which AJAX request was sent for Goblet-related functions.
	//You need to only complete the case switch statements for submitting a name and choosing a name.
	
	$request_type = filter_input(INPUT_POST, "requestType", FILTER_SANITIZE_STRING);
	if ( empty( $request_type ) ) {
		echo 'Missing requestType.';
		die();
	}

	require_once "../config.php";
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

	if ($mysqli->connect_errno) {
		// print('Inside errno');
		print($mysqli->connect_error);
		die();
	}
		
	switch ( $request_type ) {
		
		//The following code has been done as an example for you. This function checks the database for duplicates
		case "checkName":
			//Get the POST data - safely
			$firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
			$lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
			$school = filter_input(INPUT_POST, "school", FILTER_SANITIZE_STRING);

			// Build and execute the query
			$query = "SELECT * FROM wizards WHERE firstName='$firstName' AND lastName='$lastName' AND school='$school'";
			// $query = "SELECT * FROM wizards";
			$result = $mysqli->query($query);

			//Make sure the query worked
			if( !$result ) {
				echo 'Query error';
				die();
			}

			//Return a message indicating whether there are matching wizards
			if ( $result->num_rows == 0) {
				echo 'NoDuplicates';
			} else {
				echo 'Duplicates';
			}
			die();
			break;


		// The rest of this is pretty open-ended based on how you make your AJAX calls,
		// so just use the above as an example of how to do the rest of them.
		// This shouldn't be too different from how you normally handle
		// HTML form submissions to POST to and GET from the database, so don't fret too much!
		case "submitName":
			//TODO: Should attempt to add a new wizard to the database corresponding
			//to what the user entered in the index.php form. Return a success if it works. (DONE)

			// Get the POST data - safely
			$firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
			$lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
			$school = filter_input(INPUT_POST, "school", FILTER_SANITIZE_STRING);

			// Build and execute the query (insert new wizard into wizards table)
			$query = "INSERT INTO wizards (wID, firstName, lastName, school) VALUES (NULL, '$firstName', '$lastName', '$school')";
			$result = $mysqli->query($query);

			// Make sure the query worked
			if(!$result) {
				echo 'Failure'; // Query failed
			} else {
				echo 'Success'; // Query succeeded
			}

			die();
			break;
			
		case "chooseName":
			//TODO: Should return a wizard from the wizards table if one exists,
			//otherwise, print out an error message. (DONE)

			// Build and execute the query (select a random row from wizards table)
			$query = "SELECT * FROM wizards ORDER BY RAND() LIMIT 1";
			$result = $mysqli->query($query);

			// Make sure the query worked
			if( !$result ) {
				echo 'Query error';
				die();
			}

			// Return a message indicating whether there exists a wizard
			if ($result->num_rows != 0) { // There is at least one wizard left in the wizards table
				while ($row = $result->fetch_row()) { // Fetch wizard row (should be only 1)
					echo ($row[1] . " " . $row[2] . " has been chosen."); // Print chosen wizard

					// Delete chosen wizard from wizards table to prevent drawing that wizard again
					$deleteQuery = "DELETE FROM wizards WHERE wID=$row[0]";
					$deleteResult = $mysqli->query($deleteQuery);

					//Make sure the query worked
					if( !$deleteResult ) {
						echo 'Query error: failed to remove wizard from Goblet of Fire';
						die();
					} 
				}
			} else { // There are no wizards left in the wizards table
				echo 'There are no more wizards in the Goblet of Fire.'; // Print error message
			}

			die();
			break;
	}

?>