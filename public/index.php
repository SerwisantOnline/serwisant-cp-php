<?php
/**
 * Ustaw zmienne środowiskowe (zalecane) lub podaj tutaj wprost dane autoryzacyjne aplikacji OAuth.
 *
 * Jeśli otrzymujesz białą stronę zamiast panelu klienckiego ustaw zmienną środowiskową PHP_ENV=development - dzięki
 * temu zobaczysz jakie błędy wyrzuca aplikacja. Po uruchomieniu usuń tę zmienną z uwago na bezpieczeństwo aplikacji.
 */

$oauth_key = getenv('OAUTH_KEY');
$oauth_secret = getenv('OAUTH_SECRET');
$env = getenv('PHP_ENV');

/**
 * Jeśli chcesz korzystać, ze współdzielonego katalogu na pliki tymczasowe i sesje usuń poniższą linijkę, przy czym
 * zwróć uwagę na to, że ich zawartość może być dostępna dla innych.
 */

$dir = realpath(__DIR__ . '/..');
$env = (stripos($_SERVER['SERVER_SOFTWARE'], 'Development Server') !== false ? 'development' : 'production');

putenv('TMPDIR=' . $dir . '/tmp');

/**
 * Nie ma potrzeby edytowania czegokolwiek poniżej.
 */

if (!trim($env)) {
  $env = 'production';
}
ini_set('display_errors', ($env == 'development'));
error_reporting(E_ALL);

require_once($dir . '/vendor/autoload.php');

use Serwisant\SerwisantCp;
use Serwisant\SerwisantApi;

$application = new SerwisantCp\Application($env);

$application->set('access_token_public', new SerwisantApi\AccessTokenOauth(
  $oauth_key,
  $oauth_secret,
  'public',
  new SerwisantApi\AccessTokenContainerEncryptedFile(sha1($oauth_key))
));

$application->set('access_token_customer', new SerwisantApi\AccessTokenOauthUserCredentials(
  $oauth_key,
  $oauth_secret,
  'customer',
  new SerwisantApi\AccessTokenContainerSession()
));

$application->setRouter(new SerwisantCp\ApplicationRouter());

$application->run();
