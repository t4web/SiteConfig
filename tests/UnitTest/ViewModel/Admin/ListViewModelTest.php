<?php
namespace SiteConfig\UnitTest\ViewModel\Admin;

use SiteConfig\ViewModel\Admin\ListViewModel;
use SiteConfig\Scope\ScopesCollection;
use SiteConfig\Scope\Scope;

class ListViewModelTest extends \PHPUnit_Framework_TestCase
{
    public function testDetermineShouldReturnActiveForFirstScope()
    {
        $scopes = new ScopesCollection();
        $scope1 = new Scope('scope-1');
        $scope2 = new Scope('scope-2');
        $scope3 = new Scope('scope-3');

        $scopes[] = $scope1;
        $scopes[] = $scope2;
        $scopes[] = $scope3;

        $viewModel = new ListViewModel();

        $viewModel->setScopes($scopes);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

    public function testDetermineShouldReturnActiveForSelectedScope()
    {
        $scopes = new ScopesCollection();
        $scope1 = new Scope('scope-1');
        $scope2 = new Scope('scope-2');
        $scope3 = new Scope('scope-3');

        $scopes[] = $scope1;
        $scopes[] = $scope2;
        $scopes[] = $scope3;

        $viewModel = new ListViewModel();

        $viewModel->setScopes($scopes);
        $viewModel->setSelectedScopeName('scope-2');

        $this->assertEquals('', $viewModel->determineActiveForScope($scope1));
        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scope2));
        $this->assertEquals('', $viewModel->determineActiveForScope($scope3));
    }

}