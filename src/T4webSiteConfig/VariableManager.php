<?php
namespace T4webSiteConfig;

use T4webBase\Domain\Service\Update;
use T4webSiteConfig\Value\Value;

class VariableManager
{

    /**
     * @var Update
     */
    private $serviceUpdate;

    function __construct(Update $serviceUpdate)
    {
        $this->serviceUpdate = $serviceUpdate;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return int
     */
    public function add($name, $value)
    {
        return $this->serviceUpdate->create(new Value($name, $value));
    }

}