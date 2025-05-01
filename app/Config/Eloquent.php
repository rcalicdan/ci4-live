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
    public $databaseHost;

    /**
     * Default Database driver to use
     *
     * @var string
     */
    public $databaseDriver;

    /**
     * Default Database name to connect to
     *
     * @var string
     */
    public $databaseName;

    /**
     * Default Database username for authentication
     *
     * @var string
     */
    public $databaseUsername;

    /**
     * Default Database password for authentication
     *
     * @var string
     */
    public $databasePassword;

    /**
     * Default Database connection character set
     *
     * @var string
     */
    public $databaseCharset;

    /**
     * Default Database collation setting
     *
     * @var string
     */
    public $databaseCollation;

    /**
     * Default Table prefix for database connections
     *
     * @var string
     */
    public $databasePrefix ;

    /**
     * Default Database connection port
     *
     * @var string
     */
    public $databasePort;

    public function __construct()
    {
        $this->databaseHost = getenv('database.default.hostname') ?? 'localhost';
        $this->databaseName = getenv('database.default.database') ?? '';
        $this->databaseUsername = getenv('database.default.username') ?? 'root';
        $this->databasePassword = getenv('database.default.password') ?? '';
        $this->databaseCharset = getenv('database.default.charset') ?? 'utf8';
        $this->databaseCollation = getenv('database.default.DBCollat') ?? 'utf8_general_ci';
        $this->databasePrefix = getenv('database.default.DBPrefix') ?? '';
        $this->databasePort = getenv('database.default.port') ?? '3309';
        $this->databaseDriver = getenv('database.default.DBDriver') ?? 'mysql';
    }
}
