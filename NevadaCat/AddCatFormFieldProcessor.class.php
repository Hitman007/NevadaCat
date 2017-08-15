<?php

namespace NevadaCat;

class AddCatFormFieldProcessor{
	
	public $postID;
	
	public function __construct($postID){
		$this->postID = $postID;
	}
	
	public function doProcessFields(){
		$postID = $this->postID;
		if (isset($_POST['gender'])){
			$gender = $_POST['gender'];
			update_post_meta($postID, 'gender', $gender);
		}
			if(isset($_POST['food_type'])){
			$food_type = $_POST['food_type'];
			update_post_meta($postID, 'food_type', $food_type);
		}
		if(isset($_POST['temporary_hold'])){
			$temporary_hold = $_POST['temporary_hold'];
			update_post_meta($postID, 'temporary_hold', 'HOLD');
		}else{update_post_meta($postID, 'temporary_hold', 'GO');}
	}
	
	public function doProcessAttachedImage(){}
	
}