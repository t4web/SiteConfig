<?php

namespace T4webSiteConfig\Value\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Text;
use T4webBase\InputFilter\Element\Id;

class Create extends InputFilter
{

    public function __construct()
    {

//        // id
//        $id = new Id('id');
//        $id->setRequired(false);
//        $this->add($id);

        // name
        $name = new Text('name');
        $name->setRequired(true);
        $this->add($name);

        // value
        $value = new Text('value');
        $value->setRequired(true);
        $this->add($value);

    }
}
