<?php

$env = (stripos($_SERVER['SERVER_SOFTWARE'], 'development server') !== false ? 'development' : 'production');

$oauth_key = getenv('OAUTH_KEY');
$oauth_secret = getenv('OAUTH_SECRET');

putenv('TMPDIR=' . realpath(__DIR__ . '/../tmp'));

error_reporting(E_ALL);
ini_set('display_errors', ($env === 'development'));

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Serwisant\SerwisantCp;

$application = new SerwisantCp\Application($env, $oauth_key, $oauth_secret);
$application->run();
