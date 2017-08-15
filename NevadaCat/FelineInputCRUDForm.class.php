<?php

namespace NevadaCat;

class FelineInputCRUDForm{
	
	//When viewing the Felein CRUD form, the behavior of the form is controlled by the type of user.
	//ADMIN, POST-AUTHOR, or ANONYMOUS
	
	public $userType;
	
	public $post_ID;
	
	public $user_ID;
	
	public function __construct(){
		//$this->userType = $this->calculateUserType();
	}
	
	public function set_post_ID($post_ID){
		$this->post_ID = $post_ID;
	}
	
	public function set_user_ID($user_ID){
		$this->user_ID = $user_ID;		
	}
	
	public function getFormForFeline(){
		//This function is fired when a feline CPT is viewed directly
		$ID = $this->post_ID;
		return ($this->doReturnForm($ID));
	}
		
	public function calculateUserType(){
		$userType = "ANONYMOUS";

		if(!(is_user_logged_in())){
			$userType = "ANONYMOUS";
			$this->userType = "ANONYMOUS";
		}
		
		if(is_user_logged_in()){

			$postID = $this->post_ID;
			$userID = $this->user_ID;
			$postAuthor = get_post_field('post_author', $postID);
			$postAuthor = intval($postAuthor);
			$userInfo = get_userdata($userID);
			$userRoles  = $userInfo->roles;
			if ($postAuthor == $userID){$userType = "POST-AUTHOR";}
			if (in_array('administrator', $userRoles )){
				$userType = "ADMIN";
			}
		}
		$this->userType = $userType;
	} 
	
	public function doReturnForm($ID){
		
		//New cat / old cat[already created record] flag:
		if($ID == 0){$this->userType = "NEW"; $userType = "NEW"; $newCatFlag = "<input type = 'hidden' name = 'new-cat-old-cat-flag' id = 'new-cat-old-cat-flag' value = 'NEWCAT' />";}
		if(!($ID == 0)){$userType = $this->userType; $newCatFlag = "";}

		//Load DIVs:
		$nameInputControl = $this->nameInputControl($userType);
		$genderControl = $this->genderControl($userType);
		$productControl = $this->productControl($userType);
		$buttonControl = $this->buttonControl($userType);
		$hiddenIDControl = $this->hiddenIDControl($userType);
		$uploadImageControl = $this->uploadImageControl($userType);
		$formCSS = $this->returnFormCSS($userType);
		$formJS = $this->returnFormJS($userType);
		
		//Compile form:
		$output = <<<OUTPUT
<form name = 'add-cat-form' id = 'add-cat-form' method = 'post' enctype='multipart/form-data'>
		$newCatFlag
 	<div id = 'add_cat_left_side'>
		$nameInputControl
		$genderControl
		$productControl
	</div><!-- end: #add_cat_left_side -->
		$uploadImageControl
		$buttonControl
		$hiddenIDControl
</form>
<style>
	$formCSS
</style>
<script>
	$formJS
</script>
OUTPUT;

		return $output;
	}
	
	public function nameInputControl($userType){
		$nameInputControl = "";
		if($userType == "NEW"){
			$nameInputControl = <<<nameInputControl
				<div id = 'name-input-div' class = 'control-div' >
					Cat's Name: <input type = 'input' name = 'cat_name' id = 'cat_name' onkeyup = 'clear_error_msg('cat_name','add_cat_error_msg');' placeholder = 'i.e. Sparkles or Mushy' required />
					<div class='error_msg' id='add_cat_error_msg'></div>
				</div><!--end # name-input-div-->
nameInputControl;
		}
		return $nameInputControl;
	}
		
	public function genderControl($userType){
		$postID = $this->post_ID;
		$gender = get_post_meta($postID, 'gender');
		$gender = $gender[0];
		$genderControl = "<div id = 'gender-input-div' class = 'control-div'>";
		if($userType == "ANONYMOUS"){
			$genderControl = $genderControl . "Gender: Boy<br />";
			if($gender == "girl"){
				$genderControl = $genderControl . "Gender: Girl<br />";
			}
		}
		if($gender == "boy"){$maleChecked = "CHECKED"; $femaleChecked = "";}else{$maleChecked = ""; $femaleChecked = "CHECKED";}
		if(($userType == "POST-AUTHOR") or ($userType == "ADMIN") or ($userType == "NEW")){
			$genderControl = <<<genderControl
<div id  = 'gender-input-div' class = 'control-div'>
		<br />
		<label for = 'gender'>  Gender:</label>
		<input type = 'radio' name = 'gender' id = 'gender' value = 'boy' $maleChecked /> Boy
		<input type = 'radio' name = 'gender' id = 'gender' value = 'girl' $femaleChecked /> Girl
</div><!--end # gender-input-div-->
genderControl;
		}
		return $genderControl;
	
	}
	
	public function productControl($userType){
		$userType = $this->userType;
		$postID = $this->post_ID;
		
		//l18n:
		$chickenPuddin = __("Chicken Puddin' [Adult Cat Food]");
		$chooseAProduct = __("Choose a product:");
		$kittenkaboodle = __("Kitten Kaboodle [First six months]");
		$skinnyCat = __("Skinny Cat [Weight loss food]");
		$theMountain = __("The Mountain [Mature / low energy cats]");
		
		$foodType = get_post_meta($postID, 'food_type');
		$foodType = $foodType[0];

		if($foodType == "chickenpuddin"){$chickenpuddinChecked = "CHECKED"; $anonymousText = "Subscribes to Chicken Puddin'";}else{$chickenpuddinChecked= "";}
		if($userType == "NEW"){$chickenpuddinChecked = "CHECKED";}
		if($foodType == "skinnycat"){$skinnyCatSelected = "CHECKED";$anonymousText = "Subscribes to Skinny Cat";}else{$skinnyCatSelected = "";}
		if($foodType == "kittenkaboobdle"){$kittenkaboobdleChecked = "CHECKED";$anonymousText = "Subscribes to Kitten Kabooble";}else{$kittenkaboobdleChecked = "";}
		if($foodType == "themountain"){$themountainChecked = "CHECKED"; $anonymousText = "Subscribes to the Mountain";}else{$themountainChecked = "";}
		
		$productControl = "
		<div id = 'product-input-div' class = 'control-div' >
		$chooseAProduct<br />
		<br />
		<input type='radio' name='food_type' value='chickenpuddin' id='product_radio1' $chickenpuddinChecked > $chickenPuddin<br />
		<input type='radio' name='food_type' value = 'kittenkaboobdle' id = 'product_radio2' class = 'product_radio_selection' $kittenkaboobdleChecked > $kittenkaboodle<br />
		<input type='radio' name='food_type' value = 'skinnycat' id = 'product_radio3' class = 'product_radio_selection' $skinnyCatSelected > $skinnyCat<br />
		<input type='radio' name='food_type' value = 'themountain' id = 'product_radio4' class = 'product_radio_selection' $themountainChecked > $theMountain<br />
		<br />
		
	</div><!-- end: #product-input-div -->";
		
		if($userType == "ANONYMOUS"){
			$productControl = "
				<div id = 'product-input-div'>
						$anonymousText
				</div><!-- end: #sproduct-input-div -->";
		}
		
		return $productControl;
		
	}
		
	public function newCatFlag(){
		return "<input type = 'hidden' name = 'new-cat-old-cat-flag' id = 'new-cat-old-cat-flag' value = 'NEWCAT' />";
	}
	
	public function uploadImageControl($userType){
		$upLoadCatsImage = __("Upload Your Cat's Image");
		$optionalWellPutItOnTheBox = __("(Optional. We'll put it on the box!)");
$uploadImageControl = <<<OUTPUT
<div id = 'upload-image-input-div' class = 'control-div' >
		<label for = 'cat_image' style='float:left; width:100%'>$upLoadCatsImage $optionalWellPutItOnTheBox</label>
		<!-- TODO

		<div class='default_img'><img src = 'http://localhost/wp-content/uploads/2012/12/cat_default_img.jpg' ></div>


		-->
		<input type='file' name='cat_image' id='cat_image' />
	</div><!-- end: #add_cat_image -->
OUTPUT;
		return $uploadImageControl;
	}
	
	public function buttonControl($userType){
		$userType = $this->userType;
		$postID = $this->post_ID;
		$temporary_hold = get_post_meta($postID, 'temporary_hold');
		$temporary_hold = $temporary_hold[0];
		$temporaryHoldChecked = "";
		if($temporary_hold == "HOLD"){$temporaryHoldChecked = "CHECKED";}
		$buttonControl = "
		<div id = 'button-control-div'>
			<input type = 'submit' id = 'formButton' name = 'formButton' class = 'cat_button' value = 'Save Cat' /><br />
			<input type = 'submit' id = 'save-addcat' name = 'save-addcat' class = 'cat_button' value = 'Add Another Cat' /><br />
			<input type = 'submit' id = 'save-proceeed' name = 'save-proceeed' class = 'cat_button' value = 'Proceed to Payment' /><br /><br />
		</div><!-- end: #button-control-div -->";
		
		if (($userType == "POST-AUTHOR") or ($userType == "ADMIN")){$buttonControl = $buttonControl . "
			<div id = 'button-control-div'>
				<input type = 'checkbox' name = 'temporary_hold' id = 'temporary_hold' $temporaryHoldChecked /> Temporarily Stop Subscription<br /><br />
			</div><!-- end: #button-control-div -->
		";}
	
		if ($userType == "ANONYMOUS"){
			$buttonControl = "";
		}
		if ($userType == "NEW"){
			$siteURL = site_url();
			$buttonControl = "
				<div id = 'button-control-div'>
					<input type='submit' id = 'formButton' name = 'formButton' class = 'cat_button' value = 'Save Cat' /><br /><br /><br />
					&nbsp;&nbsp;<span id = 'cancel-link' style = 'font-size:80%'><a href = '$siteURL/all-cats/'>CANCEL</a></span>
				</div><!-- end: #button-control-div -->
			";
		}
	
		return $buttonControl;
	}
	
	public function hiddenIDControl($userType){
		
		$postID = $this->post_ID;
		$output = "<input type = 'hidden' name = 'crg-hidden-post-id' id = 'crg-hidden-post-id' value = '$postID' />";
		return $output;
	}

	public function returnFormCSS($userType){
		
		if($userType == "NEW"){
			
			$formCSS =
			<<<formCSS
	.small-text{font-size: .65em;}
	.control-div{display: none;}
formCSS;
			
		}else{
			$formCSS =
			<<<formCSS
	.small-text{font-size: .65em;}
formCSS;
			}
			
			return $formCSS;
	}

	public function returnFormJS($userType){
		if($userType == "NEW"){
			$formJS=
<<<formJS
//This script disables the "Next" button until the user puts something into the Name field:
jQuery(document).ready(function(){
	jQuery('#formButton').prop('disabled',true);
	jQuery('#cat_name').keyup(function(){
        jQuery('#formButton').prop('disabled', jQuery('#cat_name').val() == "" ? true : false);     
    });
});
formJS;
		
		  }else{
			$formJS=
<<<formJS

formJS;
		}
		
		return $formJS;
	
	}
	
}
