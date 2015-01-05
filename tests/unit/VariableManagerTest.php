<?php
namespace SiteConfig\UnitTest\ViewModel\Admin;

use SiteConfig\VariableManager;

class VariableManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VariableManager
     */
    private $variableManager;

    private $valueServiceMock;

    protected function setUp()
    {
        $this->valueServiceMock = $this->getMockBuilder('SiteConfig\Value\Service')
            ->disableOriginalConstructor()
            ->getMock();

        $this->variableManager = new VariableManager($this->valueServiceMock);
    }

    public function testAddNewVariable()
    {
        $name = 'variable1';
        $value = 'value';

        $this->valueServiceMock->expects($this->once())
            ->method('create')
            ->will($this->returnValue(true));

        $result = $this->variableManager->add($name, $value);

        $this->assertEquals(1, $result);
    }
/*
    public function testAddNewVariableWithScope()
    {
        $name = 'variable1';
        $value = 'value';
        $scope = 'media';

        $variableManager = new VariableManager();

        $variableManager->add($name, $value, $scope);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testAddExistingVariableWithOverwrite()
    {
        $name = 'variable1';
        $value = 'value';
        $scope = 'media';
        $overwrite = true;

        $variableManager = new VariableManager();

        $variableManager->add($name, $value, $scope, $overwrite);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testAddExistingVariableWithOutOverwrite()
    {
        $name = 'variable1';
        $value = 'value';
        $scope = 'media';
        $overwrite = true;

        $variableManager = new VariableManager();

        $variableManager->add($name, $value, $scope, $overwrite);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testUpdateExistingVariable()
    {
        $name = 'variable1';
        $value = 'value';

        $variableManager = new VariableManager();

        $variableManager->update($name, $value);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testUpdateUnknownVariable()
    {
        $name = 'variable1';
        $value = 'value';

        $variableManager = new VariableManager();

        $variableManager->update($name, $value);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testUpdateVariableCreateIfNotExists()
    {
        $name = 'variable1';
        $value = 'value';
        $ceateIfNotExists = true;

        $variableManager = new VariableManager();

        $variableManager->update($name, $value, $ceateIfNotExists);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testGetVariable()
    {
        $name = 'variable1';

        $variableManager = new VariableManager();

        $variableManager->get($name);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testGetUnknownVariable()
    {
        $name = 'variable1';

        $variableManager = new VariableManager();

        $variableManager->get($name);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testRemoveVariable()
    {
        $name = 'variable1';

        $variableManager = new VariableManager();

        $variableManager->remove($name);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testRemoveLastVariableInScope()
    {
        $name = 'variable1';

        $variableManager = new VariableManager();

        $variableManager->remove($name);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }
*/
}