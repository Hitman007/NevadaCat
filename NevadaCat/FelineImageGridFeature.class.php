<?php

namespace NevadaCat;

class FelineImageGridFeature {
	
	public function returnLoggedInUserContent($user_ID){

		$args = array(
				'post_type' => 'feline',
				'author' => $user_ID
		);
		$your_cats_roll = new \WP_Query($args);
		if ($your_cats_roll->have_posts()) {
			$output = "";
			while ($your_cats_roll->have_posts()) {
				$your_cats_roll->the_post();
				$thePermalink = get_the_permalink();
				$theTitle = get_the_title();
				$theImageLink = get_the_post_thumbnail_url();
				$output = $output . $this->returnHTMLforClickableCatSquare($thePermalink, $theTitle, $theImageLink);
			}
			$output = $output . $this->returnHTMLforLoggedInUserButtons();
			
		  }else{
		  	$youHaventAddedAnyCatsYet = __( 'You haven\'t added any cats yet.', 'NevadaCatPlugin-text-domain' );
		  	$addACat = __('Add a Cat', 'NevadaCatPlugin-text-domain' );
		 	$output = 
<<<OUTPUT
$youHaventAddedAnyCatsYet<br />
<form action = "/add-cat/">
	<input type = "submit" value = "$addACat" />
</form>
OUTPUT;
		 };
		return $output;
	}
	
	public function returnHTMLforLoggedInUserButtons(){
		$addACat = __('Add a Cat', 'NevadaCatPlugin-text-domain' );
		$output = "
<div style = 'width:100%; clear:both;'></div>
<div id = 'logged-in-user-buttons'>
<form method='post' action='/add-cat/'>
    <button type='submit'>$addACat</button>
</form>
</div>";
		return $output;
	}
	
	public function returnHTMLforClickableCatSquare($thePermalink, $theTitle, $theImageLink){
		$output = <<<OUTPUT
<div class = "cat_roll_item">
	<div class = "cat_roll_title">
		<a href = "$thePermalink">$theTitle</a>
	</div>
	<div class = "cat_roll_image">
		<a href = "$thePermalink"><img src = "$theImageLink" /></a>
	</div>
</div>
OUTPUT;
		return $output;
	}
	
	public function returnNoUserLoggedInContent(){
		$youAreNotLoggedIn = __("You are not logged in. Enter your email to continue:", 'NevadaCatPlugin-text-domain' );
		$enterYourEmialToContinue = __("Enter your email to continue.", 'NevadaCatPlugin-text-domain' );
		$emailWord = __("Email", 'NevadaCatPlugin-text-domain' );
		$submitWord = __("Submit", 'NevadaCatPlugin-text-domain' );
		$output = <<<OUTPUT
<form method = "post" />
	$youAreNotLoggedIn<br />
	$enterYourEmialToContinue <input name = "CRG-fast-register-email" type = "email" placeholder = "$emailWord" /><br />
	<input type = "submit" value = "$submitWord" />
</form>
OUTPUT;
		return $output;
	}
	
	public function returnShortCode(){
		global $current_user;
		$user_ID = get_current_user_id();
		if ($user_ID == 0){
			//NO user is logged in:
			$output = $this->returnNoUserLoggedInContent();
			return $output;
			 }else{
			//A user IS logged in:
			$output = $this->returnLoggedInUserContent($user_ID );
			return $output;
		}
	}
	
}
