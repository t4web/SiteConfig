<?php

namespace T4web\SiteConfig\Controller\Console;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;

class InitController extends AbstractActionController
{
    /**
     * @var Adapter
     */
    private $dbAdapter;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function runAction()
    {
        $config = $this->getServiceLocator()->get('Config');

        $scopesTable = $config['entity_map']['ConfigScope']['table'];
        $valuesTable = $config['entity_map']['ConfigValue']['table'];

        $this->createScopesTable($scopesTable);
        $this->createValuesTable($scopesTable, $valuesTable);

        return "Success completed" . PHP_EOL;
    }

    private function createScopesTable($scopesTable)
    {
        $query = "CREATE TABLE `$scopesTable` (
              `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(255) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY (`name`),
            ) ENGINE=InnoDB CHARSET=UTF8 AUTO_INCREMENT=1;";

        $this->dbAdapter->query(
            $query,
            Adapter::QUERY_MODE_EXECUTE
        );
    }

    private function createValuesTable($scopesTable, $valuesTable)
    {
        $query = "CREATE TABLE `$valuesTable` (
              `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
              `scope_id` INTEGER UNSIGNED NOT NULL,
              `name` VARCHAR(255) NOT NULL,
              `value` TEXT,
              PRIMARY KEY (`id`),
              UNIQUE KEY (`scope_id`, `name`),
              FOREIGN KEY (`scope_id`) REFERENCES `$scopesTable`(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
            ) ENGINE=InnoDB CHARSET=UTF8 AUTO_INCREMENT=1;";

        $this->dbAdapter->query(
            $query,
            Adapter::QUERY_MODE_EXECUTE
        );
    }
}
