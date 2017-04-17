<?php

namespace NevadaCat;

class RedirectControl{
	
	public $postID;
	
	public function __construct($postID){
		$this->postID = $postID;
		add_action('template_redirect', array($this, 'doRedirect'));
	}
	
	public function doRedirect(){

		$ID = $this->postID;
		$URL = get_permalink($ID);
		$SiteURL = get_site_url();
		if (isset($_POST['save-addcat'])){
			$URL = "$SiteURL/add-cat/";
		}
		if (isset($_POST['save-proceeed'])){
			$URL = "$SiteURL/cart/";
			$ModifyWooCartFeature = new ModifyWooCartFeature;
			$ModifyWooCartFeature->doAddToCart();
		}
		wp_redirect($URL);
		exit;
	
	}
	
}
