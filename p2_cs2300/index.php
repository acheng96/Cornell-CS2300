<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PUPPYTAG</title>
	</head>

	<body>

		<?php
			$addIsActive = true;

			// PHP Function to set active page
			function getClass($page) {
				print("Hello World");
				if ($addIsActive && ($page == 'add')) {
					echo "yes";
					$addIsActive = !$addIsActive;
					return 'inactive';
				} else {
					$addIsActive = !$addIsActive;
					return 'active';

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
				<h2 id="add-title" class=<?php echo getClass('add'); ?>><a href="index.php"><span>ADD</span></a></h2>
				<h2 id="search-title" class=<?php echo getClass('search'); ?>><a href="index.php"><span>SEARCH</span></a></h2>
			</div>

			<!-- Add and Search Form -->
			<form class="form" action="index.php" method="POST">
				<div class="form-container">
					<div id="basic-profile-form">
						<input id="name-field" type="text" placeholder="NAME" name="name"><br>
						<input id="image-url-field" type="text" placeholder="IMAGE URL (OPTIONAL)" name="image-url"><br>
					</div>

					<div id="select-options">
						<select id="breed-select" name="breed-select">
							<option 'selected' value="0">BREED</option>
						</select>
						<select id="weight-select" name="weight-select">
							<option 'selected' value="0">WEIGHT</option>
						</select>
						<select id="personality-select" name="personality-select">
							<option 'selected' value="0">PERSONALITY</option>
						</select>
					</div>

					<div id="specific-profile-form">
						<input id="favorite-toy-field" type="text" placeholder="FAVORITE TOY" name="favorite-toy"><br>
						<input id="special-talent-field" type="text" placeholder="SPECIAL TALENT" name="special-talent"><br>
						<input type="submit" name="submit" value="Submit">
					</div>
				</div>
			</form>
		</div>

		<!-- Puppy Catalog -->
		<div class="catalog">
			<h3 id="catalog-title">PUPS</h3>
			<div class="catalog-container">
				<div class="catalog-item">
					<div class="inner-catalog-container">
						<div class="top-item-container">
							<div class="item-description">
								<h3 id="name">SPLAT</h3>
								<h4 id="description">Corgi • 5 lbs</h4>
							</div>
							<img id="emoji" src="assets/curious.png" alt="Emoji">
						</div>
						<div class="bottom-item-container">
							<h3><b>Personality: </b>Curious</h3>
							<h3><b>Favorite Toy: </b>Rubber Bone</h3>
							<h3><b>Special Talent: </b>Splatting</h3>
							<h3>Image from <a href="index.php"><b>here</b></a>.</h3>
						</div>
					</div>
				</div>
				<div class="catalog-item">
					<div class="inner-catalog-container">
						<div class="top-item-container">
							<div class="item-description">
								<h3 id="name">SPLAT</h3>
								<h4 id="description">Corgi • 5 lbs</h4>
							</div>
							<img id="emoji" src="assets/curious.png" alt="Emoji">
						</div>
						<div class="bottom-item-container">
							<h3><b>Personality: </b>Curious</h3>
							<h3><b>Favorite Toy: </b>Rubber Bone</h3>
							<h3><b>Special Talent: </b>Splatting</h3>
							<h3>Image from <a href="index.php"><b>here</b></a>.</h3>
						</div>
					</div>
				</div>
				<div class="catalog-item">
					<div class="inner-catalog-container">
						<div class="top-item-container">
							<div class="item-description">
								<h3 id="name">SPLAT</h3>
								<h4 id="description">Corgi • 5 lbs</h4>
							</div>
							<img id="emoji" src="assets/curious.png" alt="Emoji">
						</div>
						<div class="bottom-item-container">
							<h3><b>Personality: </b>Curious</h3>
							<h3><b>Favorite Toy: </b>Rubber Bone</h3>
							<h3><b>Special Talent: </b>Splatting</h3>
							<h3>Image from <a href="index.php"><b>here</b></a>.</h3>
						</div>
					</div>
				</div>
				<div class="catalog-item">
					<div class="inner-catalog-container">
						<div class="top-item-container">
							<div class="item-description">
								<h3 id="name">SPLAT</h3>
								<h4 id="description">Corgi • 5 lbs</h4>
							</div>
							<img id="emoji" src="assets/curious.png" alt="Emoji">
						</div>
						<div class="bottom-item-container">
							<h3><b>Personality: </b>Adventurous</h3>
							<h3><b>Favorite Toy: </b>Rubber Bone</h3>
							<h3><b>Special Talent: </b>Splatting</h3>
							<h3>Image from <a href="index.php"><b>here</b></a>.</h3>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>

</html>