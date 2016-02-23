<!DOCTYPE html>

<!-- Puppy Sorting -->
<?php
	(isset($_POST["sortSelect"])) ? $selected_sort = $_POST["sortSelect"] : $selected_sort = 0;

	// Get sort function name
    function getSortFunction($sort) {
    	switch($sort) {
    	case 0: $function_name = ""; break;
    	case 1: $function_name = 'sortPupsByName'; break;
    	case 2: $function_name = 'sortPupsByBreed'; break;
    	case 3: $function_name = 'sortPupsByWeight'; break;
    	case 4: $function_name = 'sortPupsByPersonality'; break;
    	default: break;
    	}

    	return $function_name;
    }

    // Sorting Functions: Compare two pup properties relative to each other

	function sortPupsByName($pup1, $pup2) {
		return ($pup1->name == $pup2->name) ? 0 : (($pup1->name < $pup2->name) ? -1 : 1);
	}

	function sortPupsByBreed($pup1, $pup2) {
		return ($pup1->breed == $pup2->breed) ? 0 : (($pup1->breed < $pup2->breed) ? -1 : 1);
	}

	function sortPupsByWeight($pup1, $pup2) {
		return ($pup1->weight == $pup2->weight) ? 0 : (($pup1->weight < $pup2->weight) ? -1 : 1);
	}

	function sortPupsByPersonality($pup1, $pup2) {
		return ($pup1->personality == $pup2->personality) ? 0 : (($pup1->personality < $pup2->personality) ? -1 : 1);
	}

	$sort_function = getSortFunction($selected_sort);

	// Default sort is by date added
	if ($sort_function != "") {
		usort($pups, $sort_function);
	}
?>

<!-- Puppy Catalog -->
<div class="catalog">
	<div class="catalog-container">
		<?php for ($i = 0; $i < count($pups); $i++) { ?>
				<div class="catalog-item">
					<img id="breed-image" src=<?php echo $pups[$i]->imageURL; ?> alt=<?php echo $pups[$i]->breed; ?>>
					<div class="inner-catalog-container">
						<div class="top-item-container">
							<div class="item-description">
								<h3 id="name"><?php echo $pups[$i]->name; ?></h3>
								<h4 id="description"><?php echo $pups[$i]->breed.' • '.$pups[$i]->weight.' lbs'; ?></h4>
							</div>
							<img id="emoji" src=<?php echo getEmoji($pups[$i]->personality); ?> alt="Emoji"> 
						</div>
						<div class="bottom-item-container">
							<h3><b>Personality: </b><?php echo $pups[$i]->personality; ?></h3>
							<h3><b>Favorite Toy: </b><?php echo $pups[$i]->favoriteToy; ?></h3>
							<h3><b>Special Talent: </b><?php echo $pups[$i]->specialTalent; ?></h3>
							<h3>Image from <a href=<?php echo $pups[$i]->imageURL; ?> target="_blank"><b>here</b></a>.</h3>
						</div>
					</div>
				</div>
		<?php } ?>
	</div>
</div>