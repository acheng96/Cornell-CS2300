<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script src = "script/valid.js"></script>
		<title>PUPPYTAG</title>
	</head>

	<body>

		<!-- Puppy Select Category Options -->
		<?php 
			$breedOptions = array('Pomeranian', 'Chow Chow', 'Poodle', 'Pomsky', 'Black Lab', 'Pug', 'Dachshund', 'Westie', 'Retriever', 'Bull Dog', 'Shiba Inu', 'Rottweiler', 'Corgi', 'Bulldog', 'Beagle<?php echo $names[$i]; ?>');
			$weightOptions = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '20+');
			$personalityOptions = array('Clumsy', 'Romantic', 'Playful', 'Lazy', 'Curious', 'Adventurous', 'Timid', 'Mixed');
			$breedImages = array('pomeranian.png', 'chow-chow.png', 'teacup-poodle.png', 'pomsky.png', 'black-lab.png', 'pug.png', 'dachshund.png', 'westie.png', 'golden-retriever.png', 'bull-dog.png', 'shiba-inu.png', 'rottweiler.png', 'corgi.png', 'english-bull-dog.png', 'beagle.png');
		?>

		<!-- PHP Functions -->
		<?php
			$addIsActive = true;

			// Set add or search to active
			function getClass($page) {
				if ($addIsActive && ($page == 'add')) {
					$addIsActive = !$addIsActive;
					return 'inactive';
				} else {
					$addIsActive = !$addIsActive;
					return 'active';
				}
			}

			// Get emoji image corresponding to personality and return image location
			function getEmoji($personality) {
				$personalityOptions = array('Clumsy', 'Romantic', 'Playful', 'Lazy', 'Curious', 'Adventurous', 'Timid', 'Mixed');
				$emojis = array('clumsy.png', 'romantic.png', 'playful.png', 'lazy.png', 'curious.png', 'adventurous.png', 'timid.png', 'mixed.png');

				for ($i = 0; $i < count($personalityOptions); $i++) {
					if ($personalityOptions[$i] == $personality) {
						return ("assets/".$emojis[$i]);
					}
				}
			}

			// Get breed image corresponding to personality and return image location
			function getBreedImage($breed) {
				$breedOptions = array('Pomeranian', 'Chow Chow', 'Poodle', 'Pomsky', 'Black Lab', 'Pug', 'Dachshund', 'Westie', 'Retriever', 'Bull Dog', 'Shiba Inu', 'Rottweiler', 'Corgi', 'Bulldog', 'Beagle');
				$breedImages = array('pomeranian.png', 'chow-chow.png', 'teacup-poodle.png', 'pomsky.png', 'black-lab.png', 'pug.png', 'dachshund.png', 'westie.png', 'golden-retriever.png', 'bull-dog.png', 'shiba-inu.png', 'rottweiler.png', 'corgi.png', 'english-bull-dog.png', 'beagle.png');

				for ($i = 0; $i < count($breedOptions); $i++) {
					if ($breedOptions[$i] == $breed) {
						return ($breedImages[$i]);
					}
				}
			}
		?>

		<!-- Read puppies info from data file -->
		<?php
			$names = array();
			$breeds = array();
			$weights = array();
			$personalities = array();
			$favoriteToys = array();
			$specialTalents = array();
			$imageURLs = array();

			if (file_exists('files/data.txt')) {
				$dataFile = fopen('files/data.txt', 'r');
				$pupsArray = file('files/data.txt');

				foreach($pupsArray as $pup) {
					$line = str_replace('\n', '', $pup);
					$pupArray = explode( '\t', $line);
					$names[] = $pupArray[0];
					$breeds[] = $pupArray[1];
					$weights[] = $pupArray[2];
					$personalities[] = $pupArray[3];
					$favoriteToys[] = $pupArray[4];
					$specialTalents[] = $pupArray[5];
					$imageURLs[] = $pupArray[6];
				}
				
				fclose($dataFile);
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
				<h2 id="add-title" class=<?php echo getClass('add'); ?>><a href="index.php"><span>ADD</span></a></h2>
				<h2 id="search-title" class=<?php echo getClass('search'); ?>><a href="index.php"><span>SEARCH</span></a></h2>
			</div>

			<!-- Add and Search Form -->
			<form class="form" name="pupForm" action="index.php" onsubmit="return validForm();" method="POST">
				<div class="form-container">
					<div id="basic-profile-form">
						<input id="name-field" type="text" placeholder="NAME" name="inputName" required title="Letters and spaces only."><br>
						<input id="image-url-field" type="text" placeholder="IMAGE URL" name="inputImageURL" required title="We want to see your pup too!"><br>
					</div>

					<div id="select-options">
						<select id="breed-select" name="breedSelect" required title="Your pup needs an identity!">
							<option 'selected' value>BREED</option>
							<?php for ($i = 0; $i < count($breedOptions); $i++) { ?>
								<option value=<?php echo "{$i}" ?>><?php echo $breedOptions[$i] ?></option>
							<?php } ?>
						</select>
						<select id="weight-select" name="weightSelect" required title="Don't tell me your pup weighs nothing!">
							<option 'selected' value>WEIGHT</option>
							<?php for ($i = 0; $i < count($weightOptions); $i++) { ?>
								<option value=<?php echo "{$i}" ?>><?php echo $weightOptions[$i] ?></option>
							<?php } ?>
						</select>
						<select id="personality-select" name="personalitySelect" required title="Your pup needs a personality!">
							<option 'selected' value>PERSONALITY</option>
							<?php for ($i = 0; $i < count($personalityOptions); $i++) { ?>
								<option value=<?php echo "{$i}" ?>><?php echo $personalityOptions[$i] ?></option>
							<?php } ?>
						</select>
					</div>

					<div id="specific-profile-form">
						<input id="favorite-toy-field" type="text" placeholder="FAVORITE TOY" name="favoriteToy" required title="Every pup needs a little friend!"><br>
						<input id="special-talent-field" type="text" placeholder="SPECIAL TALENT" name="specialTalent" required title="Have more confidence in your pup!"><br>
 						<input type="submit" value="Submit"> 
					</div>
				</div>
			</form>
		</div>

		<!-- Puppy Catalog -->
		<div class="catalog">
			<h3 id="catalog-title">PUPS</h3>
			<div class="catalog-container">
				<?php for ($i = 0; $i < count($pupsArray); $i++) { ?>
						<div class="catalog-item">
							<img id="breed-image" src=<?php echo "assets/" . getBreedImage($breeds[$i]); ?> alt=<?php echo $breeds[$i]; ?>> 
							<div class="inner-catalog-container">
								<div class="top-item-container">
									<div class="item-description">
										<h3 id="name"><?php echo $names[$i]; ?></h3>
										<h4 id="description"><?php echo $breeds[$i].' • '.$weights[$i].' lbs'; ?></h4>
									</div>
									<img id="emoji" src=<?php echo getEmoji($personalities[$i]); ?> alt="Emoji"> 
								</div>
								<div class="bottom-item-container">
									<h3><b>Personality: </b><?php echo $personalities[$i]; ?></h3>
									<h3><b>Favorite Toy: </b><?php echo $favoriteToys[$i]; ?></h3>
									<h3><b>Special Talent: </b><?php echo $specialTalents[$i]; ?></h3>
									<h3>Image from <a href=<?php echo $imageURLs[$i]; ?> target="_blank"><b>here</b></a>.</h3>
								</div>
							</div>
						</div>
    			<?php } ?>
			</div>
		</div>

	</body>

</html>