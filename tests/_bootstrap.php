<?php
// This is global bootstrap for autoloading

global $CRG_loginPageURL; $CRG_loginPageURL = "/wp-login.php";

global $CRG_adminRoleUserName; $CRG_adminRoleUserName = "admin"; 
global $CRG_adminRoleUserPassword; $CRG_adminRoleUserPassword = "password";

function WordpressTesterAutoload($className){
	$front = substr($className, 0, 15);
	
	//Check namespace:
	if ($front != "WordpressTester"){
		return;
	}
	
	$className = substr($className, 16);
	
	//Check for ".class.php":
	$fileName = '//var/www/html/wp-content/plugins/NevadaCat/tests/WordpressTester/' . $className . '.class.php';
	if (file_exists($fileName)) {
		include_once($fileName);
	}else{
		//Check for ".trait.php":
		$fileName = '//var/www/html/wp-content/plugins/NevadaCat/tests/WordpressTester/' . $className . '.trait.php';
		if (file_exists($fileName)) {
			include_once($fileName);
		}
	}
}
spl_autoload_register('WordpressTesterAutoload');

function NevadaCatAutoload($className){
	$front = substr($className, 0, 9);
	
	//Check namespace:
	if ($front != "NevadaCat"){
		return;
	}
	
	$className = substr($className, 10);
	
	//Check for ".class.php":
	$fileName = '//var/www/html/wp-content/plugins/NevadaCat/NevadaCat/' . $className . '.class.php';
	if (file_exists($fileName)) {
		include_once($fileName);
	}else{
		//Check for ".trait.php":
		$fileName = '//var/www/html/wp-content/plugins/NevadaCat/NevadaCat/' . $className . '.trait.php';
		if (file_exists($fileName)) {
			include_once($fileName);
		}
	}
}
spl_autoload_register('NevadaCatAutoload');
