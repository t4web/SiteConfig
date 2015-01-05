<?php
namespace SiteConfig\FunctionalTest\VariableManager;

use Zend\Db\Adapter\Adapter;
use SiteConfig\FunctionalTester;

class CreateVariableCest
{
    private $I;

    // tests
    public function tryToCreateVariable(FunctionalTester $I)
    {
        $this->I = $I;

        $variableManager = $I
            ->getApplication()
            ->getServiceManager()
            ->get('SiteConfig\VariableManager');

        $name = 'someName';
        $value = 'someValue';

        $this->removeVariable($name);

        $result = $variableManager->add($name, 'someValue');

        $variable = $this->getVariable($name);

        $I->assertEquals(1, $result);
        $I->assertEquals('general', $variable['scope']);
        $I->assertEquals($name, $variable['name']);
        $I->assertEquals($value, $variable['value']);

        $this->removeVariable($name);
    }

    private function removeVariable($name)
    {
        $dbAdapter = $this->I
            ->getApplication()
            ->getServiceManager()
            ->get('Zend\Db\Adapter\Adapter');

        $dbAdapter->query(
            "DELETE
            FROM t4_site_config
            WHERE name = '$name'",
            Adapter::QUERY_MODE_EXECUTE
        );
    }

    private function getVariable($name)
    {
        $dbAdapter = $this->I
            ->getApplication()
            ->getServiceManager()
            ->get('Zend\Db\Adapter\Adapter');

        return $dbAdapter->query(
            "SELECT scope, name, value
            FROM t4_site_config
            WHERE name = '$name'",
            Adapter::QUERY_MODE_EXECUTE
        )->toArray()[0];
    }

}