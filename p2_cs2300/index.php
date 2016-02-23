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

		<!-- Set active form -->
		<script>
			// Set and display active form 
			function setActiveForm(active, inactive) {
			    document.getElementById(active).style.display = 'block';
			    document.getElementById(inactive).style.display = 'none';
			    document.getElementById("add-title").className = (active == "add-form") ? "active" : "inactive"
			    document.getElementById("search-title").className = (active == "search-form") ? "active" : "inactive"

			    return false;
			}

			// Check if add or search form is active
			function checkIfActive(id) {
				return (" " + element.className + " ").indexOf(" " + id + " ") > -1;
			}

		</script>

		<!-- Puppy Select Category Options -->
		<?php 
			$breedOptions = array('Pomeranian', 'Chow Chow', 'Poodle', 'Pomsky', 'Black Lab', 'Pug', 'Dachshund', 'Westie', 'Retriever', 'Bull Dog', 'Shiba Inu', 'Rottweiler', 'Corgi', 'Bulldog', 'Beagle');
			$weightOptions = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '20+');
			$personalityOptions = array(
				'Clumsy' => 'clumsy.png', 
				'Romantic' => 'romantic.png', 
				'Playful' => 'playful.png', 
				'Lazy' => 'lazy.png', 
				'Curious' => 'curious.png', 
				'Adventurous' => 'adventurous.png', 
				'Timid' => 'timid.png', 
				'Mixed' => 'mixed.png'
			);
		?>

		<!-- Pup Class -->
		<?php
			class Pup { 
				public $name;
				public $breed; 
				public $weight;
				public $personality;
				public $favoriteToy;
				public $specialTalent;
				public $imageURL;

				function __construct($name = "", $breed = "", $weight = "", $personality = "", $favoriteToy = "", $specialTalent = "", $imageURL = "") { 
					$this->name = $name;
					$this->breed = $breed;
					$this->weight = $weight; 
					$this->personality = $personality;
					$this->favoriteToy = $favoriteToy;
					$this->specialTalent = $specialTalent;
					$this->imageURL = $imageURL; 
				}
			}
		?>

		<!-- Add pup info to data.txt -->
		<?php
			$delimiter = '\t';

			if (isset($_POST['add-submit']) && !empty($_POST['inputName']) && !empty($_POST['inputImageURL']) && !empty($_POST['breedSelect']) && !empty($_POST['weightSelect']) && !empty($_POST['personalitySelect']) && !empty($_POST['favoriteToy']) && !empty($_POST['specialTalent'])) {

				$dataFile = fopen("files/data.txt", "a+"); 

				if (!$dataFile) {
				    die("There was a problem opening data.txt.");
				}

				global $weightOptions; 

				$name = $_POST['inputName'];
				$imageURL = $_POST['inputImageURL'];
				$breed = $_POST['breedSelect'];
				$weight = $weightOptions[$_POST['weightSelect']];
				$personality = $_POST['personalitySelect'];
				$favoriteToy = $_POST['favoriteToy'];
				$specialTalent = $_POST['specialTalent'];

				fputs($dataFile, "$name$delimiter$breed$delimiter$weight$delimiter$personality$delimiter$favoriteToy$delimiter$specialTalent$delimiter$imageURL\n");

				fclose($dataFile);
			}
		?>

		<!-- Read puppies info from data file -->
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

			// Get emoji image corresponding to personality and return image location
			function getEmoji($personality) {
				global $personalityOptions;

				return ("assets/".$personalityOptions[$personality]);
			}
		?>

		<!-- Search Functionality -->
		<?php 
			$filteredPups = $pups;
			$searchMatchingTitle = "";

			if (isset($_POST['search-submit'])) {

				// Open data.txt
				$dataFile = fopen("files/data.txt", "r"); 
				$pupsArray = file('files/data.txt');
				$filteredPups = array();

				// Check if at least one of the categories are matched
				if (empty($_POST['searchAll']) && empty($_POST['searchName']) && empty($_POST['searchBreedSelect']) && empty($_POST['searchWeightSelect']) && empty($_POST['searchPersonalitySelect']) && empty($_POST['searchFavoriteToy']) && empty($_POST["searchSpecialTalent"])) {

                	// No field has been filled: show error message
                	echo "No field has been filled.";

        		} else {
        			// Get user input if available 
        			$searchAll = isset($_POST['searchAll']) ? strtolower($_POST['searchAll']) : false;
					$searchName = isset($_POST['searchName']) ? strtolower($_POST['searchName']) : false;
					$searchBreed = isset($_POST['searchBreedSelect']) ? strtolower($_POST['searchBreedSelect']) : false;
					$searchWeight = isset($_POST['searchWeightSelect']) ? strtolower($_POST['searchWeightSelect']) : false;
					$searchPersonality = isset($_POST['searchPersonalitySelect']) ? strtolower($_POST['searchPersonalitySelect']) : false;
					$searchFavoriteToy = isset($_POST['searchFavoriteToy']) ? strtolower($_POST['searchFavoriteToy']) : false;
					$searchSpecialTalent = isset($_POST['searchSpecialTalent']) ? strtolower($_POST['searchSpecialTalent']) : false;

					// Find matching in data.txt using search terms
					foreach ($pupsArray as $pup) {
						$searchEntry = strtolower($pup); 
						$line = str_replace('\n', '', $searchEntry);
						$lowercasePupArray = explode('\t', $line);

						$searchAllMatching = (empty($searchAll) || preg_match("/$searchAll/", $searchEntry));
						$nameMatching = (empty($searchName) || preg_match("/$searchName/", $lowercasePupArray[0]));
						$breedMatching = (empty($searchBreed) || preg_match("/$searchBreed/", $lowercasePupArray[1]));
						$weightMatching = (empty($searchWeight) || preg_match("/$searchWeight/", $lowercasePupArray[2]));
						$personalityMatching = (empty($searchPersonality) || preg_match("/$searchPersonality/", $lowercasePupArray[3]));
						$favoriteToyMatching = (empty($searchFavoriteToy) || preg_match("/$searchFavoriteToy/", $lowercasePupArray[4]));
						$specialTalentMatching = (empty($searchSpecialTalent) || preg_match("/$searchSpecialTalent/", $lowercasePupArray[5]));

						if ($searchAllMatching && $nameMatching && $breedMatching && $weightMatching && $personalityMatching && $favoriteToyMatching && $specialTalentMatching) {
							$originalLine = str_replace('\n', '', $pup);
							$pupArray = explode('\t', $originalLine);
							$filteredPups[] = new Pup($pupArray[0], $pupArray[1], $pupArray[2], $pupArray[3], $pupArray[4], $pupArray[5], $pupArray[6]);
						}
					}

					// Display no matches message if no matches found
					$searchMatchingTitle = (count($filteredPups) == 0) ? "No matches found." : (count($filteredPups) . " matches found.");
        		}
			}
		?>

		<!-- Header -->
		<div id="header">
			<div id="header-content-container">
				<ul id="header-title">
					<li class="title-tags">&lt;</li>
					<li><h1>PUPPYTAG</h1></li>
					<li class="title-tags">&gt;</li>
				</ul>
				<h2>Find your puppy tag team!</h2>
			</div>
		</div>

		<div id="divider"></div>

		<!-- Add and Search Area -->
		<div class="add-search-form">
			<!-- Navigation Bar -->
			<div id="navbar-items">
				<h2 id="add-title" class="inactive navbar-item"><a href="index.php" onclick="return setActiveForm('add-form','search-form');"><span>ADD</span></a></h2>
				<h2 id="search-title" class="active navbar-item"><a href="index.php" onclick="return setActiveForm('search-form','add-form');"><span>SEARCH</span></a></h2>
			</div>

			<div id="form-title-items">
				<h3 id="form-title">ADD A PUP!</h3>
				<h3 id="form-subtitle"><?php echo $searchMatchingTitle; ?></h3>
			</div>

			<!-- Add Form -->
			<form id="add-form" class="form inactive-form" name="pupForm" action="index.php" onsubmit="return validForm();" method="POST">
				<div class="form-container">
					<div id="basic-profile-form">
						<input id="name-field" type="text" placeholder="NAME" name="inputName"  maxlength="30" required title="Letters, spaces, dashes, and underscores only."><br>
						<input id="image-url-field" type="text" placeholder="IMAGE URL" name="inputImageURL" required title="We want to see your pup too!"><br>
					</div>

					<div id="select-options">
						<select name="breedSelect" required title="Your pup needs an identity!">
							<option 'selected' value>BREED</option>
							<?php foreach($breedOptions as $breed) { ?>
								<option value=<?php echo "{$breed}" ?>><?php echo $breed ?></option>
							<?php } ?>	
						</select>
						<select name="weightSelect" required title="Don't tell me your pup weighs nothing!">
							<option 'selected' value>WEIGHT</option>
							<?php for ($i = 0; $i < count($weightOptions); $i++) { ?>
								<option value=<?php echo "{$i}" ?>><?php echo $weightOptions[$i] ?></option>
							<?php } ?>
						</select>
						<select name="personalitySelect" required title="Your pup needs a personality!">
							<option 'selected' value>PERSONALITY</option>
							<?php foreach($personalityOptions as $key=>$value) { ?>
								<option value=<?php echo "{$key}" ?>><?php echo $key ?></option>
							<?php } ?>	
						</select>
					</div>

					<div id="specific-profile-form">
						<input id="favorite-toy-field" type="text" placeholder="FAVORITE TOY" name="favoriteToy" maxlength="50" required title="Every pup needs a little friend!"><br>
						<input id="special-talent-field" type="text" placeholder="SPECIAL TALENT" name="specialTalent" maxlength="50" required title="Have more confidence in your pup!"><br>
						<input id="add-submit" class="form-button" type="submit" name="add-submit" value="Submit"> 
					</div>
				</div>
			</form>

			<!-- Search Form -->
			<form id="search-form" class="form active-form" name="pupForm" action="index.php" method="POST">
				<div class="form-container">
					<div id="basic-profile-form">
						<div id="search-field">
							<img id="search-icon" src="assets/search-icon.png">
							<input id="search-input-field" type="text" placeholder="SEARCH (ALL FIELDS)" name="searchAll"><br>
						</div>
						<input id="name-search-field" type="text" placeholder="NAME" name="searchName" autofocus pattern="[A-Za-z-_ ]*" title="Letters, spaces, dashes, and underscores only."><br>
					</div>

					<div id="select-options">
						<select id="breed-select" class="search-select" name="searchBreedSelect">
							<option 'selected' value>BREED</option>
							<?php foreach($breedOptions as $breed) { ?>
								<option value=<?php echo "{$breed}" ?>><?php echo $breed ?></option>
							<?php } ?>	
						</select>
						<select id="weight-select" class="search-select" name="searchWeightSelect">
							<option 'selected' value>WEIGHT</option>
							<?php for ($i = 0; $i < count($weightOptions); $i++) { ?>
								<option value=<?php echo "{$i}" ?>><?php echo $weightOptions[$i] ?></option>
							<?php } ?>
						</select>
						<select id="personality-select" class="search-select" name="searchPersonalitySelect">
							<option 'selected' value>PERSONALITY</option>
							<?php foreach($personalityOptions as $key=>$value) { ?>
								<option value=<?php echo "{$key}" ?>><?php echo $key ?></option>
							<?php } ?>	
						</select>
					</div>

					<div id="specific-profile-form">
						<input id="favorite-toy-search-field" type="text" placeholder="FAVORITE TOY" name="searchFavoriteToy"><br>
						<input id="special-talent-search-field" type="text" placeholder="SPECIAL TALENT" name="searchSpecialTalent"><br>
						<input id="search-submit" class="form-button" type="submit" name="search-submit" value="Submit"> 
						<input id="search-reset" class="form-button" type="button" name="search-reset" value="Reset"> 
					</div>
				</div>
			</form>
		</div>

		<!-- Puppy Catalog -->
		<div class="catalog">
			<div id="catalog-header">
				<h3 id="catalog-title">PUPS</h3>
				<div id="catalog-right-side">
					<h4 id="sort-title">Sort by</h2>
					<select id="sort-select" name="sortSelect">
						<option 'selected' value="NAME">NAME</option>
						<option 'selected' value="WEIGHT">WEIGHT</option>
					</select>
				</div>
			</div>

			<div class="catalog-container">
				<?php $displayedPups = $filteredPups; ?>
				<?php for ($i = 0; $i < count($displayedPups); $i++) { ?>
						<div class="catalog-item">
							<img id="breed-image" src=<?php echo $displayedPups[$i]->imageURL; ?> alt=<?php echo $displayedPups[$i]->breed; ?>>
							<div class="inner-catalog-container">
								<div class="top-item-container">
									<div class="item-description">
										<h3 id="name"><?php echo $displayedPups[$i]->name; ?></h3>
										<h4 id="description"><?php echo $displayedPups[$i]->breed.' • '.$displayedPups[$i]->weight.' lbs'; ?></h4>
									</div>
									<img id="emoji" src=<?php echo getEmoji($displayedPups[$i]->personality); ?> alt="Emoji"> 
								</div>
								<div class="bottom-item-container">
									<h3><b>Personality: </b><?php echo $displayedPups[$i]->personality; ?></h3>
									<h3><b>Favorite Toy: </b><?php echo $displayedPups[$i]->favoriteToy; ?></h3>
									<h3><b>Special Talent: </b><?php echo $displayedPups[$i]->specialTalent; ?></h3>
									<h3>Image from <a href=<?php echo $displayedPups[$i]->imageURL; ?> target="_blank"><b>here</b></a>.</h3>
								</div>
							</div>
						</div>
    			<?php } ?>
			</div>
		</div>

	</body>

</html>