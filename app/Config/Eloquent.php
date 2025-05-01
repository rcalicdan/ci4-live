<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Default Eloquent Configuration
 *
 * Contains default database connection settings for integrating Eloquent ORM
 * with CodeIgniter 4. These settings map to the default database configuration
 * in CodeIgniter.
 */
class Eloquent extends BaseConfig
{
    /**
     * Default Database hostname or IP address
     *
     * @var string
     */
    public $databaseHost = 'mysql.railway.internal';

    /**
     * Default Database driver to use
     *
     * @var string
     */
    public $databaseDriver = 'mysql';

    /**
     * Default Database name to connect to
     *
     * @var string
     */
    public $databaseName = 'railway';

    /**
     * Default Database username for authentication
     *
     * @var string
     */
    public $databaseUsername = 'root';

    /**
     * Default Database password for authentication
     *
     * @var string
     */
    public $databasePassword = 'bIUcWnnYnjNSsbyyacMqkFvcciZpdJIz';

    /**
     * Default Database connection character set
     *
     * @var string
     */
    public $databaseCharset = 'utf8';

    /**
     * Default Database collation setting
     *
     * @var string
     */
    public $databaseCollation = 'utf8_general_ci';

    /**
     * Default Table prefix for database connections
     *
     * @var string
     */
    public $databasePrefix = '';

    /**
     * Default Database connection port
     *
     * @var string
     */
    public $databasePort = '3306';
}
