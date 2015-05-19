<?php
namespace T4webSiteConfigTest\UnitTest\Controller\Admin;

use T4webSiteConfig\Controller\Admin\ShowController;

use T4webBase\Domain\Collection;
use T4webSiteConfig\Scope\Scope;
use T4webSiteConfig\ViewModel\Admin\ListViewModel;

class ShowControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ShowController
     */
    private $controller;

    private $valueFinderMock;
    private $scopeFinderMock;
    private $viewModel;

    protected function setUp()
    {
        $this->valueFinderMock = $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')
            ->disableOriginalConstructor()
            ->getMock();

        $this->scopeFinderMock = $this->getMockBuilder('T4webBase\Domain\Service\BaseFinder')
            ->disableOriginalConstructor()
            ->getMock();

        $this->viewModel = new ListViewModel();

        $this->controller = new ShowController(
            $this->valueFinderMock,
            $this->scopeFinderMock,
            $this->viewModel
        );
    }

    public function testDefaultAction()
    {
        $scopes = new Collection();
        $scopes->offsetSet(1, new Scope(array('name' => 'scopeName')));

        $this->scopeFinderMock->expects($this->once())
            ->method('findMany')
            ->will($this->returnValue($scopes));

        $values = new Collection();

        $this->valueFinderMock->expects($this->once())
            ->method('findMany')
            ->will($this->returnValue($values));

        $view = $this->controller->defaultAction();

        $this->assertEquals($this->viewModel, $view);
        $this->assertEquals($scopes, $view->getScopes());
        $this->assertEquals($values, $view->getValues());
    }

}