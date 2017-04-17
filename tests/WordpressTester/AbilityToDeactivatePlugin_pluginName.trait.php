<?php

namespace WordpressTester;

trait AbilityToDeactivatePlugin_pluginName{

	public function deactivatePlugin($pluginName) {

		//activate the plugin
		$execCommand = "wp plugin deactivate $pluginName";
		$execReturnString = shell_exec($execCommand);

		//check status, and then return true or false if the plugin was infact deactivated
		$execCommand = "wp plugin status $pluginName";
		$execReturnString = shell_exec($execCommand);

		if (strpos($execReturnString, 'Inactive') !== FALSE){
			//the plugin has indeed been activated:
			return TRUE;
		}else{
			//the plugin has not been activated:
			return FALSE;
		}
	}
}