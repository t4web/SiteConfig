<?php
namespace T4webSiteConfig;

use T4webBase\Domain\Service\Create;

class VariableManager
{

    /**
     * @var Create
     */
    private $serviceCreate;

    function __construct(Create $serviceCreate)
    {
        $this->serviceCreate = $serviceCreate;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return int
     */
    public function add($name, $value)
    {
        $scope = strstr($name, '.', true);
        if (empty($scope)) {
            $scope = 'general';
        }

        $data = array(
            'scope' => $scope,
            'name' => $name,
            'value' => $value
        );

        return $this->serviceCreate->create($data);
    }

}