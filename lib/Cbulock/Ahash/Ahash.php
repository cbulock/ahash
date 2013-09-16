<?php
	namespace Cbulock\Ahash;

	class Ahash {
		
		protected $filename;
		
		public function __construct($filename) {
			$this->filename = $filename;
		}
		
		public function compute() {
			list($width, $height) = getimagesize($this->filename);
		   
			  switch($image["type"]){
			   case "jpeg":
				  $img = imagecreatefromjpeg($this->filename);
				break;
				case "gif":
				  $img = imagecreatefromgif($this->filename);
				break;
				case "png":
				  $img = imagecreatefrompng($this->filename);
				break;
			  }
		  
			$new_img = imagecreatetruecolor(8, 8);
		   
			imagecopyresampled($new_img, $img, 0, 0, 0, 0, 8, 8, $width, $height);
			imagefilter($new_img, IMG_FILTER_GRAYSCALE);
		   
			$colors = array();
			$sum = 0;
			  
			for ($i = 0; $i < 8; $i++) {
			 for ($j = 0; $j < 8; $j++) {
			  $color = imagecolorat($new_img, $i, $j) & 0xff;
			  $sum += $color;
			  $colors[] = $color;
			 }
			}
		   
			$avg = $sum / 64;
		   
			$hash = '';
			$curr = '';
			$count = 0;
			foreach ($colors as $color) {
			 if ($color > $avg) {
			  $curr .= '1';
			 } else {
			  $curr .= '0';
			 }
			 $count++;
		   
			 if (!($count % 4)) {
			  $hash .= dechex(bindec($curr));
			  $curr = '';
			 }
			}
		   
			return $hash;
		}
	}