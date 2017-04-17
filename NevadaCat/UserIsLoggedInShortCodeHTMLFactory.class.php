<?php

namespace NevadaCat;

class UserIsLoggedInShortCodeHTMLFactory{
	
	public function __construct() {}
	
	public function getHTMLOutput(){
		
		if((!(isset($_POST['crg_cat_id']))) && (isset($_POST['crg-cat-name']))){
			$felineName = $_POST['crg-cat-name'];
			$CRGcatID = $this->doCreateFelineCPT($felineName);
			$x = get_permalink($CRGcatID);
			wp_redirect($x);
			die('something is wrong here');
		}
	}
	
	public function doCreateFelineCPT($felineName){
		$FelineCPTFactory = new FelineCPTFactory;
		$postID = $FelineCPTFactory->makeFelineBasedOnName($felineName);
		return $postID;
	}
}