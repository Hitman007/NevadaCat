<?php

namespace NevadaCatTester;

trait AbilityToDeleteFeline_name{

	public function deleteFeline($name) {}

	public function returnArrayOfFelineIDs(){
		
		$arrayOfFelineIDs= array();
		$x = 'wp post list --post_type="feline" --fields=ID --format=json';
		$str = shell_exec($x);
		$str = substr($str, 5);
		die($str);
		
	}
}