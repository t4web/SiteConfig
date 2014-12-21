<?php

namespace SiteConfig\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use SiteConfig\Scope\Service as ScopeService;
use SiteConfig\ViewModel\Admin\ListViewModel;

class ShowController extends AbstractActionController {

    /**
     * @var ScopeService
     */
    private $scopeService;

    /**
     * @var ListViewModel
     */
    private $viewModel;

    function __construct(ScopeService $scopeService, ListViewModel $viewModel)
    {
        $this->scopeService = $scopeService;
        $this->viewModel = $viewModel;
    }

    /**
     * @return ListViewModel
     */
    public function defaultAction()
    {
        $selectedScope = $this->getFromQuery('scope');

        $this->viewModel->setScopes($this->scopeService->getAll());
        $this->viewModel->setSelectedScopeName($selectedScope);

        return $this->viewModel;
    }

    private function getFromQuery($name, $default = null) {
        return $this->params()->fromQuery($name, $default);
    }

}
