<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script src="jquery-1.12.0.min.js"></script>
    	<script src = "script/valid.js"></script>
		<title>PUPPYTAG</title>
	</head>

	<body>

		<!-- Pup info -->
		<?php include("files/pupInfo.php"); ?>

		<!-- Read pup info from data.txt -->
		<?php

			$pups = array();

			// Add pup info from data.txt to pups array
			if (file_exists('files/data.txt')) {
				$dataFile = fopen('files/data.txt', 'r');
				$pupsArray = file('files/data.txt');

				foreach($pupsArray as $pup) {
					$line = str_replace('\n', '', $pup);
					$pupArray = explode( '\t', $line);
					$pups[] = new Pup($pupArray[0], $pupArray[1], $pupArray[2], $pupArray[3], $pupArray[4], $pupArray[5], $pupArray[6]);
				}

				fclose($dataFile);
			}

			// Get emoji corresponding to personality
			function getEmoji($personality) {
				global $personalityOptions;

				return ("assets/".$personalityOptions[$personality]);
			}
		?>

		<!-- Add pup info to data.txt -->
		<?php
			$delimiter = '\t';

			// Check that add form has been submitted with nonempty fields
			if (isset($_POST['add-submit']) && !empty($_POST['inputName']) && !empty($_POST['inputImageURL']) && !empty($_POST['breedSelect']) && !empty($_POST['weightSelect']) && !empty($_POST['personalitySelect']) && !empty($_POST['favoriteToy']) && !empty($_POST['specialTalent'])) {

				// Open data.txt
				$dataFile = fopen("files/data.txt", "a+"); 

				// Show error message if no data file
				if (!$dataFile) {
				    die("There was a problem opening data.txt.");
				}

				global $weightOptions; 

				// Get pup info
				$name = $_POST['inputName'];
				$imageURL = $_POST['inputImageURL'];
				$breed = $_POST['breedSelect'];
				$weight = $weightOptions[$_POST['weightSelect']];
				$personality = $_POST['personalitySelect'];
				$favoriteToy = $_POST['favoriteToy'];
				$specialTalent = $_POST['specialTalent'];

				// Write to data.txt
				fputs($dataFile, "$name$delimiter$breed$delimiter$weight$delimiter$personality$delimiter$favoriteToy$delimiter$specialTalent$delimiter$imageURL\n");

				// Close data.txt
				fclose($dataFile); 
			}
		?>

		<!-- Puppy Sorting -->
		<?php
			(isset($_POST["sortSelect"])) ? $selected_sort = $_POST["sortSelect"] : $selected_sort = 0;

			// Get sort function name
		    function getSortFunction($sort) {
		    	switch($sort) {
		    	case 0: $function_name = ""; break;
		    	case 1: $function_name = 'sortPupsByName'; break;
		    	case 2: $function_name = 'sortPupsByBreed'; break;
		    	case 3: $function_name = 'sortPupsByWeight'; break;
		    	case 4: $function_name = 'sortPupsByPersonality'; break;
		    	default: break;
		    	}

		    	return $function_name;
		    }

		    // Sorting Functions: Compare two pup properties relative to each other

			function sortPupsByName($pup1, $pup2) {
				return ($pup1->name == $pup2->name) ? 0 : (($pup1->name < $pup2->name) ? -1 : 1);
			}

			function sortPupsByBreed($pup1, $pup2) {
				return ($pup1->breed == $pup2->breed) ? 0 : (($pup1->breed < $pup2->breed) ? -1 : 1);
			}

			function sortPupsByWeight($pup1, $pup2) {
				return ($pup1->weight == $pup2->weight) ? 0 : (($pup1->weight < $pup2->weight) ? -1 : 1);
			}

			function sortPupsByPersonality($pup1, $pup2) {
				return ($pup1->personality == $pup2->personality) ? 0 : (($pup1->personality < $pup2->personality) ? -1 : 1);
			}

			$sort_function = getSortFunction($selected_sort);

			// Default sort is by date added
			if ($sort_function != "") {
				usort($pups, $sort_function);
			}
		?>

		<!-- Header -->
		<?php include("files/header.php"); ?>

		<!-- Navigation Bar -->
		<div id='navbar-items'>
			<h2 id='add-title' class=<?php echo getClass('index.php'); ?>><a href='index.php'><span>ADD</span></a></h2>
			<h2 id='search-title' class=<?php echo getClass('files/search.php'); ?>><a href='files/search.php'><span>SEARCH</span></a></h2>
		</div>

		<!-- Add and Search Area -->
		<div class="add-search-form">
			<div class="form-title-items">
				<h3 class="form-title">ADD A PUP!</h3>
				<h3 class="form-subtitle"></h3>
			</div>

			<!-- Add Form -->
			<form id="add-form" class="form" name="pupForm" action="index.php" onsubmit="return validForm();" method="POST">
				<div class="form-container">

					<!-- Name and image url fields -->
					<div class="basic-profile-form">
						<input id="name-field" type="text" placeholder="NAME" name="inputName"  maxlength="30" required title="Letters, spaces, dashes, and underscores only."><br>
						<input id="image-url-field" type="text" placeholder="IMAGE URL" name="inputImageURL" required title="We want to see your pup too!"><br>
					</div>

					<!-- Breed, weight, and personality select boxes-->
					<div class="select-options">
						<select name="breedSelect" required title="Your pup needs an identity!">
							<option selected="selected" value>BREED</option>
							<?php foreach($breedOptions as $breed) { 
								$condensedBreed = str_replace(' ', '', $breed); ?>
								<option value=<?php echo "{$condensedBreed}" ?>><?php echo $breed ?></option>
							<?php } ?>	
						</select>
						<select name="weightSelect" required title="Don't tell me your pup weighs nothing!">
							<option selected="selected" value>WEIGHT</option>
							<?php foreach($weightOptions as $weight) { ?>
								<option value=<?php echo "{$weight}" ?>><?php echo $weight ?></option>
							<?php } ?>
						</select>
						<select name="personalitySelect" required title="Your pup needs a personality!">
							<option selected="selected" value>PERSONALITY</option>
							<?php foreach($personalityOptions as $key=>$value) { ?>
								<option value=<?php echo "{$key}" ?>><?php echo $key ?></option>
							<?php } ?>	
						</select>
					</div>

					<!-- Favorite toy and special talent fields + submit button-->
					<div class="specific-profile-form">
						<input id="favorite-toy-field" type="text" placeholder="FAVORITE TOY" name="favoriteToy" maxlength="50" required title="Every pup needs a little friend!"><br>
						<input id="special-talent-field" type="text" placeholder="SPECIAL TALENT" name="specialTalent" maxlength="50" required title="Have more confidence in your pup!"><br>
						<input id="add-submit" class="form-button" type="submit" name="add-submit" value="Submit"> 
					</div>

				</div>
			</form>
		</div>

		<!-- Puppy Catalog Section -->
		<div class="catalog">

			<!-- Puppy Sorting Area -->
			<div class="catalog-header">
				<h3 class="catalog-title">PUPS</h3>
				<div class="catalog-right-side">
					<h4 class="sort-title">Sort by</h4>
					<form class="sort-select-form" action="index.php" method="POST">
						<select class="sort-select" name="sortSelect" onchange="this.form.submit();">
							<option <?php if ($selected_sort == 0) echo 'selected' ; ?> value="0">DATE</option>
							<option <?php if ($selected_sort == 1) echo 'selected' ; ?> value="1">NAME</option>
							<option <?php if ($selected_sort == 2) echo 'selected' ; ?> value="2">BREED</option>
							<option <?php if ($selected_sort == 3) echo 'selected' ; ?> value="3">WEIGHT</option>
							<option <?php if ($selected_sort == 4) echo 'selected' ; ?> value="4">PERSONALITY</option>
						</select>
					</form>
				</div>
			</div>

			<!-- Puppy Catalog -->
			<?php include("files/catalog.php"); ?>
		</div>

	</body>

</html>