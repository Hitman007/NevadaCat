<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class NVCat extends \Codeception\Module
{
	public function eatShit(){
		
		$I = $this;
		$I->wantTo('do something!');
	}
}
