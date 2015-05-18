<?php

namespace T4webSiteConfig\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;

use T4webBase\Domain\Service\Update;
use T4webSiteConfig\ViewModel\Admin\SaveAjaxViewModel;

class SaveAjaxController extends AbstractActionController
{

    /**
     * @var Update
     */
    private $serviceUpdate;

    /**
     * @var SaveAjaxViewModel
     */
    private $view;

    function __construct(Update $serviceUpdate, SaveAjaxViewModel $viewModel)
    {
        $this->serviceUpdate = $serviceUpdate;
        $this->view = $viewModel;
    }

    /**
     * @return SaveAjaxViewModel
     */
    public function defaultAction()
    {

        if (!$this->getRequest()->isPost()) {
            return $this->view;
        }

        $params = $this->getRequest()->getPost()->toArray();

        $config = $this->serviceUpdate->update($params['name'], $params);

        if (!$config) {
            $this->view->setFormData($params);
            $this->view->setErrors($this->serviceUpdate->getErrors());
            return $this->view;
        }

        $this->view->setFormData($config->extract());

        return $this->view;
    }

}
