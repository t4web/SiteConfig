<?php

namespace T4webSiteConfig\Value\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Text;
use T4webBase\InputFilter\Element\Id;

class Update extends InputFilter
{

    public function __construct()
    {

        // name
        $name = new Text('name');
        $name->setRequired(false);
        $this->add($name);

        // value
        $value = new Text('value');
        $value->setRequired(true);
        $this->add($value);

    }
}
