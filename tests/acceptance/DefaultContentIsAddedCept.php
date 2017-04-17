<?php

//$scenario->incomplete();

// Feature: Default content is added when the plugin is activated
$I = /*am a */ new WordpressTester\WordpressTester($scenario);
// I should be able to add content when the plugin is activated
// So that the default content can be accessed

// Scenario: the plugin is activated
// Given there is a plugin
// And the plugin is not activated
// This just assumes there is a plugin called "NevadaCat":

// ## When you deactivate the plugin, it should delete the default content
$I->deactivatePlugin('NevadaCat');
$I->activatePlugin('NevadaCat');

// Then the default content will be visible:
$I->amOnPage('/all-cats-page/');
$I->see('Cats! Cats! Cats!');

// Scenario: An admin deactivates the plugin
// Given there is a plugin
// And the plugin is activated
//$I->deactivatePlugin('NevadaCat');
// Then the default content will be deleted