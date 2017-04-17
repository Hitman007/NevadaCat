<?php

namespace NevadaCat;

class FelineCPTFactory{
	
	public function __construct(){}
	
	public function makeFelineBasedOnName($felineName) {
		
		$defaultImageMediaLibraryID = 2569;
		// Set in the main NevadaCatPlugin.class.php
		$new_post = array('post_title'	=> $felineName,
				'post_type'  			=> 'feline',
				'post_status'			=> 'publish',
		);
		// Insert the post into the database
		$post_id = wp_insert_post( $new_post );
		$post_id = strval($post_id);
		set_post_thumbnail($post_id, $defaultImageMediaLibraryID );
		//echo ($post_id . "  " .$defaultImageMediaLibraryID );die();
		return ($post_id);
	}
	
}