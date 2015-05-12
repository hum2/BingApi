<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Hum2\BingApi;
use BEAR\Package\Bootstrap;

error_reporting(E_ALL);

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

// set the application path into the globals so we can access it in the tests.
$_ENV['TEST_DIR'] = __DIR__;
$_ENV['TMP_DIR']  = __DIR__ . '/tmp';
// set azure client params
$GLOBALS['azure_client_id']     = 'test-azure-client-id';
$GLOBALS['azure_client_secret'] = 'test-azure-client-secret';
