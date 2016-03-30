<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script src = "../script/valid.js"></script>
		<title>Add Page</title>
	</head>

	<body>

		<!-- Header -->
		<?php include("header.php"); ?>

		<!-- Upload the photos and albums -->
		<?php
			require_once 'config.php';
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			if (isset($_POST['add'])) {
				if (!empty($_FILES['newAlbumPhoto'])) {
					$newPhoto = $_FILES['newAlbumPhoto'];
					$fileName = $newPhoto['name'];

					// Upload new photo
					if ($newPhoto['error'] == 0) {
						$tempName = $newPhoto['tmp_name'];
						move_uploaded_file($tempName, "../assets/$fileName");
						$_SESSION['photos'][] = $fileName;
						print("The file $fileName was uploaded successfully.\n");
					} else {
						print("Error: The file $fileName was not uploaded.\n");
					}

					// Get the new album information
					$album_title = htmlentities($_POST['albumTitle']);
					$album_photo_file_path = "assets/$fileName";
					$album_photo_credit = htmlentities($_POST['albumPhotoCredit']);
					
					$addAlbumQuery = "";

					// Insert the new album into Albums
					if (trim($album_photo_credit) == "") {
						$addAlbumQuery = "INSERT INTO Albums (album_id, album_title, album_photo_file_path, album_photo_credit, album_date_created, album_date_modified) VALUES (NULL, '$album_title', '$album_photo_file_path', NULL, now(), now())";
					} else {
						$addAlbumQuery = "INSERT INTO Albums (album_id, album_title, album_photo_file_path, album_photo_credit, album_date_created, album_date_modified) VALUES (NULL, '$album_title', '$album_photo_file_path', '$album_photo_credit', now(), now())";
					}
					
			        $addAlbumResult = $mysqli -> query($addAlbumQuery);
			        print("Album has been successfully added!");

			        header('Location: add.php');
				} else {
					print("Error: No photo chosen.");
				}
			}

			// Add photo to an album
			if (isset($_POST['upload'])) {
				if (!empty($_FILES['newPhoto'])) {
					$newPhoto = $_FILES['newPhoto'];
					$fileName = $newPhoto['name'];

					// Upload new photo
					if ($newPhoto['error'] == 0) {
						$tempName = $newPhoto['tmp_name'];
						move_uploaded_file($tempName, "../assets/$fileName");
						$_SESSION['photos'][] = $fileName;
						print("The file $fileName was uploaded successfully.\n");
					} else {
						print("Error: The file $fileName was not uploaded.\n");
					}

					// Get the new photo information
					$photo_name = htmlentities($_POST['photoName']);
					$photo_caption = htmlentities($_POST['photoCaption']);
					$photo_file_path = "assets/$fileName";
					$photo_credit = htmlentities($_POST['photoCredit']);

					$addPhotoQuery = "";

					// Insert the new photo into Photos
					if (trim($photo_credit) == "") {
						$addPhotoQuery = "INSERT INTO Photos (photo_id, photo_name, photo_caption, photo_file_path, photo_credit) VALUES (NULL, '$photo_name', '$photo_caption', '$photo_file_path', NULL)";
					} else {
						$addPhotoQuery = "INSERT INTO Photos (photo_id, photo_name, photo_caption, photo_file_path, photo_credit) VALUES (NULL, '$photo_name', '$photo_caption', '$photo_file_path', '$photo_credit')";
					}
					
			        $addPhotoResult = $mysqli -> query($addPhotoQuery);

			        // Insert album_id and photo_id into PhotoInAlbum
			        $photoNames = $_POST['albums'];

			        foreach ($photoNames as $p) {
			        	$p1 = (int)$p;
				        $addIdQuery = "INSERT INTO PhotoInAlbum (album_id, photo_id) VALUES ($p1, LAST_INSERT_ID())";
				        $addIdResult = $mysqli -> query($addIdQuery);
			        }

			        print("Photo has been successfully added!");
			        
			        header('Location: add.php');
		    	}
			}

			// $mysqli -> close();
		?>

		<!-- Body -->
		<h2 class="add-title">ADD AN ALBUM</h2>
		<h3 id="album-form-subtitle" class="add-subtitle"></h3>

		<!-- Add Album Form Container -->
		<div class="add-form-container">
			<form class="add-form" name="addAlbumForm" action="add.php" enctype="multipart/form-data" onsubmit="return validAddAlbumForm();" method="POST">
				<input id="upload-album-photo-button" class="upload-button" type="file" name="newAlbumPhoto"><br>
			    <input id="album-title-field" type="text" placeholder="ALBUM TITLE" name="albumTitle" maxlength="50" required title="Letters, spaces, dashes, and underscores only."><br>
			    <input id="album-photo-credit-field" type="text" placeholder="ALBUM PHOTO IMAGE ADDRESS/URL (Leave blank if own photo)" name="albumPhotoCredit"><br>
			    <input type="submit" name="add" value="Add Album">
			</form>
		</div>

		<h2 class="add-title">ADD A PHOTO</h2>
		<h3 id="photo-form-subtitle" class="add-subtitle"></h3>

		<!-- Add Photo Form Container -->
		<div class="add-form-container">
			<!-- Add Album Form -->
			<form class="add-form" name="addPhotoForm" action="add.php" enctype="multipart/form-data" onsubmit="return validAddPhotoForm();" method="POST">
				<input id="upload-photo-button" class="upload-button" type="file" name="newPhoto"><br>
				<?php 
					$albumQuery = "SELECT * FROM Albums";
					$albumResults = $mysqli -> query($albumQuery);	

				    echo "<label><b>Select a photo album:</b> </label>";
				    while ($row = $albumResults -> fetch_assoc()) {
				      $albumId = $row['album_id'];
				      $albumTitle = $row['album_title'];
				        echo "<input type='checkbox' name='albums[]' value='$albumId'> $albumTitle";
				    }
				?>
			    <input id="photo-name-field" type="text" placeholder="PHOTO NAME" name="photoName" maxlength="20" required title="Letters, spaces, dashes, and underscores only."><br>
			    <input id="photo-caption-field" type="text" placeholder="PHOTO LOCATION" name="photoCaption" maxlength="50" required title="Letters, spaces, dashes, and underscores only."><br>
			    <input id="photo-credit-field" type="text" placeholder="PHOTO IMAGE ADDRESS/URL (Leave blank if own photo)" name="photoCredit"><br>
			    <input type="submit" name="upload" value="Add Photo">
			</form>
		</div>

	</body>

</html>