<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Search Page</title>
	</head>

	<body>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Search Functionality -->
		<?php
			if (isset($_POST['search-submit'])) {
				$search = isset($_POST['search']) ? strip_tags(strtolower($_POST['search'])) : false;
			}

		?>

		<!-- Body -->
		<h2 class='general-description'>SEARCH PHOTOS AND ALBUMS</h2>
		<h3 id='search-form-subtitle' class='general-subtitle'></h3>
		<div class='search-form-container'>
			<form class='search-form' name='searchForm' action='search.php' onsubmit='return validSearchForm();' method='POST'>
			    <input id='search-field' type='text' placeholder='SEARCH' name='search' required title='Letters, spaces, dashes, and underscores only.'><br>
			    <input type='submit' name='search' value='search'>
			</form>
		</div>
	</body>

</html>