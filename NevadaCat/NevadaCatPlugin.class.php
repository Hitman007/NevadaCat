<?php

namespace NevadaCat;

class NevadaCatPlugin{
	
	public function __construct(){
		require_once 'autoload.function.php';
		$this->loadHardCodedGlobals();
	}
	
	public function loadHardCodedGlobals(){
		require_once 'HardCodedVariables.php';
	}
	
	public function enqueueJSscripts(){
		//This checks to see if the user is viewing the form
		$URL = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
		$URL = $URL . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strpos($URL, '/add-cat') !== false){
			add_action('wp_enqueue_scripts', array($this, 'doEnqueueNevadaCatScripts'));
		}
	}
	
	public function doEnqueueNevadaCatScripts(){
		wp_enqueue_script( 'jquery' );
		$path = plugins_url() . "/NevadaCat/NevadaCat/AddCatForm.js";
		wp_enqueue_script('AddCatForm', $path, 'jquery');
	}
	
	public function activateFelineImageGridFeature(){
		//die('activateFelineImageGridFeature;');
		add_shortcode('FelineImageGridFeature', array($this, "doFelineImageGridFeature"));
	}
	
	public function doFelineImageGridFeature(){
		$FelineImageGridFeature = new FelineImageGridFeature;
		return ($FelineImageGridFeature->returnShortCode());	
	}
		
	public function activateAddCatShortCodeFeature(){
		//die('activateAddCatShortCodeFeature');
		$AddCatShortCodeFeature = new AddCatShortCodeFeature;
	}
	
	public function activateFelineCPT_Feature(){
		$FelineCPT  = new FelineCPT;
	}
	
	public function activateAddCatLoginRedirectFeature(){
		$AddCatLoginRedirectFeature = new AddCatLoginRedirectFeature;
	}

	public function doPluginActivationActions(){}
	
	public function doPluginDeactivationActions(){}

}