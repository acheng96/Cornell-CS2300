// keep track of an ajax request as a global variable so it can be aborted if necessary
var requestNameCheck;
$(document).ready(function() {

	// As with HW1, each of these calls will only occur as a result of an event handler. 
	// Remember that an event handler can be used with any type of user interaction, from a 
	// mouse click to a button press. These have already been specified for you below and 
	// the appropriate elements have been defined in the PHP code.


	// For this first function, we'd like to check the database to see if the name and school 
	// being typed into the text inputs exist. Right now, the button to enter your name has been 
	// disabled! That's good because we don't want people submitting if they've already 
	// entered the tournament before. The button will only be enabled if all fields have text in them
	// and the ajax response indicates that the wizard hasn't already entered.

	$(document).on("keyup", ".goblet-first-name, .goblet-last-name, .goblet-school", function() {
		// Make sure the "Enter" button is disabled
		$(".goblet-submit").attr("disabled", "disabled");

		// Cancel any existing ajax requests
		if (typeof requestNameCheck !== 'undefined') {
			requestNameCheck.abort();
		}

		// Get all of the variables needed to set up your JSON data
		// We've completed one for you already for reference

		var firstName = $(".goblet-first-name").val();
		var lastName = $(".goblet-last-name").val();
		var school = $(".goblet-school").val();

		if (firstName && lastName && school) {
			
			// Remember, this is a key-value pair in the format {key1: value1, key2: value2, key3: value3}
			var wizardInfo = {requestType: 'checkName', firstName: firstName, lastName: lastName, school: school};

			// TODO: finish ajax request (DONE)

			requestNameCheck = $.ajax({
				url: 'ajax/goblet.php',
				method: 'POST',
				data: wizardInfo,
				dataType: 'text',
				error: function(error) {
					console.log(error);
				}
			});
			
			requestNameCheck.success( function(data) {
				// HINT: console.log(data);

				// Here is where we use the result from the URL page and
				// further process it or integrate it into your website.
				// Given what this function is supposed to do, this data will tell you
				// Whether the name/school combination already exists in the database
				// And if you should disable the "ENTER" button
				if (data === 'NoDuplicates')
					$(".goblet-submit").removeAttr("disabled");
					// $(".goblet-msg").text("This is a valid entry.");
				else
					$(".goblet-submit").attr("disabled", "disabled");
					// $(".goblet-msg").text("You have already entered your name into the Goblet of Fire. You have now sprouted a magnificent beard.");
					// $(".goblet-msg").text("This is invalid.");
			});

		}
		

	});


	// In this next function, we'd like to submit to the goblet of fire! This means 
	// that the person's name was not already in the Goblet... *phew*
	// Set up the AJAX call like the previous one. The goal of this function is to 
	// POST to the database the first name, last name, and school of the Wizard 
	// being added. Return a confirmation message if he or she was successfully 
	// added! Otherwise, send an error message. 

	$(document).on("click", ".goblet-submit", function() {
		// TODO: Get all of the variable needed to set up your JSON data (DONE)

		var firstName = $(".goblet-first-name").val();
		var lastName = $(".goblet-last-name").val();
		var school = $(".goblet-school").val();

		// Clear the submission form and prevent clicking "Enter" again
		$(".goblet-first-name").val("");
		$(".goblet-last-name").val("");
		$(".goblet-school").val("");

		$(".goblet-submit").attr("disabled", "disabled");

		// Prepare the JSON data including requestType for the ajax.php switch statement
		// we already know that all the fields are filled
		var wizardInfo = {requestType: 'submitName', firstName: firstName, lastName: lastName, school: school};

		// TODO: Finish the ajax call and process the results (DONE)
		requestNameCheck = $.ajax({
			url: 'ajax/goblet.php',
			method: 'POST',
			data: wizardInfo,
			dataType: 'text',
			error: function(error) {
				console.log(error);
			}
		})

		requestNameCheck.success(function(data) {
			// TODO: Finish this success function so that you change the text of the ".goblet-msg" html class. (DONE)

			if (data === 'Success') // Wizard was successfully added
				$(".goblet-msg").text("Your name has been successfully entered into the Goblet of Fire :)");
			else // Wizard failed to be added
				$(".goblet-msg").text("Your name failed to be entered into the Goblet of Fire :(");

		})

	});


	// For this one, we want to not only GET a name from the database, but also 
	// update it! What's nice is that we don't need to send over any data for this 
	// one, although we do have to do more handling on the backend. Specifically, 
	// we want to change the Wizard table so that the "hasCompeted" field is now true
	// (or in SQL speak, a "1" since booleans are handled via 0/1 binary)
	// Look into the different AJAX method types and see which one is most 
	// appropriate. As a result of the PHP, you should be sending back the name and 
	// school of the person chosen.

	$(document).on("click", ".goblet-choose", function() {
		// TODO	(DONE)
		$(".choice1").attr("disabled", "disabled"); // Disable Choice 1 Button when drawing from Goblet of Fire

		var wizardInfo = {requestType: 'chooseName', firstName: "", lastName: "", school: ""};

		// TODO: Finish the ajax call and process the results (DONE)
		requestNameCheck = $.ajax({
			url: 'ajax/goblet.php',
			method: 'POST',
			data: wizardInfo,
			dataType: 'text',
			error: function(error) {
				console.log(error);
			}
		})

		requestNameCheck.success(function(data) {
			console.log(data);
			// TODO: Finish this success function so that you change the text of the ".goblet-msg" html class. (DONE)

			$(".goblet-msg-valid").text(data); // Change Goblet Valid Message to display wizard name or error
			$(".choice1").removeAttr("disabled"); // Enable Choice 1 Button when finished drawing from Goblet of Fire
		})

	});

});





