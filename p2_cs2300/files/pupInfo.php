<?php 

	/* ================================= *
     * = Puppy Select Category Options = *
     * ================================= */ 

	$breedOptions = array('Pomeranian', 'Chow Chow', 'Poodle', 'Pomsky', 'Black Lab', 'Pug', 'Dachshund', 'Westie', 'Retriever', 'Bull Dog', 'Shiba Inu', 'Rottweiler', 'Corgi', 'Bulldog', 'Beagle');
	$weightOptions = array('2', '4', '6', '8', '10', '12', '14', '16', '18', '20', '20+');
	$personalityOptions = array(
		'Clumsy' => 'clumsy.png', 
		'Romantic' => 'romantic.png', 
		'Playful' => 'playful.png', 
		'Lazy' => 'lazy.png', 
		'Curious' => 'curious.png', 
		'Adventurous' => 'adventurous.png', 
		'Timid' => 'timid.png', 
		'Mixed' => 'mixed.png'
	);

	/* ============= *
     * = Pup Class = *
     * ============= */

	class Pup { 
		public $name;
		public $breed; 
		public $weight;
		public $personality;
		public $favoriteToy;
		public $specialTalent;
		public $imageURL;

		function __construct($name = "", $breed = "", $weight = "", $personality = "", $favoriteToy = "", $specialTalent = "", $imageURL = "") { 
			$this->name = $name;
			$this->breed = $breed;
			$this->weight = $weight; 
			$this->personality = $personality;
			$this->favoriteToy = $favoriteToy;
			$this->specialTalent = $specialTalent;
			$this->imageURL = $imageURL; 
		}
	}

?>