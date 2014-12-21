<?php

namespace SiteConfig\ViewModel\Admin;

use Zend\View\Model\ViewModel;
use SiteConfig\Scope\ScopesCollection;
use SiteConfig\Scope\Scope;

class ListViewModel extends ViewModel {

    /**
     * @var ScopesCollection
     */
    private $scopes;

    /**
     * @var string
     */
    private $selectedScopeName;

    /**
     * @return ScopesCollection
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param ScopesCollection $scopes
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }

    /**
     * @param Scope $scope
     * @return string
     */
    public function determineActiveForScope(Scope $scope)
    {
        if (empty($this->selectedScopeName)) {
            $this->selectedScopeName = $scope->getName();
        }

        if ($this->selectedScopeName == $scope->getName()) {
            return 'class="active"';
        }

        return '';
    }

    /**
     * @param string $selectedScopeName
     */
    public function setSelectedScopeName($selectedScopeName)
    {
        $this->selectedScopeName = $selectedScopeName;
    }

}