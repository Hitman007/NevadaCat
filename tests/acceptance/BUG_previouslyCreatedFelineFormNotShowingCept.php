<?php

/* When you view a previously created 'feline' CPT, the form is not visable. It is because the
 * FelineInputCRUDForm class is outputting CSS to blank the form.
 */

$I = new NevadaCatTester\NevadaCatTester($scenario);

$I->wantTo("Fix a bug. Previously created CPTs not visable.");

$I->loginWordpressAs('admin');
$I->amOnPage('/feline/default-feline/');
$I->see("Default Feline");
$I->see("Kitten Kaboodle");