<?php
//try
$envs = [
    'DB_HOST' => getenv('DB_HOST'),
    'DB_USERNAME' => getenv('DB_USERNAME'),
    'DB_PASSWORD' => getenv('DB_PASSWORD'),
    'DB_DATABASE' => getenv('DB_DATABASE'),
    'DB_PORT' => getenv('DB_PORT'),
    'DB_DRIVER' => getenv('DB_DRIVER'),
];

//test
$checkEnv = print_r($_ENV, true);
$debug = print_r($envs, true);

echo $debug;
echo '<br>';
echo $checkEnv;

// Set environment variables from $_SERVER
foreach ($_SERVER as $key => $value) {
    if (str_starts_with($key, 'DB_')) {
        putenv("$key=$value");
        $_ENV[$key]    = $value;
        $_SERVER[$key] = $value;
    }
}

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
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 */
require FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

require $paths->systemDirectory . '/Boot.php';

// ✅ Boot CodeIgniter
exit(CodeIgniter\Boot::bootWeb($paths));
