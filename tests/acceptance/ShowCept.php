<?php
use T4webSiteConfig\AcceptanceTester;

$I = new AcceptanceTester($scenario);
$I->wantTo('sign in');
$I->amOnPage('/admin/site-config');
$I->see('Site config', 'html body.skin-blue div.wrapper.row-offcanvas.row-offcanvas-left aside.right-side section.content-header nav.module.navbar.navbar-default div.navbar-header a.navbar-brand');

$I->dontSee('Notice');
$I->dontSee('Warning');