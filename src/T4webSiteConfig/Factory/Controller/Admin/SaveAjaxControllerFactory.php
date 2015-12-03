<?php

namespace T4webSiteConfig\Factory\Controller\Admin;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Sebaks\Crud\Controller\CreateController;
use T4webDomainInterface\Service\CreatorInterface;
use T4webSiteConfig\ViewModel\Admin\SaveAjaxViewModel;

class SaveAjaxControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();

        $viewModel = new SaveAjaxViewModel();

        /** @var CreatorInterface $repository */
        $creator = $serviceLocator->get("T4webSiteConfig\\Value\\Service\\Creator");

        $post = $serviceLocator->get('request')->getPost()->toArray();

        return new CreateController($post, $creator, $viewModel);
    }
}