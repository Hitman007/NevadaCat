<?php 

/* When a user creates a new feline. They MUST enter a name. */


$I = new NevadaCatTester\NevadaCatTester($scenario);

$I->wantTo("Make sure the user is forced to enter a name on a new feline.");
$I->loginWordpressAs('admin');
$I->amOnPage("/add-cat/");
$I->see("Cat's Name:");
$I->click("Next");
$I->dontSee("Choose a product:");
$I->see("Cat's Name:");
$I->fillField("#cat_name", "DELETE THIS CAT");
$I->click("Next");
$I->see("Choose a product:");