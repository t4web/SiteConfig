<?php

namespace T4webSiteConfig\Value;

use T4webDomain\Entity;

class Value extends Entity
{

    protected $scopeId;
    protected $name;
    protected $value;

    /**
     * @return string
     */
    public function getScopeId()
    {
        return $this->scopeId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}