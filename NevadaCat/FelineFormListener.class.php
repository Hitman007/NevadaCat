<?php

namespace NevadaCat;

class FelineFormListener{
	
	public function __construct(){
		
		//die('FelineFormListener');

		//This means that the NEWCAT flag is sent, and data is coming in, so we're going to create a new CPT.
		if(isset($_POST['new-cat-old-cat-flag'])){
			if($_POST['new-cat-old-cat-flag'] == "NEWCAT"){
				add_action('init', array($this, 'domakeFeline'));
			}
		}
		
		if (isset($_POST['save-addcat'])){
			add_action('init', array($this, 'redirectToAddCatPage'));
		}
		
		//This checks if there is data coming in the request
			if(isset($_POST['crg-hidden-post-id'])){
			add_action('init', array($this, 'doProcessOldCatData'));
		}
		
		//This checks to see if the user is viewing a FELINE CPT
		$URL = $_SERVER['REQUEST_URI'];
		if (strpos($URL, 'feline') !== false){
			add_action('the_post', array($this, 'doCatFormForCPTview'));
		}
	}
	
	public function redirectToAddCatPage(){
		$SiteURL = get_site_url();
		$URL = "$SiteURL/add-cat/";
		wp_redirect($URL);
		exit;
	}
	
	public function domakeFeline(){
		//this makes a new CPT, then processes the fields, then redirects to the actual CPT page
		
		// Sanity check. It can't be a new cat if it has a name already:
		if (!(isset($_POST['cat_name']))){ 
			$felineName = "My Cat";
		 }else{
			$felineName = $_POST['cat_name'];
		}
		$FelineCPTFactory = new FelineCPTFactory;
		$ID = $FelineCPTFactory->makeFeline($felineName);
		$ImageUploadHandler = new ImageUploadHandler($ID);
		$AddCatFormFieldProcessor = new AddCatFormFieldProcessor($ID);
		$AddCatFormFieldProcessor->doProcessFields();
		$activateModifyShoppingCartFeature = $this->activateModifyShoppingCartFeature();
		$RedirectControl = new RedirectControl($ID);

	}
	
	public function doProcessOldCatData(){
		//this CPT has already been created, so we're going to process it's fields
		$post_ID = $_POST['crg-hidden-post-id'];
		$post_ID = intval($post_ID);
		$AddCatFormFieldProcessor = new AddCatFormFieldProcessor($post_ID);
		$AddCatFormFieldProcessor->doProcessFields();
		$activateModifyShoppingCartFeature = $this->activateModifyShoppingCartFeature();
		$RedirectControl = new RedirectControl($post_ID);
	}
		
	public function doCatFormForCPTview(){
		$FelineInputCRUDForm = new FelineInputCRUDForm();
		$userID = get_current_user_id();
		$userID = intval($userID);
		$FelineInputCRUDForm->set_user_ID($userID);
		$post_ID = get_the_ID();
		$post_ID = intval($post_ID);
		$FelineInputCRUDForm->set_post_ID($post_ID);
		$FelineInputCRUDForm->calculateUserType();
		add_filter('the_content', array($FelineInputCRUDForm, 'getFormForFeline'));
	}
	
	public function activateModifyShoppingCartFeature(){
		//$ModifyWooCartFeature = new ModifyWooCartFeature;
		//$ModifyWooCartFeature->setShoppingCart();
	}
	
}
