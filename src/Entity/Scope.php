<?php

namespace T4web\SiteConfig\Entity;

use T4webDomain\Entity;

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
}