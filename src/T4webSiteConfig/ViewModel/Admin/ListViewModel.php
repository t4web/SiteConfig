<?php

namespace T4webSiteConfig\ViewModel\Admin;

use Zend\View\Model\ViewModel;
use T4webSiteConfig\Scope\Scope;

class ListViewModel extends ViewModel
{

    /**
     * @var \T4webBase\Domain\Collection
     */
    private $scopes;

    /**
     * @var string
     */
    private $selectedScopeName;

    /**
     * @var \T4webBase\Domain\Collection
     */
    private $values;

    /**
     * @return \T4webBase\Domain\Collection
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param \T4webBase\Domain\Collection $scopes
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

    /**
     * @return \T4webBase\Domain\Collection
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param \T4webBase\Domain\Collection $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

}