<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use AppDemo\Common\ServiceKernel;

//umask(0000);

$loader = require __DIR__ . '/../config/autoload.php';
require_once __DIR__ . '/../AppKernel.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$env = $_SERVER['TAST_SYMFONY_ENV'];
$debug = $_SERVER['TAST_SYMFONY_DEBUG'];

if ($debug) {
    Debug::enable();
}

$kernel = new AppKernel($env, $debug);
$kernel->loadClassCache();

$request = Request::createFromGlobals();
Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();

$kernel->boot();
$serviceKernel = ServiceKernel::instance();
$kernel->getContainer()->set('service_kernel', $serviceKernel);
$serviceKernel->setConnection($kernel->getContainer()->get('database_connection'));

try {
    $response = $kernel->handle($request);
} catch (\RuntimeException $e) {
    echo "Error!  " . $e->getMessage();
    die();
}

$response->send();
$kernel->terminate($request, $response);