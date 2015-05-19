<?php
namespace T4webSiteConfigTest\UnitTest\ViewModel\Admin;

use T4webSiteConfig\ViewModel\Admin\ListViewModel;
use T4webBase\Domain\Collection;
use T4webSiteConfig\Scope\Scope;

class ListViewModelTest extends \PHPUnit_Framework_TestCase
{
    public function testDetermineShouldReturnActiveForFirstScope()
    {
        $scopes = new Collection();
        $scopes->offsetSet(1, new Scope(array('name' => 'scope-1')));
        $scopes->offsetSet(2, new Scope(array('name' => 'scope-2')));
        $scopes->offsetSet(3, new Scope(array('name' => 'scope-3')));

        $viewModel = new ListViewModel();

        $viewModel->setScopes($scopes);

        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scopes->offsetGet(1)));
        $this->assertEquals('', $viewModel->determineActiveForScope($scopes->offsetGet(2)));
        $this->assertEquals('', $viewModel->determineActiveForScope($scopes->offsetGet(3)));
    }

    public function testDetermineShouldReturnActiveForSelectedScope()
    {
        $scopes = new Collection();
        $scopes->offsetSet(1, new Scope(array('name' => 'scope-1')));
        $scopes->offsetSet(2, new Scope(array('name' => 'scope-2')));
        $scopes->offsetSet(3, new Scope(array('name' => 'scope-4')));

        $viewModel = new ListViewModel();

        $viewModel->setScopes($scopes);
        $viewModel->setSelectedScopeName('scope-2');

        $this->assertEquals('', $viewModel->determineActiveForScope($scopes->offsetGet(1)));
        $this->assertEquals('class="active"', $viewModel->determineActiveForScope($scopes->offsetGet(2)));
        $this->assertEquals('', $viewModel->determineActiveForScope($scopes->offsetGet(3)));
    }

}