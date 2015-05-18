<?php

namespace T4webSiteConfig\Scope;

use T4webBase\Domain\Entity;

class Scope extends Entity
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}