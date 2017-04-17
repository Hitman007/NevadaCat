<?php

$I = new WordpressTester\WordpressTester($scenario);

$I->wantTo("See several 'views' in the feline CRUD form");


$I->loginWordpressAs('admin');
$I->amOnPage('/add-cat/');
$I->see("Cat's Name");
$I->dontSee('Gender');
$I->fillField('cat_name', 'DELETETHISCAT');
$I->click('Next');
$I->wait('3');

$I->expect('to see the product input div');
$I->dontSee("Cat's Name");
$I->see('Kitten Kaboodle');
$I->click('Next');
$I->wait('3');

$I->expectTo('see the gender input div');
$I->see('Gender');
$I->click('Next');
$I->wait('3');

$I->see("Upload Your Cat's Image");
$I->click('Next');
$I->wait('3');
$I->click('Save Cat');
$I->wait('5');

$I->expectTo('see the feline has been created and I am on the CRUD page');
$I->see('DELETETHISCAT');