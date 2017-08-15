<?php

namespace NevadaCatTester;

class NevadaCatTester extends \WordpressTester\WordpressTester implements NevadaCatTesterInterface{
	use AbilityToDeleteFeline_name;
}

interface NevadaCatTesterInterface{
	public function deleteFeline($name);
}