<?php
namespace SiteConfig\Value;

use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;

class DbRepository {

    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * @var Mapper
     */
    private $mapper;

    public function __construct(
        TableGatewayInterface $tableGateway,
        Mapper $mapper) {

        $this->tableGateway = $tableGateway;
        $this->mapper = $mapper;
    }

    /**
     * @param array $criteria
     * @return ScopesCollection
     */
    public function findAll(array $criteria = [])
    {
        $rows = $this->tableGateway
            ->select($criteria)
            ->toArray();

        return $this->mapper->fromTableRows($rows);
    }

}