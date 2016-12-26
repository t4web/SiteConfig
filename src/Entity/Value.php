<?php

namespace T4web\SiteConfig\Entity;

use T4webDomain\Entity;

class Value extends Entity
{
    /**
     * @var int
     */
    protected $scopeId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var value
     */
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