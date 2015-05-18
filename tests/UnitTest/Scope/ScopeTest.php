<?php
namespace SiteConfig\UnitTest\Scope;

use SiteConfig\Scope\Scope;

class ScopeTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $scopeRaw = [
            'name' => 'Scope 1',
        ];

        $scope = new Scope($scopeRaw['name']);

        $this->assertAttributeSame($scopeRaw['name'], 'name', $scope);
        $this->assertEquals($scopeRaw['name'], $scope->getName());
    }

}