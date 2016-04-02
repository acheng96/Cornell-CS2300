<?php

	/* =========== *
     * = Classes = *
     * =========== */

	class Album { 
		public $albumId;
		public $albumTitle; 
		public $albumPhotoFilePath;
		public $albumPhotoCredit;
		public $albumDateCreated;
		public $albumDateModified;

		function __construct($albumId = 0, $albumTitle = "", $albumPhotoFilePath = "", $albumPhotoCredit = "", $albumDateCreated = "", $albumDateModified = "") { 
			$this->albumId = $albumId;
			$this->albumTitle = $albumTitle;
			$this->albumPhotoFilePath = $albumPhotoFilePath; 
			$this->albumPhotoCredit = $albumPhotoCredit;
			$this->albumDateCreated = $albumDateCreated;
			$this->albumDateModified = $albumDateModified;
		}
	}

	class Photo { 
		public $photoId;
		public $photoName; 
		public $photoCaption;
		public $photoFilePath;
		public $photoCredit;
		public $albumId;

		function __construct($photoId = 0, $photoName = "", $photoCaption = "", $photoFilePath = "", $photoCredit = "", $albumId = 0) { 
			$this->photoId = $photoId;
			$this->photoName = $photoName;
			$this->photoCaption = $photoCaption; 
			$this->photoFilePath = $photoFilePath;
			$this->photoCredit = $photoCredit;
			$this->albumId = $albumId;
		}
	}

?>