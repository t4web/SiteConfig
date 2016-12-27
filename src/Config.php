<?php

namespace T4web\SiteConfig;

use T4webDomainInterface\Infrastructure\RepositoryInterface;
use T4web\SiteConfig\Entity\Value;

class Config
{
    /**
     * @var array
     */
    protected $values;

    /**
     * @var RepositoryInterface
     */
    private $valueRepository;

    /**
     * @var RepositoryInterface
     */
    private $scopeRepository;

    /**
     * @param RepositoryInterface $valueRepository
     * @param RepositoryInterface $scopeRepository
     */
    public function __construct(
        RepositoryInterface $valueRepository,
        RepositoryInterface $scopeRepository
    )
    {
        $this->valueRepository = $valueRepository;
        $this->scopeRepository = $scopeRepository;
    }

    /**
     * @param $name
     * @param string $scope
     * @param null $defaultValue
     * @return string|null
     */
    public function get($name, $scope, $defaultValue = null)
    {
        $this->assertNotEmpty($name, 'name');
        $this->assertNotEmpty($scope, 'scope');

        if (empty($this->values)) {
            $this->load();
        }

        if (!isset($this->values[$scope])) {
            return $defaultValue;
        }

        if (!isset($this->values[$scope][$name])) {
            return $defaultValue;
        }

        return $this->values[$scope][$name]->getValue();
    }

    /**
     * @param string $name
     * @param string $scope
     * @param string $value
     */
    public function set($name, $scope, $value)
    {
        $this->assertNotEmpty($name, 'name');
        $this->assertNotEmpty($scope, 'scope');
        $this->assertNotEmpty($value, 'value');
        
        if (empty($this->values)) {
            $this->load();
        }

        if (!isset($this->values[$scope])) {
            throw new Exception\InvalidArgumentException("Scope $scope not found.");
        }

        if (!isset($this->values[$scope][$name])) {
            throw new Exception\InvalidArgumentException("Config param $name not found in scope $scope.");
        }

        /** @var Value $value */
        $configValue = $this->values[$scope][$name];
        $configValue->setValue($value);

        $this->valueRepository->add($configValue);
    }

    private function assertNotEmpty($value, $name)
    {
        if (empty($value)) {
            throw new Exception\InvalidArgumentException("$name cannot be empty.");
        }
    }

    private function load()
    {
        /** @var Entity\Value[] $values */
        $values = $this->valueRepository->findMany([]);
        /** @var Entity\Scope[] $scopes */
        $scopes = $this->scopeRepository->findMany([]);

        $this->values = [];
        foreach ($values as $value) {
            if (!isset($scopes[$value->getScopeId()])) {
                $scopeName = '';
            } else {
                $scopeName = $scopes[$value->getScopeId()]->getName();
            }
            $this->values[$scopeName][$value->getName()] = $value;
        }
    }
}
