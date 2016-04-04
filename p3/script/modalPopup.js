/* ========================= *
 * = Modal Popup Functions = *
 * ========================= */ 

// Show image popup from home page
function showPopup(photoId) {
	var photo = document.getElementById(photoId);
	document.getElementById('photo-image').src = photo.dataset.photoFilePath;
	setUpPopup(photo);
}

// Show image popup from search page
function showPopupFromSearch(photoId) {
	var photo = document.getElementById(photoId);
	document.getElementById('photo-image').src = "../" + photo.dataset.photoFilePath;
	setUpPopup(photo);
}

// Fill in popup info based on photo
function setUpPopup(photo) {
	document.getElementById('modal-popup').style.display = "block";
	document.getElementById('photo-title').innerHTML = '#' + photo.dataset.photoId + ': ' + photo.dataset.photoName;
	document.getElementById('photo-image').alt = photo.dataset.altName;
	document.getElementById('photo-caption').innerHTML = photo.dataset.photoCaption;
	document.getElementById('photo-credit').href = photo.dataset.photoCredit;

}

// Hide image popup
function closePopup() {
	document.getElementById('modal-popup').style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	var modal = document.getElementById('modal-popup');

    if (event.target == modal) {
        modal.style.display = "none";
    }
}