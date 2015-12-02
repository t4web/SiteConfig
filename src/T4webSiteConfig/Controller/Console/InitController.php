<?php

namespace T4webSiteConfig\Controller\Console;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Ddl;
use Zend\Db\Sql\Ddl\Column;
use Zend\Db\Sql\Ddl\Constraint;
use Zend\Db\Sql\Sql;
use PDOException;
use League\Flysystem\Filesystem;

class InitController extends AbstractActionController
{

    /**
     * @var Adapter
     */
    private $dbAdapter;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    public function __construct(Adapter $dbAdapter, Filesystem $fileSystem)
    {
        $this->dbAdapter = $dbAdapter;
        $this->fileSystem = $fileSystem;
    }

    public function runAction()
    {

        $this->createScopesTable();
        $this->createValuesTable();

        return "Success completed" . PHP_EOL;
    }

    private function createScopesTable()
    {
        $table = new Ddl\CreateTable('site_config_scopes');

        $table->addColumn(new Column\Integer('id', false, NULL, array('autoincrement' => true)));

        $table->addColumn(new Column\Varchar('name', 50));

        $table->addConstraint(new Constraint\PrimaryKey('id'));
        $table->addConstraint(new Constraint\UniqueKey('name'));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }

        $this->dbAdapter->query(
            "INSERT INTO `site_config_scopes` (`id` ,`name`) VALUES ('1', 'General');",
            Adapter::QUERY_MODE_EXECUTE
        );
    }

    private function createValuesTable()
    {
        $table = new Ddl\CreateTable('site_config_values');

        $table->addColumn(new Column\Integer('id', false, NULL, array('autoincrement' => true)));

        $table->addColumn(new Column\Integer('scope_id', false));
        $table->addColumn(new Column\Varchar('name', 50));
        $table->addColumn(new Column\Text('value', null, true));

        $table->addConstraint(new Constraint\PrimaryKey('id'));
        $table->addConstraint(new Constraint\UniqueKey(['scope_id', 'name']));

        $sql = new Sql($this->dbAdapter);

        try {
            $this->dbAdapter->query(
                $sql->getSqlStringForSqlObject($table),
                Adapter::QUERY_MODE_EXECUTE
            );
        } catch (PDOException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }
}
