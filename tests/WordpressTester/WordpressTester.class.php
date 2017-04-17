<?php

namespace WordpressTester;

class WordpressTester extends \AcceptanceTester implements WordpressTesterInterface{
	use AbilityToActivatePlugin_pluginName;
	use AbilityToDeactivatePlugin_pluginName;
	use AbilityToSeePluginIsActivated_pluginName;
	use AbilityToLoginWordpressAs_role;
	use AbilityToResetTheDatabase;
}

interface WordpressTesterInterface{
	public function activatePlugin($pluginName);
	public function deactivatePlugin($pluginName);
    public function seePluginIsActivated($pluginName);
    public function loginWordpressAs($role);
    public function resetTheDatabase($SQL_DumpFile);
}