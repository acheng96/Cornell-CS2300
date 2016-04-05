<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script type="text/javascript" src="../script/modalPopup.js"></script>
		<title>Gallery Page</title>
	</head>

	<body>

		<!-- Album & Photo Class -->
		<?php include("albumPhotoClass.php"); ?>

		<!-- Retrieve data from database -->
		<?php

			// Initialize database connection
			require_once 'config.php';
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
					$photos[] = new Photo($row[0], $row[1], $row[2], $row[3], $row[4]);
				}
			}

			$displayedPhoto = new Photo();
			$displayedPhotoName = "";
			$displayedPhotoAlbums = array();

			// Set photo_id and photo_name when photo clicked; check if album id is a valid number
			if (isset($_GET['photo_id']) && ctype_digit($_GET['photo_id'])) {
				$photo_id = $_GET['photo_id'];
				$photo = $mysqli->query(
					"SELECT * FROM Photos 
					 WHERE Photos.photo_id = $photo_id"
				);

				while ($row = $photo->fetch_row()) {
					$displayedPhotoName = strtoupper($row[1]);
					$displayedPhoto = new Photo($row[0], $row[1], $row[2], $row[3], $row[4]);
				}

				$photoAlbums = $mysqli->query(
					"SELECT * FROM Albums 
					INNER JOIN PhotoInAlbum 
					ON Albums.album_id = PhotoInAlbum.album_id
					INNER JOIN Photos
					ON PhotoInAlbum.photo_id = Photos.photo_id
					WHERE PhotoInAlbum.photo_id = $photo_id"
				);

				while ($row = $photoAlbums->fetch_row()) {
					$displayedPhotoAlbums[] = new Album($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
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
			if (isset($_POST['deletePhoto'])) {
				$deleted_photo_id = $_POST['deleteAllPhotoIdField'];
				$deleted_photo_album_id = $_POST['deleteAllPhotoAlbumIdField'];
				$deleted_photos = $mysqli->query("DELETE FROM Photos WHERE Photos.photo_id = $deleted_photo_id");
				$deleted_connections = $mysqli->query("DELETE FROM PhotoInAlbum WHERE PhotoInAlbum.photo_id = $deleted_photo_id");
			}

			// Edit album when Edit Album Form submitted
			if (isset($_POST['editAlbum'])) {
				$edited_album_id = $_POST['editAlbumIdField'];
				$edited_album_title = $_POST['editAlbumTitle'];
				$edited_album = $mysqli->query("UPDATE Albums SET Albums.album_title = $edited_album_title, Albums.album_date_modified = now() WHERE Albums.album_id = $edited_album_id");
			}

			// Edit photo when Edit Photo Form submitted
			if (isset($_POST['editPhoto'])) {
				$edited_photo_id = $_POST['editPhotoIdField'];
				$edited_photo_name = $_POST['editPhotoNameField'];
				$edited_photo_caption = $_POST['editPhotoCaption'];
				$edited_photo = $mysqli->query("UPDATE Photos SET Photos.photo_name = $edited_photo_name, Photos.photo_caption = edited_photo_caption WHERE Photos.photo_id = $edited_photo_id");
				// FIX: Update albums when photo in album changed
			}

			$mysqli -> close();
		?>

		<!-- Modal Image Popup -->
		<?php include("modalPopup.php"); ?>

		<!-- Delete Album Popup -->
		<?php include("deleteAlbumPopup.php"); ?>

		<!-- Delete Photo In Album Popup -->
		<?php include("deletePhotoInAlbumPopup.php"); ?>

		<!-- Delete Photo Popup -->
		<?php include("deletePhotoPopup.php"); ?>

		<!-- Edit Album Popup -->
		<?php include("editAlbumPopup.php"); ?>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Display albums or photos -->
		<?php 
			if (isset($_GET['album_id'])) {
			    # Display photos in album with album_id = $album_id
			    $album_id = $_GET['album_id'];

			    if (!ctype_digit($album_id) || $album_title == "") { // Display error message if album id is not a valid id
				    print "<h3 class='page-description'>OH NO! THIS ALBUM DOESN'T EXIST!</h3>
				    <a href='gallery.php'><h3 class='back-button'>RETURN TO GALLERY</h3></a>";
				} else {
					print "<h3 class='photos-title'>ALBUM #{$album_id}: {$album_title}</h3>
					<div class='edit-options-container'>
						<div class='edit-options'>
							<button class='edit-button' onclick=''><h3>Add Image</h3></button>
							<h3 class='options-divider'>|</h3>
							<button class='edit-button' onclick='showEditAlbumPopup({$album_id})'><h3>Edit Album</h3></button>
							<h3 class='options-divider'>|</h3>
							<button class='edit-button' onclick='showDeleteAlbumPopup({$album_id})'><h3 id='#$album_id' data-album-title='$album_title'>Delete Album</h3></button>
						</div>
					</div>
				    <a href='gallery.php'><h3 class='back-button'>RETURN TO GALLERY</h3></a>
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
									<a href='gallery.php?photo_id={$photoId}'><img id='$photoId' class='photo-image' src='{$photoFilePath}' alt='{$altName}'></a>
									<div class='blocked-edit-options'>
										<button class='delete-photo-button' onclick='showDeletePhotoInAlbumPopup({$photoId})'><h3 id='#$photoId' data-photo-name='$photoName' data-photo-album-title='$album_id'>Delete Photo from THIS Album</h3></button>
									</div>
								</div>";
							}
						print "</div>
					</div>";
				}
			} elseif (isset($_GET['photo_id'])) {
				# Display photo with photo_id = $photo_id
			    $photoId = $_GET['photo_id'];
			    $photoName = $displayedPhoto->photoName;
			    $altName = str_replace(' ', '', $photoName);
				$photoCaption = $displayedPhoto->photoCaption;
				$photoCredit = $displayedPhoto->photoCredit;
				$photoFilePath = $displayedPhoto->photoFilePath;

				if ($photoCredit == NULL) {
					$photoCredit = "#";
				} 

			    if (!ctype_digit($photoId) || $displayedPhotoName == "") { // Display error message if album id is not a valid id
				    print "<h3 class='page-description'>OH NO! THIS PHOTO DOESN'T EXIST!</h3>
				    <a href='gallery.php'><h3 class='back-button'>RETURN TO GALLERY</h3></a>";
				} else {
					print "<h3 class='photos-title'>PHOTO #{$photoId}: {$photoName}</h3>
					<div class='edit-photo-options-container'>
						<div class='edit-options'>
							<button class='edit-photo-button' onclick=''><h3>Edit Photo</h3></button>
							<h3 class='options-divider'>|</h3>
							<button class='edit-photo-button' onclick='showDeletePhotoPopup({$photoId})'><h3 id='##$photoId' data-all-photo-name='$photoName' data-all-photo-album-title='$album_id'>Delete Photo</h3></button>
						</div>
					</div>
				    <a href='gallery.php'><h3 class='back-button'>RETURN TO GALLERY</h3></a>
					<div class='photos'>
						<div class='displayed-photo-container'>
							<div class='displayed-photo-container'><img class='displayed-photo-image' src='{$photoFilePath}' alt='{$altName}'></div>
							<p class='photo-caption'>$photoCaption</p>
							<h4 class='photo-credit'>Image from <a href='$photoCredit' target='_blank'><b>here</b></a>.</h4>
							<p class='photo-albums'>IN ALBUMS:";
								for ($i = 0; $i < count($displayedPhotoAlbums); $i++) { 
									$albumId = $displayedPhotoAlbums[$i]->albumId;
									$albumTitle = $displayedPhotoAlbums[$i]->albumTitle;
									print "<a href='gallery.php?album_id=$albumId'><h2 class='displayed-album-title'>#$albumId: $albumTitle</h2></a><br>";
								}
							print "</p>
							<div class='photo-bottom-padding'></div>
						</div>
					</div>";
				}
			} elseif (isset($_POST['deleteAlbum'])) {
				print "<p class='page-description'>The album was successfully deleted!</p>
				<a href='gallery.php'><h3 class='back-button'>RETURN TO ALBUMS</h3></a>";
			} elseif (isset($_POST['deletePhotoInAlbum']) && isset($_POST['deletePhotoAlbumIdField'])) {
				$delete_photo_album_id = $_POST['deletePhotoAlbumIdField'];
				print "<p class='page-description'>The photo was successfully deleted from the album!</p>
				<a href='gallery.php?album_id={$delete_photo_album_id}'><h3 class='back-button'>RETURN TO ALBUM</h3></a>";
			} elseif (isset($_POST['deletePhoto']) && isset($_POST['deleteAllPhotoAlbumIdField'])) {
				$delete_photo_album_id = $_POST['deleteAllPhotoAlbumIdField'];
				print "<p class='page-description'>The photo was successfully deleted from all albums!</p>
				<a href='gallery.php?album_id={$delete_photo_album_id}'><h3 class='back-button'>RETURN TO ALBUM</h3></a>";
			} elseif (isset($_POST['editAlbum']) && isset($_POST['editAlbumIdField'])) {
				$edited_album_id = $_POST['editAlbumIdField'];
				print "<p class='page-description'>The album was successfully edited!</p>
				<a href='gallery.php?album_id={$edited_album_id}'><h3 class='back-button'>RETURN TO ALBUM</h3></a>";
			} else {
				# Display all albums
			    print "<h1 class='page-title'>PHOTO GALLERY</h1>";

			    print "<div class='albums'>";
					for ($i = 0; $i < count($albums); $i++) {
						$albumPhotoCredit = $albums[$i]->albumPhotoCredit;

						if ($albumPhotoCredit == NULL) {
							$albumPhotoCredit = "#";
						}

						print "<div class='album-container'>
							<h2 class='album-name'>ALBUM #{$albums[$i]->albumId}: {$albums[$i]->albumTitle}</h2>
							<h4 class='album-date-created'>DATE CREATED: {$albums[$i]->albumDateCreated}</h4>
							<h4 class='album-date-modified'>DATE MODIFIED: {$albums[$i]->albumDateModified}</h4>
							<h4 class='image-credit'>Image from <a href='{$albumPhotoCredit}' target='_blank'><b>here</b></a>.</h4>
							<a href='gallery.php?album_id={$albums[$i]->albumId}'><img class='album-image' src='{$albums[$i]->albumPhotoFilePath}'  alt='Album'></a>
							<div class='album-bottom-padding'></div>
						</div>";
					}	
				print "</div>";
			}
		?>

		<div class="bottom-padding"></div>

	</body>

</html>