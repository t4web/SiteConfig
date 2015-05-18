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

        $this->createTable();

        $vendorSiteConfigRootPath = dirname(dirname(dirname(dirname(__DIR__))));

        if (!$this->fileSystem->has('/public/js/admin/t4web-site-config/show.js')) {
            $this->fileSystem->symlink(
                $vendorSiteConfigRootPath . '/public/js/admin/t4web-site-config',
                getcwd() . '/public/js/admin/t4web-site-config'
            );
        }

        return "Success completed" . PHP_EOL;
    }

    private function createTable()
    {
        $table = new Ddl\CreateTable('site_config');

        $table->addColumn(new Column\Integer('id', false, NULL, array('autoincrement' => true)));

        $table->addColumn(new Column\Varchar('scope', 50));
        $table->addColumn(new Column\Varchar('name', 50));
        $table->addColumn(new Column\Text('value', null, true));

        $table->addConstraint(new Constraint\PrimaryKey('id'));
        $table->addConstraint(new Constraint\UniqueKey('name', 'name'));

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
