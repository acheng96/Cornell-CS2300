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

		<!-- Body -->
		<h2 class="page-title">SEARCH PAGE</h2>
		<p class="page-description">This page displays a search form and allows users to search for photos whose text fields contain the user's input.</p>

		<h2 id='login-description'>LOG IN AS AN ADMIN</h2>
		<h3 id='login-form-subtitle' class='general-subtitle'></h3>
		<div class='search-form-container'>
			<form class='search-form' name='searchForm' action='search.php' onsubmit='return validSearchForm();' method='POST'>
			    <input id='username-field' type='text' placeholder='USERNAME' name='username' maxlength='50' required title='Letters, spaces, dashes, and underscores only.''><br>
			    <input id='password-credit-field' type='password' placeholder='PASSWORD' name='password' maxlength='50' required title='Letters, spaces, dashes, and underscores only.'><br>
			    <input type='submit' name='login' value='login'>
			</form>
		</div>
	</body>

</html>