<?php

$I = new WordpressTester\WordpressTester($scenario);

$I->wantTo('confirm the Wordpress tester can log in as an admin');
$I->loginWordpressAs('admin');