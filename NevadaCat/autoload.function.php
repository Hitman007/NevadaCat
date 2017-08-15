<?php

namespace NevadaCat;

function autoload($className){
	$front = substr($className, 0, 9);
	
	if ($front != "NevadaCat"){
		return;
	}
	$className = substr($className, 10);
	$fileName = $className . '.class.php';

	include_once($fileName);
}

spl_autoload_register('NevadaCat\autoload');

//hello there