<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Worldwide Wonders</title>
	</head>

	<body>

		<?php
			/* =========== *
		     * = Classes = *
		     * =========== */

			class Album { 
				public $albumId;
				public $albumTitle; 
				public $albumPhotoFilePath;
				public $albumPhotoCredit;
				public $albumDateCreated;
				public $albumDateModified;

				function __construct($albumId = 0, $albumTitle = "", $albumPhotoFilePath = "", $albumPhotoCredit = "", $albumDateCreated = "", $albumDateModified = "") { 
					$this->albumId = $albumId;
					$this->albumTitle = $albumTitle;
					$this->albumPhotoFilePath = $albumPhotoFilePath; 
					$this->albumPhotoCredit = $albumPhotoCredit;
					$this->albumDateCreated = $albumDateCreated;
					$this->albumDateModified = $albumDateModified;
				}
			}

			class Photo { 
				public $photoId;
				public $photoName; 
				public $photoCaption;
				public $photoFilePath;
				public $photoCredit;
				public $albumId;

				function __construct($photoId = 0, $photoName = "", $photoCaption = "", $photoFilePath = "", $photoCredit = "", $albumId = 0) { 
					$this->photoId = $photoId;
					$this->photoName = $photoName;
					$this->photoCaption = $photoCaption; 
					$this->photoFilePath = $photoFilePath;
					$this->photoCredit = $photoCredit;
					$this->albumId = $albumId;
				}
			}

			/* ================== *
		     * = Data Retrieval = *
		     * ================== */

			require_once 'files/config.php';
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			$album_id = 0;
			$album_title = "";
			$albums = array();
			$photos = array();

			// Retrieve albums
			$albumsResult = $mysqli->query("SELECT * FROM Albums");

			while ($row = $albumsResult->fetch_row()) {
				$albums[] = new Album($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
			}

			// Set album_id and album_title when album clicked; check if album id is a valid number
			if (isset($_GET['album_id']) && ctype_digit($_GET['album_id'])) {
				$album_id = $_GET['album_id'];
				$album = $mysqli->query(
					"SELECT * FROM Albums 
					 WHERE Albums.album_id = $album_id"
				);

				$albumRow = $album->fetch_row();
				$album_title = strtoupper($albumRow[1]);

				// Retrieve photos from album with selected album_id
				$photosResult = $mysqli->query(
					"SELECT * FROM Photos 
					INNER JOIN PhotoInAlbum 
					ON Photos.photo_id = PhotoInAlbum.photo_id
					INNER JOIN Albums
					ON PhotoInAlbum.album_id = Albums.album_id
					WHERE PhotoInAlbum.album_id = $album_id"
				);

				while ($row = $photosResult->fetch_row()) {
					$photos[] = new Photo($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
				}
			}

			$mysqli -> close();
		?>

		<!-- Header -->
		<div class="header">
			<div class='header-container'>
				<ul class='header-title'>
					<li><h1>WORLDWIDE WONDERS</h1></li>
					<li><h4>Image from <a class="header-image-url" href='https://s-media-cache-ak0.pinimg.com/736x/4d/07/ff/4d07ff22aba1feaeebc817d46e6b1021.jpg' target='_blank'><b>here</b></a>.</h4></li>
				</ul>

				<!-- Navigation Bar -->
				<div class='navbar-container'>
					<ul class='navbar-items'>
						<li class="active-page"><a href='index.php'><span>HOME</span></a></li>
		  				<li><a href='files/add.php'><span>ADD</span></a></li>
		  				<li><a href='files/edit.php'><span>EDIT</span></a></li>
		  				<li><a href='files/search.php'><span>SEARCH</span></a></li>
		  				<li><a href='files/login.php'><span>LOGIN</span></a></li>
					</ul>
				</div>
			</div>
		</div>

		<!-- Home Description -->
		<div class='divider'></div>

		<!-- Display albums or photos -->
		<?php 
			if (isset($_GET['album_id'])) {
			    # Display photos in album with album_id = $album_id
			    $album_id = $_GET['album_id'];

			    if (!ctype_digit($album_id) || $album_title == "") { // Display error message if album id is not a valid id
				    print "<h3 id='album-id-error'>OH NO! THIS ALBUM DOESN'T EXIST!</h3>
				    <a href='index.php'><h3 id='back-button'>RETURN TO ALBUMS</h3></a>";
				} else {
					print "<h3 id='photos-title'>ALBUM #{$album_id}: {$album_title}</h3>
				    <a href='index.php'><h3 id='back-button'>RETURN TO ALBUMS</h3></a>
					<div class='photos'>
						<div class='photos-container'>";
							for ($i = 0; $i < count($photos); $i++) { 
								$imageName = $photos[$i]->photoName;
								$altName = str_replace(' ', '', $imageName);
								$photo = $photos[$i]->photoCredit;

								if ($photo == NULL) {
									$photo = "#";
								} 
		
							print "<div class='photo-item'>
									<img class='photo-image' src='{$photos[$i]->photoFilePath}'  alt='{$altName}'>
									<p class='photo-title'>#{$photos[$i]->photoId}: {$photos[$i]->photoName}</p>
									<p class='photo-caption'>{$photos[$i]->photoCaption}</p>
									<h4 class='photo-credit'>Image from <a href='{$photo}' target='_blank'><b>here</b></a>.</h4>
								</div>";
							}
						print "</div>
					</div>";
				}
			} else {
				# Display all albums
			    print "<p id='home-description'>Welcome to the Worldwide Wonders Photo Gallery! Here, you can find your next bucket list place to visit!</p>";

			    print "<div class='album-container'>";
					for ($i = 0; $i < count($albums); $i++) {
						$albumPhoto = $albums[$i]->albumPhotoCredit;

						if ($albumPhoto == NULL) {
							$albumPhoto = "#";
						}

						print "<h2 class='album-name'>ALBUM #{$albums[$i]->albumId}: {$albums[$i]->albumTitle}</h2>
						<h4 class='album-date-created'>DATE CREATED: {$albums[$i]->albumDateCreated}</h4>
						<h4 class='album-date-modified'>DATE MODIFIED: {$albums[$i]->albumDateModified}</h4>
						<h4 class='image-credit'>Image from <a href='{$albumPhoto}' target='_blank'><b>here</b></a>.</h4>
						<a href='index.php?album_id={$albums[$i]->albumId}'><img class='album-image' src='{$albums[$i]->albumPhotoFilePath}'  alt='Album'></a>";
					}	
				print "</div>";
			}
		?>

		<div class="bottom-padding"></div>

	</body>

</html>