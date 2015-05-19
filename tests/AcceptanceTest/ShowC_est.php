<?php

namespace T4webSiteConfigTest\AcceptanceTest;

use T4webSiteConfigTest\AcceptanceTester;

class ShowCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login-form');
        $I->fillField('username', 'asd');
        $I->fillField('password', '111111');
        $I->click('SIGN IN');

        $I->see('Dashboard', '#content-wrapper .page-header');
        $I->seeInCurrentUrl('/');
    }

    public function tryToTestShow(AcceptanceTester $I)
    {

//        $I->wantTo('sign in');
        $I->amOnPage('/admin/site-config');
        $I->seeResponseCodeIs(200);

        $I->see('Site config', 'html body.skin-blue div.wrapper.row-offcanvas.row-offcanvas-left aside.right-side section.content-header nav.module.navbar.navbar-default div.navbar-header a.navbar-brand');

        $I->dontSee('Notice');
        $I->dontSee('Warning');
    }
}