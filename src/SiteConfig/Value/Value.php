<?php

namespace SiteConfig\Value;


class Value {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

} 