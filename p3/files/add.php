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

		<!-- Upload the image -->
		<?php
			print '<pre style="display:none;">' . print_r( $_FILES, true ) . '</pre>';
			if (!empty($_FILES['newphoto'])) {
				$newPhoto = $_FILES['newphoto'];
				$originalName = $newPhoto['name'];
				if ($newPhoto['error'] == 0) {
					$tempName = $newPhoto['tmp_name'];
					move_uploaded_file($tempName, "../assets/$originalName");
					$_SESSION['photos'][] = $originalName;
					print("The file $originalName was uploaded successfully.\n");
				} else {
					print("Error: The file $originalName was not uploaded.\n");
				}
			}
		?>

		<!-- Body -->
		<h2 class="add-title">ADD AN ALBUM</h2>
		<h3 id="album-form-subtitle" class="add-subtitle"></h3>

		<!-- Add Album Form Container -->
		<div class="add-form-container">
			<!-- Add Album Form -->
			<form id="upload-album-photo-form" method="post" enctype="multipart/form-data">
				<input type="file" name="newphoto">
				<input type="submit" name="Upload photo" value="Upload Photo">
			</form>
			<form class="add-form" name="addAlbumForm" action="add.php" onsubmit="return validAddAlbumForm();" method="POST">
			    <input id="album-title-field" type="text" placeholder="ALBUM TITLE" name="albumTitle" maxlength="50" required title="Letters, spaces, dashes, and underscores only."><br>
			    <input id="album-photo-credit-field" type="text" placeholder="ALBUM PHOTO CREDIT URL (Leave blank if own photo)" name="albumPhotoCredit"><br>
			    <input type="submit" name="add-album-submit" value="Add Album">
			</form>
		</div>

		<h2 class="add-title">ADD A PHOTO</h2>
		<h3 id="photo-form-subtitle" class="add-subtitle"></h3>

		<!-- Add Photo Form Container -->
		<div class="add-form-container">
			<!-- Add Album Form -->
			<form id="upload-photo-form" method="post" enctype="multipart/form-data">
				<input type="file" name="newphoto">
				<input type="submit" name="Upload photo" value="Upload Photo">
			</form>
			<form class="add-form" name="addPhotoForm" action="add.php" onsubmit="return validAddPhotoForm();" method="POST">
			    <input id="photo-name-field" type="text" placeholder="PHOTO NAME" name="photoName" maxlength="20" required title="Letters, spaces, dashes, and underscores only."><br>
			    <input id="photo-caption-field" type="text" placeholder="PHOTO LOCATION" name="photoCaption" maxlength="50" required title="Letters, spaces, dashes, and underscores only."><br>
			    <input id="photo-credit-field" type="text" placeholder="PHOTO CREDIT URL (Leave blank if own photo)" name="photoCredit"><br>
			    <input type="submit" name="add-photo-submit" value="Add Photo">
			</form>
		</div>

	</body>

</html>