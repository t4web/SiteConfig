<?php
namespace T4webSiteConfigTest\FunctionalTest;

use T4webSiteConfigTest\FunctionalTester;

class SaveVariableAjaxCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/login-form');
        $I->fillField('username', 'asd');
        $I->fillField('password', '111111');
        $I->click('SIGN IN');

        $I->see('Dashboard', '#content-wrapper .page-header');
        $I->seeInCurrentUrl('/');
    }

    /**
     * @var FunctionalTester
     */
    private $I;

    // tests
    public function tryToSendAjaxSaveBadVariable(FunctionalTester $I)
    {
        $this->I = $I;

        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPOST(
            '/admin/site-config/save',
            [
                'name' => 'variable1',
                'value' => 'value',
            ]
        );

        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();

        $response = json_decode($I->grabResponse(), true);

        $this->assertBadVariable($response);
    }

    private function assertBadVariable($response)
    {
        // "Variable does not exists."
        return $this->I->assertJsonStructure(
            '{
                "message": <string>
            }',
            $response);
    }

}