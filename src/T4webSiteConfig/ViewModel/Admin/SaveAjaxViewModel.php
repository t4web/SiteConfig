<?php

namespace T4webSiteConfig\ViewModel\Admin;

use Zend\View\Model\JsonModel;
use T4webBase\InputFilter\InvalidInputError;

class SaveAjaxViewModel extends JsonModel
{

    private $hasErrors = false;

    /**
     * @param InvalidInputError $errors
     */
    public function setErrors($errors)
    {
        $this->setVariable('errors', $errors->getErrors());
        $this->hasErrors = true;
    }

    /**
     *
     */
    public function getErrors()
    {
        return $this->getVariable('errors');
    }

    /**
     *
     */
    public function hasErrors()
    {
        return $this->hasErrors;
    }

    /**
     * @param array $formData
     */
    public function setFormData($formData)
    {
        $this->setVariable('formData', $formData);
    }

}