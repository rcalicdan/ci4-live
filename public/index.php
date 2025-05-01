<?php

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */

$minPhpVersion = '8.1'; // If you update this, don't forget to update `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION,
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// 1) Load your Paths config
require FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

// 2) Load the framework bootstrap
require $paths->systemDirectory . '/Boot.php';

// ⇩⇩⇩ Hydrate any Railway “Service Variables” starting with DB_* ⇩⇩⇩
foreach ($_SERVER as $key => $value) {
    if (str_starts_with($key, 'DB_')) {
        // putenv makes it visible to getenv()
        putenv("$key=$value");
        // and copy into CI4's env() tables
        $_ENV[$key]    = $value;
        $_SERVER[$key] = $value;
    }
}

// 3) Finally, boot CodeIgniter for web requests
exit(CodeIgniter\Boot::bootWeb($paths));
