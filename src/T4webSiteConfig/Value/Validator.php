<?php

namespace T4webSiteConfig\Value;

use T4webDomainInterface\ValidatorInterface;

class Validator implements ValidatorInterface {

    public function isValid(array $value)
    {
        return true;
    }

    public function getMessages()
    {
        return [];
    }

}