<?php

namespace T4webSiteConfig\Factory\Controller\Admin;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Sebaks\Crud\Controller\ListController;
use T4webFilter\Filter;
use T4webSiteConfig\ViewModel\Admin\ListViewModel;

class ShowControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $this->serviceLocator = $controllerManager->getServiceLocator();

        $repository = $this->serviceLocator->get("T4webSiteConfig\\Value\\Infrastructure\\Repository");

        /** @var ListViewModel $viewModel */
        $viewModel = $this->serviceLocator->get("T4webSiteConfig\\ViewModel\\Admin\\ListViewModel");
        $viewModel->setTemplate('t4web-site-config/admin/show/default');

        $requestParams = $this->serviceLocator->get('request')->getQuery()->toArray();

        $scope = 1;
        if (isset($requestParams['scope'])) {
            $scope = $requestParams['scope'];
        }

        $viewModel->setScopeId($scope);

        $instance = new ListController(
            ['scopeId.equalTo' => $scope, 'limit' => 200],
            new Filter(),
            $repository,
            $viewModel
        );

        return $instance;
    }
}