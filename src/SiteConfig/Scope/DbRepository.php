<?php
namespace SiteConfig\Scope;

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
            ->select(function (Select $select) use ($criteria) {
                $select->where($criteria);
                $select->columns(array(new Expression('DISTINCT(scope) as scope')));
            })
            ->toArray();

        return $this->mapper->fromTableRows($rows);
    }

}