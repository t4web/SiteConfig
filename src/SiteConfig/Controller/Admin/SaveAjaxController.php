<?php

namespace SiteConfig\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use SiteConfig\ViewModel\Admin\SaveAjaxViewModel;

class SaveAjaxController extends AbstractActionController {

    /**
     * @var SaveAjaxViewModel
     */
    private $viewModel;

    function __construct(SaveAjaxViewModel $viewModel)
    {
        $this->viewModel = $viewModel;
    }

    /**
     * @return SaveAjaxViewModel
     */
    public function defaultAction()
    {
        $this->getResponse()->setStatusCode(404);
        $this->viewModel->message = 'Variable does not exists.';

        return $this->viewModel;
    }

}
