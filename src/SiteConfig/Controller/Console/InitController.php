<?php

namespace SiteConfig\Controller\Console;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Metadata\Metadata;

class InitController extends AbstractActionController {

    /**
     * @var Adapter
     */
    private $dbAdapter;

    /**
     * @var Metadata
     */
    private $metadata;

    public function __construct(Adapter $dbAdapter, Metadata $metadata){
        $this->dbAdapter = $dbAdapter;
        $this->metadata = $metadata;
    }

    public function runAction() {

        $databaseName = $this->getDatabaseName();

        if (empty($databaseName)) {
            return "Db access not configured" . PHP_EOL;
        }

        $result = $this->dbAdapter->query(
            "SELECT *
            FROM information_schema.tables
            WHERE table_schema = '$databaseName'
                AND table_name = 't4_site_config'
            LIMIT 1;",
            Adapter::QUERY_MODE_EXECUTE
        );

        if ($result->count() > 0) {
            return "Already initialized" . PHP_EOL;
        }

        $this->dbAdapter->query(
            "CREATE TABLE IF NOT EXISTS `t4_site_config` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `scope` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
              `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
              `value` text COLLATE utf8_unicode_ci DEFAULT '',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;",
            Adapter::QUERY_MODE_EXECUTE
        );

        return "Success completed" . PHP_EOL;
    }

    private function getDatabaseName()
    {
        $schemas = $this->metadata->getSchemas();

        if (!array_key_exists(0, $schemas)) {
            return;
        }

        return $schemas[0];
    }
}
