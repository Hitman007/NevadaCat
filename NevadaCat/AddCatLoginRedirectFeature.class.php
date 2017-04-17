<?php

namespace NevadaCat;

class AddCatLoginRedirectFeature{
	
	public function __construct(){
		add_action('init', array($this, 'doLoginRedirectFeature'));
	}
	
	public function doLoginRedirectFeature(){
		//die('AddCatLoginRedirectFeature::doLoginRedirectFeature');
		$URL = $_SERVER['REQUEST_URI'];
		if(strpos($URL, '/add-cat/') !== false){
			if(!(is_user_logged_in())){
				auth_redirect();
			}
			//if(is_user_logged_in()){}
		}
	}
}
