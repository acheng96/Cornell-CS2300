// Homework 2: Javascript & jQuery //
// Please complete the following problems. Remember, you are not allowed to change the index.php file. Only this js file.

// Event listeners are pretty much what they sounds like: they listen and react to events. Sometimes called Event Handlers

// Problem 1 jQuery Event Listeners
// Add one event listener that responds to a click of any of the "Free Movie Download" buttons and pops up an alert message to users. Make up your own text for the alert message! Be creative! Surprise us!

$(".alert").click(function() {
	alert("Free movie downloaded!");
});

// Problem 2 jQuery CSS
// Even though best practices suggest that you change classes  and style the classes in a separate css file rather than change CSS directly, occasionally it is necessary to edit CSS directly using JavaScript.
// Find the "Border" button on the Control Panel on the page. Add an event handler so that when it is clicked each movie is styled to have a 3px solid yellow border.

$("#border").click(function() {
	$('.movie-poster').css('border', '3px solid yellow');
});

// Problem 3 - jQuery Toggle
// Attach an event handler / listener to the 'Toggle' button on the control panel that changes whether the descriptive text (Title, release date, running time) are visible.

$("#toggle").click(function() {
	$(".movies li").toggle();
});

// Problem 4 - Loading new text
// At the bottom of the page, you'll find a "Favorite Quotes" section. Your function should add quotes there.
// On the file system, you'll find a folder called 'partials' that contains partial html files. Use the jQuery load() function to load a random quote when the "Load Quote" button is clicked.
//Each new quote should replace the old one, not an increasingly long list of quotes.
//You'll need to figure out how to make it random
//Hint: look at Math.random and Math.floor

$("#quotes").click(function() {
	var num = Math.floor((Math.random() * 5)).toString();
	$(".quotes").load("partials/quotes_partial" + num + ".html");
});

// Problem 5a - Helper Functions
/* For this problem, you will be writing two helper functions that will help you with the next problem. 
* The first is a function to return the running time
* If you could change index.php you might naturally put the running time in a <span> of its own 
* with a class that would allow you to easily reference it. But you can't do that so you have to work harder to 
* get the running time.
* Inside #movies-container, the elements are indexed 0 - 5 with one for each of the six movies 
* Write a function that accepts the movie index (0 for episode 1, 1 for episode 2 etc)
* as a parameter and returns the running time
*/

function runningTime(i){
	var num = (i + 1).toString();
	var runningTimeString = $(".movies:nth-child(" + num + ") li:nth-child(3)").text();
	var runningTime = runningTimeString.replace(/\D/g,'');

	return parseInt(runningTime);
};

// Verify that this function works. Open your browser's console and type in the following:
	// runningTime(1);
// you should get the following result:
	// 142

//Problem 5b
//Write another function that takes a movie index and a string 
//as parameters. It should replace the line containing the movie's 
//current running time with the contents of the string.

function rewrite(i, string){
	var num = (i + 1).toString();
	$(".movies:nth-child(" + num + ") li:nth-child(3)").text(string);
};

// Verify that this function works. Type the following into your console:
//     replace(0,"Running Time: 400 minutes");
// You should see that the line: "Running Time: 133 minutes" under the first movie is replaced with "Running Time: 400 minutes"

//Problem 5c
// Test your rewrite function! Use values from the "Test Rewrite" pick list
// and text input to run your function when the user clicks the "Test" button
// If the user forgot to select a movie, give them a reminder instead of 
// running the function

$("#test_rewrite").click(function() {
	if ($("#rewrite_select").val()) {
		var selectedNum = parseInt($("#rewrite_select option:selected").val());
		var text = $("#rewrite_text").val();
		rewrite(selectedNum, text);
	} else {
		alert("Please select an option!");
	}
});

// Problem 6 - Apply Helper Functions
// Use your helper functions to convert the running time format of all the movies from minutes to ___ hours ___minutes.
// Hint: Be sure to check the running time format so your function 
// responds appropriately if the time has already been converted. 
$("#convert").on("click", function() {
	// replace below code
	// OPTIONAL BONUS CHALLENGE - add an "else" statement to the 
	// that converts from hours and mintues back to minutes
	// Note: Maximum score on the assigmnent is 100.

	for (i = 0; i < $('.movies').length; i++) {
		var num = (i + 1).toString();
		var runningTimeString = $(".movies:nth-child(" + num + ") li:nth-child(3)").text(); // Get running time string

		if (runningTimeString.indexOf("hours") < 0) { 
			// Convert from minutes to ___ hours ___minutes
			
			var totalMinutes = runningTime(i);
			var hours = Math.floor(totalMinutes / 60); 
			var minutes = totalMinutes % 60;         
			var newTimeString = "Running Time: " + hours.toString() + " hours " + minutes.toString() + " minutes";

			rewrite(i, newTimeString);
		} else { 
			// Convert from  ___ hours ___minutes to minutes
			var array = runningTimeString.split(" ");
			var hours = parseInt(array[2]);
			var minutes = parseInt(array[4]);
			var newTime = (hours * 60) + minutes;
			var newTimeString = "Running Time: " + newTime.toString() + " minutes";

			rewrite(i, newTimeString);
		}
	}
});

// Problem 7 - Adding Class
// So far we've learned we can bind events to classes and style them with CSS, but now let's do some logic with classes.
// Write a function that can add a class 'old' to the movie posters of movies released before the year 2000 and bind it to
// the addClass button.

$("#addClass").click(function() {
	for (i = 1; i <= $('.movies').length; i++) {
		var dateString = $(".movies:nth-child(" + i + ") li:nth-child(2)").text(); // Get release date string
		var year = parseInt(dateString.substr(dateString.length - 4)); // Get year as integer

		if (year < 2000) {
			$(".movies:nth-child(" + i + ") img:nth-child(1)").addClass('old'); // Add class 'old'
		}
	}
});

// Problem 8 - Implement ReplaceAll
// The search functionality is implemented already below for all of the movie details. 
$("#search").bind('keyup', function(){
	// for each of the paragraphs in main text
	$("ul").children().each(function(){
		//retrieve the current HTML
		var currentString = $(this).html();
		//Remove existing highlights
		currentString = replaceAll(currentString, '<span class="matched">',"");
		currentString = replaceAll(currentString, "</span>","");
		// add in new highlights
		currentString = replaceAll(currentString, $("#search").val(), '<span class="matched">$&</span>');
		// replace the current HTML with highlighted HTML
		$(this).html(currentString);
	});
});

/* Replaces all instances of "replace" with "with_this" in the string "txt"
using regular expressions -- SEE BELOW */
function replaceAll(txt, replace, with_this) {
	return txt.replace(new RegExp(replace, 'g'),with_this);
}

  
 // TODO: You must implement the ReplaceAll functionality. 
$("#replace").bind('click', function(){
	$("ul").children().each(function(){
		var currentString = $(this).html();
		var originalText = $("#original").val();
		var newText = $("#newtext").val();

		currentString = replaceAll(currentString, originalText, newText);

		$(this).html(currentString);
	});
});

// To recieve bonus points on this assignment, see the description of Problem 6
	//Note: Maximum points for the assignment is 100. Bonus does not make it higher.
	
// Don't forget to read the published assignment which includes uploading your file to CMS.

