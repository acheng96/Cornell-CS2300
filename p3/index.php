<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script type="text/javascript" src="script/modalPopup.js"></script>
		<title>Worldwide Wonders</title>
	</head>

	<body>

		<!-- Album & Photo Class -->
		<?php include("files/albumPhotoClass.php"); ?>

		<!-- Retrieve data from database -->
		<?php

			// Initialize database connection
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

			// Delete album with id when Delete Album Form submitted
			if (isset($_POST['deleteAlbum'])) {
				$deleted_album_id = $_POST['deleteAlbumIdField'];
				$deleted_album_title = $mysqli->query("SELECT Albums.album_title FROM Albums WHERE Albums.album_id = $deleted_album_id");
				$deleted_album = $mysqli->query("DELETE FROM Albums WHERE Albums.album_id = $deleted_album_id");
				$deleted_connection = $mysqli->query("DELETE FROM PhotoInAlbum WHERE PhotoInAlbum.album_id = $deleted_album_id");
			}

			// Delete photo from album when Delete Photo In Album Form submitted
			if (isset($_POST['deletePhotoInAlbum'])) {
				$deleted_photo_id = $_POST['deletePhotoIdField'];
				$deleted_photo_album_id = $_POST['deletePhotoAlbumIdField'];
				$deleted_connection = $mysqli->query("DELETE FROM PhotoInAlbum WHERE PhotoInAlbum.photo_id = $deleted_photo_id AND PhotoInAlbum.album_id = $deleted_photo_album_id");
			}

			// Delete photo from all albums when Delete All Photos Form submitted
			if (isset($_POST['deletePhotoFromAll'])) {
				$deleted_photo_id = $_POST['deletePhotoIdField'];
				$deleted_photo_name = $mysqli->query("SELECT Photos.photo_name FROM Photos WHERE Photos.photo_id = $deleted_photo_id");
				$deleted_photo = $mysqli->query("DELETE FROM Photos WHERE Photos.photo_id = $deleted_photo_id");
				$deleted_photo_in_album = $mysqli->query("DELETE FROM PhotoInAlbum WHERE PhotoInAlbum.photo_id = $deleted_photo_id");
			}

			$mysqli -> close();
		?>

		<!-- Modal Image Popup -->
		<?php include("files/modalPopup.php"); ?>

		<!-- Delete Album Popup -->
		<?php include("files/deleteAlbumPopup.php"); ?>

		<!-- Delete Album Popup -->
		<?php include("files/deletePhotoPopup.php"); ?>

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
				    <a href='index.php'><h3 class='back-button'>RETURN TO ALBUMS</h3></a>";
				} else {
					print "<h3 id='photos-title'>ALBUM #{$album_id}: {$album_title}</h3>
					<div class='edit-options-container'>
						<div class='edit-options'>
							<button class='edit-button' onclick=''><h3>Edit Album</h3></button>
							<h3 class='options-divider'>|</h3>
							<button class='edit-button' onclick='showDeleteAlbumPopup({$album_id})'><h3 id='#$album_id' data-album-title='$album_title'>Delete Album</h3></button>
						</div>
					</div>
				    <a href='index.php'><h3 class='back-button'>RETURN TO ALBUMS</h3></a>
					<div class='photos'>
						<div class='photos-container'>";
							for ($i = 0; $i < count($photos); $i++) { 
								$photoId = $photos[$i]->photoId;
								$photoName = $photos[$i]->photoName;
								$altName = str_replace(' ', '', $photoName);
								$photoCaption = $photos[$i]->photoCaption;
								$photoCredit = $photos[$i]->photoCredit;
								$photoFilePath = $photos[$i]->photoFilePath;

								if ($photoCredit == NULL) {
									$photoCredit = "#";
								} 

							print "<div class='photo-item'>
									<button class='image-button' onclick='showImagePopup({$photoId})'><img id='$photoId' class='photo-image' src='{$photoFilePath}' data-photo-id='$photoId' data-photo-name='$photoName' data-alt-name='$altName' data-photo-caption='$photoCaption' data-photo-credit='$photoCredit' data-photo-file-path='$photoFilePath' alt='{$altName}'></button>
									<div class='blocked-edit-options'>
										<button class='edit-photo-button' onclick=''><h3>Edit Photo</h3></button>
										<button class='edit-photo-button' onclick='showDeletePhotoPopup({$photoId})'><h3 id='#$photoId' data-photo-name='$photoName' data-photo-album-title='$album_id'>Delete Photo from THIS Album</h3></button>
										<button class='edit-photo-button' onclick=''><h3>Delete Photo from ALL Albums</h3></button>
									</div>
								</div>";
							}
						print "</div>
					</div>";
				}
			} elseif (isset($_POST['deleteAlbum'])) {
				print "<p class='general-description'>The album was successfully deleted!</p>
				<a href='index.php'><h3 class='back-button'>RETURN TO ALBUMS</h3></a>";
			} elseif (isset($_POST['deletePhotoInAlbum']) && isset($_POST['deletePhotoAlbumIdField'])) {
				$delete_photo_album_id = $_POST['deletePhotoAlbumIdField'];
				print "<p class='general-description'>The photo was successfully deleted from the album!</p>
				<a href='index.php?album_id={$delete_photo_album_id}'><h3 class='back-button'>RETURN TO ALBUM</h3></a>";
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