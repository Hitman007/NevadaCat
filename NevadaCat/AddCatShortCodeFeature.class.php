<?php

namespace NevadaCat;

class AddCatShortCodeFeature{
	
	public function __construct() {
		$this->activateShortCodeListener();
		add_shortcode('ADDCAT', array($this, 'getShortCodeHTML'));
	}

	public function getShortCodeHTML() {
		$FelineInputCRUDForm = new FelineInputCRUDForm();
		$shortCodeHTML = $FelineInputCRUDForm->doReturnForm(0);
		return $shortCodeHTML;
	}
		
	public function activateShortCodeListener(){
		$FelineFormListener = new FelineFormListener;
	}
	
}