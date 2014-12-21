<?php

namespace SiteConfig\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use SiteConfig\Scope\Service as ScopeService;
use SiteConfig\Value\Service as ValueService;
use SiteConfig\ViewModel\Admin\ListViewModel;

class ShowController extends AbstractActionController {

    /**
     * @var ScopeService
     */
    private $scopeService;

    /**
     * @var ValueService
     */
    private $valueService;

    /**
     * @var ListViewModel
     */
    private $viewModel;

    function __construct(ScopeService $scopeService,
        ValueService $valueService,
        ListViewModel $viewModel)
    {
        $this->scopeService = $scopeService;
        $this->valueService = $valueService;
        $this->viewModel = $viewModel;
    }

    /**
     * @return ListViewModel
     */
    public function defaultAction()
    {
        $selectedScope = $this->getFromQuery('scope');

        $scopes = $this->scopeService->getAll();

        $this->viewModel->setScopes($scopes);

        if (empty($selectedScope)) {
            $selectedScope = $scopes[0]->getName();
        }

        $this->viewModel->setValues($this->valueService->getAll(['scope' => $selectedScope]));
        $this->viewModel->setSelectedScopeName($selectedScope);

        return $this->viewModel;
    }

    private function getFromQuery($name, $default = null) {
        return $this->params()->fromQuery($name, $default);
    }

}
