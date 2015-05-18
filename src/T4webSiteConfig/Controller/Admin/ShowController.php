<?php

namespace T4webSiteConfig\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;

use T4webBase\Domain\Service\BaseFinder;
use T4webSiteConfig\ViewModel\Admin\ListViewModel;

class ShowController extends AbstractActionController
{

    /**
     * @var BaseFinder
     */
    private $scopeFinder;

    /**
     * @var BaseFinder
     */
    private $valueFinder;

    /**
     * @var ListViewModel
     */
    private $viewModel;

    function __construct(
        BaseFinder $valueFinder,
        BaseFinder $scopeFinder,
        ListViewModel $viewModel)
    {
        $this->valueFinder = $valueFinder;
        $this->scopeFinder = $scopeFinder;
        $this->viewModel = $viewModel;
    }

    /**
     * @return ListViewModel
     */
    public function defaultAction()
    {
        $selectedScope = $this->getFromQuery('scope');

        $scopes = $this->scopeFinder->findMany();

        $this->viewModel->setScopes($scopes);

        if (empty($selectedScope) && $scopes->count()) {
            $selectedScope = $scopes->getFirst()->getName();
        }

        $values = $this->valueFinder->findMany();

        $this->viewModel->setValues($values);
        $this->viewModel->setSelectedScopeName($selectedScope);

        return $this->viewModel;
    }

    private function getFromQuery($name, $default = null)
    {
        return $this->params()->fromQuery($name, $default);
    }

}
