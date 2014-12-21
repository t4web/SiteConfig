<?php
namespace SiteConfig\UnitTest\Controller\Admin;

use SiteConfig\Controller\Admin\ShowController;
use SiteConfig\Scope\ScopesCollection;
use SiteConfig\ViewModel\Admin\ListViewModel;

class ShowControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ShowController
     */
    private $controller;

    private $scopeServiceMock;
    private $viewModel;

    protected function setUp()
    {
        $this->scopeServiceMock = $this->getMockBuilder('SiteConfig\Scope\Service')
            ->disableOriginalConstructor()
            ->getMock();

        $this->viewModel = new ListViewModel();

        $this->controller = new ShowController(
            $this->scopeServiceMock,
            $this->viewModel
        );
    }

    public function testShowAction()
    {
        $scopes = new ScopesCollection();

        $this->scopeServiceMock->expects($this->once())
            ->method('getAll')
            ->will($this->returnValue($scopes));

        $view = $this->controller->defaultAction();

        $this->assertEquals($this->viewModel, $view);
        $this->assertEquals($scopes, $view->getScopes());
    }

}