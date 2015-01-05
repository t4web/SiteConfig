<?php
namespace SiteConfig\Value;

use Zend\Db\TableGateway\TableGatewayInterface;

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

    /**
     * @param Value $value
     *
     * @return int
     */
    public function add(Value $value)
    {
        $row = $this->mapper->toTableRow($value);
        return $this->tableGateway->insert($row);
    }

}