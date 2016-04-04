/* ========================= *
 * = Modal Popup Functions = *
 * ========================= */ 

/* ========================= *
 * = Image Popup Functions = *
 * ========================= */ 

// Show image popup from home page
function showImagePopup(photoId) {
	var photo = document.getElementById(photoId);
	document.getElementById('photo-image').src = photo.dataset.photoFilePath;
	setUpImagePopup(photo);
}

// Show image popup from search page
function showPopupFromSearch(photoId) {
	var photo = document.getElementById(photoId);
	document.getElementById('photo-image').src = "../" + photo.dataset.photoFilePath;
	setUpImagePopup(photo);
}

// Fill in popup info based on photo
function setUpImagePopup(photo) {
	document.getElementById('image-popup').style.display = "block";
	document.getElementById('photo-title').innerHTML = '#' + photo.dataset.photoId + ': ' + photo.dataset.photoName;
	document.getElementById('photo-image').alt = photo.dataset.altName;
	document.getElementById('photo-caption').innerHTML = photo.dataset.photoCaption;
	document.getElementById('photo-credit').href = photo.dataset.photoCredit;
}

// Hide image popup
function closeImagePopup() {
	document.getElementById('image-popup').style.display = "none";

}

/* ================================ *
 * = Delete Album Popup Functions = *
 * ================================ */ 

// Show delete album form popup 
function showDeleteAlbumPopup(albumId) {
	document.getElementById('delete-album-popup').style.display = "block";
	var album = document.getElementById('#' + albumId);
	document.getElementById('delete-confirmation').innerHTML = "Are you sure you want to delete the entire " + album.dataset.albumTitle + " album?";
	document.getElementById('deleteAlbumIdField').value = albumId;
}

// Hide delete album form popup
function closeDeleteAlbumPopup() {
	document.getElementById('delete-album-popup').style.display = "none";
}

/* ==================== *
 * = Helper Functions = *
 * ==================== */ 

// When the user clicks anywhere outside of a modal popup, close it
window.onclick = function(event) {
	var imagePopup = document.getElementById('image-popup');
	var deleteAlbumPopup = document.getElementById('image-popup');

    if (event.target == imagePopup) {
        imagePopup.style.display = "none";
    } else if (event.target == deleteAlbumPopup) {
    	deleteAlbumPopup.style.display = "none";
    }
}










