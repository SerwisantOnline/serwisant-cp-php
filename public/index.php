<?php

$env = (stripos($_SERVER['SERVER_SOFTWARE'], 'development server') !== false ? 'development' : 'production');

$oauth_key = getenv('OAUTH_KEY');
$oauth_secret = getenv('OAUTH_SECRET');

putenv('TMPDIR=' . realpath(__DIR__ . '/../tmp'));

error_reporting(E_ALL);
ini_set('display_errors', ($env === 'development'));

ini_set('session.gc_maxlifetime', 3600 * 2);
session_set_cookie_params(3600 * 2);
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Serwisant\SerwisantCp;
use Serwisant\SerwisantApi;

$application = new SerwisantCp\Application($env);
$application->setPublicAccessToken(new SerwisantApi\AccessTokenOauth(
  $oauth_key,
  $oauth_secret,
  'public',
  new SerwisantApi\AccessTokenContainerEncryptedFile(sha1($oauth_secret)),
  getenv('OAUTH_URL')
));
$application->setCustomerAccessToken(new SerwisantApi\AccessTokenOauthUserCredentials(
  $oauth_key,
  $oauth_secret,
  'customer',
  new SerwisantApi\AccessTokenContainerSession(),
  getenv('OAUTH_URL')
));
$application->setRouter(new SerwisantCp\RouterSelfHosted());
$application->run();
