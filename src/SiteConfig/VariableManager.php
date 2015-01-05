<?php
namespace SiteConfig;

use SiteConfig\Value\Service as ValueService;
use SiteConfig\Value\Value;

class VariableManager {

    /**
     * @var ValueService
     */
    private $valueService;

    function __construct(ValueService $valueService)
    {
        $this->valueService = $valueService;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return int
     */
    public function add($name, $value)
    {
        return $this->valueService->create(new Value($name, $value));
    }

}