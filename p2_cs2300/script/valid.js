
/* ======================== *
 * = Validation Functions = *
 * ======================== */ 

// Check name field contains only letters and spaces
function validName(name) {
	var validNameExp = /^[A-Za-z ]+$/;
	updateFieldBorder("name-field", validNameExp.test(name));

	return validNameExp.test(name);
}

// Check image url field for valid url
function validImageURL(url) {
   var image = new Image();
   image.src = url;
   updateFieldBorder("image-url-field", image.height != 0);

   return (image.height != 0);
}

// Validate all user input fields
function validForm() {
	var name = validName(document.forms.pupForm.inputName.value); 
	var imageURL = validImageURL(document.forms.pupForm.inputImageURL.value); 

	return (name && imageURL);
}

/* ==================== *
 * = Helper Functions = *
 * ==================== */ 

// Show red border when input is invalid
function updateFieldBorder(id, valid) {
	document.getElementById(id).style.border = valid ? "solid 1px #979797" : "solid 3px red";
}