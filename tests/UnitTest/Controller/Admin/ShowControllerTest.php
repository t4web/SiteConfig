<?php
namespace T4webSiteConfig\UnitTest\Controller\Admin;

use T4webSiteConfig\Controller\Admin\ShowController;

//use SiteConfig\Scope\ScopesCollection;
//use SiteConfig\Scope\Scope;
//use SiteConfig\Value\ValuesCollection;
use T4webSiteConfig\ViewModel\Admin\ListViewModel;

class ShowControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ShowController
     */
    private $controller;

    private $scopeServiceMock;
    private $valueServiceMock;
    private $viewModel;

    protected function setUp()
    {
        $this->scopeServiceMock = $this->getMockBuilder('SiteConfig\Scope\Service')
            ->disableOriginalConstructor()
            ->getMock();

        $this->valueServiceMock = $this->getMockBuilder('SiteConfig\Value\Service')
            ->disableOriginalConstructor()
            ->getMock();

        $this->viewModel = new ListViewModel();

        $this->controller = new ShowController(
            $this->scopeServiceMock,
            $this->valueServiceMock,
            $this->viewModel
        );
    }

    public function testShowAction()
    {
        $scopes = new ScopesCollection();
        $scopes[] = new Scope('name');

        $this->scopeServiceMock->expects($this->once())
            ->method('getAll')
            ->will($this->returnValue($scopes));

        $values = new ValuesCollection();

        $this->valueServiceMock->expects($this->once())
            ->method('getAll')
            ->will($this->returnValue($values));

        $view = $this->controller->defaultAction();

        $this->assertEquals($this->viewModel, $view);
        $this->assertEquals($scopes, $view->getScopes());
        $this->assertEquals($values, $view->getValues());
    }

}