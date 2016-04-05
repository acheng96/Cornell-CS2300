<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script type="text/javascript" src="../script/modalPopup.js"></script>
		<title>Search Page</title>
	</head>

	<body>

		<!-- Album & Photo Class -->
		<?php include("albumPhotoClass.php"); ?>

		<!-- Search Functionality -->
		<?php
			$filteredPhotos = array();
			$searchMatchingTitle = "";

			if (isset($_POST['search'])) {
				if (empty($_POST['searchAlbumName']) && empty($_POST['searchPhotoName']) && empty($_POST['searchPhotoCaption'])) {
                	$searchMatchingTitle = "Please fill in at least one field.";
        		} else {
        			// Get user input if available (Strip tags to prevent HTML injection & turn everything to lowercase so search is case insensitive)
        			$searchAlbumName = isset($_POST['searchAlbumName']) ? strip_tags(strtolower($_POST['searchAlbumName'])) : false;
					$searchPhotoName = isset($_POST['searchPhotoName']) ? strip_tags(strtolower($_POST['searchPhotoName'])) : false;
					$searchPhotoCaption = isset($_POST['searchPhotoCaption']) ? strip_tags(strtolower($_POST['searchPhotoCaption'])) : false;

					// Initialize database connection
					require_once 'config.php';
					$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

					// Check database connection
					if($mysqli->connect_errno) {
						die( "Couldn't connect to database");
					}

					// Find matching in database using search terms
					$query = "SELECT * FROM (SELECT * FROM Photos 
						WHERE Photos.photo_name LIKE '%$searchPhotoName%' 
						AND Photos.photo_caption LIKE '%$searchPhotoCaption%') as FilteredPhotos
						INNER JOIN PhotoInAlbum 
						ON FilteredPhotos.photo_id = PhotoInAlbum.photo_id
						INNER JOIN Albums
						ON PhotoInAlbum.album_id = Albums.album_id
						WHERE Albums.album_title LIKE '%$searchAlbumName%'";

					$result = $mysqli->query($query);

					while ($row = $result->fetch_row()) {
						$filteredPhotos[] = new Photo($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
					}

					// Display no matches message if no matches found
					if (count($filteredPhotos) == 0) {
						$searchMatchingTitle = "No matches found.";
					} elseif (count($filteredPhotos) == 1) {
						$searchMatchingTitle = "1 match found.";
					} else {
						$searchMatchingTitle = (count($filteredPhotos) . " matches found.");
					}
        		}
			}

		?>

		<!-- Modal Popup -->
		<?php include("modalPopup.php"); ?>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Body -->
		<h2 class='form-title page-description'>SEARCH PHOTOS AND ALBUMS</h2>
		<h3 id='search-form-subtitle' class='general-subtitle'><?php echo $searchMatchingTitle ?></h3>
		<div class='search-form-container'>
			<form class='search-form' name='searchForm' action='search.php' method='POST'>
			    <input id='search-album-name-field' type='text' placeholder='ALBUM NAME (DOES NOT INCLUDE ID #)' name='searchAlbumName'><br>
			    <input id='search-photo-name-field' type='text' placeholder='PHOTO NAME' name='searchPhotoName'><br>
			    <input id='search-photo-caption-field' type='text' placeholder='PHOTO CAPTION' name='searchPhotoCaption'><br>
			    <input type='submit' name='search' value='search'>
			</form>
		</div>

		<div class='padding'></div>

		<!-- Photo Catalog -->
		<div class='photos'>
			<div class='photos-container'>
				<?php for ($i = 0; $i < count($filteredPhotos); $i++) { 
					$photoId = $filteredPhotos[$i]->photoId;
					$photoName = $filteredPhotos[$i]->photoName;
					$altName = str_replace(' ', '', $photoName);
					$photoCaption = $filteredPhotos[$i]->photoCaption;
					$photoCredit = $filteredPhotos[$i]->photoCredit;
					$photoFilePath = $filteredPhotos[$i]->photoFilePath;

					if ($photoCredit == NULL) {
						$photoCredit = "#";
					} 

				print "<div class='photo-item'>
						<a href='gallery.php?photo_id={$photoId}'><img id='$photoId' class='photo-image' src='{$photoFilePath}' alt='{$altName}'></a>
						<h2 class='search-photo-name'>#{$photoId}: {$photoName}</h2>
					</div>";
				}
			print "</div>
		</div>"; ?>

		<div class="bottom-padding"></div>

	</body>

</html>