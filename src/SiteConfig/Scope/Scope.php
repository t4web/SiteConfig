<?php

namespace SiteConfig\Scope;


class Scope {

    /**
     * @var string
     */
    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

} 