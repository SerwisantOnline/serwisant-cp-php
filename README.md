# serwisant-cp-php

Customer panel dla aplikacji Serwisant Online (https://serwisant.online)

## Informacja wstępna

Niniejsza aplikacja jest panelem klienckim do aplikacji Serwisant Online (https://serwisant.online): ta aplikacja nie
może pracować samodzielnie, ponieważ korzysta z API, nie przechowując lokalnie żadnych danych. Do działania wymaga
zarejestrowanego konta oraz ważnej subskrypcji na poziomie umożliwiającym dostęp do API.

Aplikacja jest opcjonalną alternatywą dla standardowo oferowanego panelu klienta serwowanego z zasobów Serwisant Online.

Standardowo nie ma potrzeby instalowania tej aplikacji w celu uruchomienia panelu klienckiego. Operator w ramach usługi
oferuje standardowy panel kliencki.

Aplikację można zainstalować na własnym serwerze, jeśli planujesz zmiany w:

- domenie, pod którą pracuje aplikacja.
- logiki,
- wyglądu
- zakresu funkcjonalnego.

Wyżej wymienione cele, są jedynym rozsądnym uzasadnieniem dla samodzielnej instalacji tej aplikacji.

Obecna w tym repozytorium aplikacja opiera się o dodatkową bibliotekę Composer `serwisant/serwisant-cp` którą znajdziesz
na platformie [Packagist][https://packagist.org/packages/serwisant/serwisant-cp]. Biblioteka zapewnia pełną
funkcjonalność obecnej tu aplikacji, stąd nie znajdziesz zatem tutaj kodu samej aplikacji, a wyłącznie tzw. bootstrap
uruchamiający bibliotekę.

## Zastrzeżenie licencyjne

Z uwagi na licencjonowanie aplikacji, niniejszy kod nie jest objęty gwarancją, nie jest także częścią usługi świadczonej
przez operatora aplikacji Serwisant Online.

Z uwagi na powyższe operator aplikacji Serwisant Online:

- nie udziela żadnego wsparcia w ramach subskrypcji głównej aplikacji.
- nie udziela żadnej gwarancji co do poprawności działania niniejszej aplikacji.
- nie zobowiązuje się do naprawiania błędów w tej aplikacji oraz wynikających z konfiguracji środowisk, w których
  aplikacja będzie pracowała.
- może ***zaoferować odpłatne konsultacje*** związane z instalacją lub modyfikacją tej aplikacji.

# Wymagania

## Serwer

- PHP w wersji 7.4 wyższy.
- możliwość wskazania w konfiguracji hostingu wybranego katalogu, jako głównego katalogu aplikacji.
- aktywna obsługa HTTPS (bezpieczne połączenie SSL).

Opcjonalnie:

- dostęp do shella, obecność na serwerze narzędzi `git` `composer` oraz `npm`.

__UWAGA__.

Jeśli chcesz zainstalować aplikację w ramach istniejącej strony, musisz przygotować własny bootstrap. Ten, który
znajdziesz w repozytorium nie zadziała.

# Instalacja aplikacji

Wygenerować w panelu ustawień API aplikacji http://serwisant.online klucze APII ze scope  `public` oraz `customer`.

SSH na serwer hostingowy, instalujemy przykładowo w katalogu `/home/user` Tam:

```
cd /home/user
git clone https://github.com/SerwisantOnline/serwisant-cp-php.git
cd /home/user/serwisant-cp-php
```

Po pobraniu kodu aplikacji, jeśli jest możliwość ustawiania zmiennych środowiskowych w konfiguracji hostingu ustawiamy:

- `OAUTH_KEY` - klucz API.
- `OAUTH_SECRET` - hasło API.

Jeśli nie ma możliwości użycia zmiennych środowiskowych proszę edytować plik `public/index.php` i zastąpić kod:

```
# $oauth_key = getenv('OAUTH_KEY');
# $oauth_secret = getenv('OAUTH_SECRET');

$oauth_key = 'klucz_API';
$oauth_secret = 'haslo_API';
```

Następnie instalacja zależności PHP i paczek JS:

```
composer install
npm install
```

Następnie, serwer HTTP dla wybranej domeny kierujemy na katalog: `/home/user/serwisant-cp-php/public`.

## Lokalna alternatywa

Jeśli narzędzia z powyższej procedury nie są dostępne na serwerze, którego używasz lub nie masz dostępu do powłoki
systemowej serwera (shell), musisz zainstalować je lokalnie, skonfigurować aplikację i wgrać
wszystkie pliki za pomocą FTP.

Możesz także uruchomić aplikację lokalnie. W katalogu głównym aplikacji uruchom
komendę `PHP_ENV="development" OAUTH_KEY="<klucz>" OAUTH_SECRET="<sekret>" php -S 0.0.0.0:3001 -t ./public`

# Konfiguracja końcowa

Po uruchomieniu aplikacji musisz zaktualizować konfigurację w serwisant.online podając adres, pod którym działa
aplikacja. Dzięki temu będziemy mogli poprawnie
wskazywać adres panelu w komunikacji do klientów. Przede
wszystkim [zaktualizuj opcję bazowego adresu](https://serwisant.online/config_options/custom_cp_base_url/edit)
Podaj w niej bazowy adres panelu, bez żadnych dodatkowych ścieżek.

Inne opcje związane z konfiguracją panelu, w tym wiadomości powitalne, konfigurację przesyłu plików, etc. znajdziesz
w [panelu konfiguracyjnym.](https://serwisant.online/config_options?group=customer_panel)

# Modyfikacja aplikacji.

Jeśli zamierasz modyfikować aplikację, zapoznaj się z dokumentacją
modułu [serwisant/serwisant-cp](https://packagist.org/packages/serwisant/serwisant-cp).

# Typowe problemy

***Logując się do panelu, podaję poprawne login i hasło, ale po zatwierdzeniu jestem przekierowywany znów na stronę
logowania.***

Najbardziej prawdopodobną przyczyną tego typu sytuacji jest brak możliwości ustawienia cookie. Dzieje się tak, jeśli
twój serwer nie obsługuje bezpiecznego połączenia HTTPS. Postaraj się zapewnić bezpieczne połączenie dla aplikacji.

***Aplikacja wygląda brzydko, formularze są nieczytelne.***

Niepoprawny widok strony, brak styli, formatowania to efekt braku plików CSS i JS. Upewnij się, że wykonałeś
polecenie `npm install` i że wykonało się ono bez błędów. Jeśli nie było błędów i strona nadal nie wygląda poprawnie
uruchom polecenie `npm run postinstall` i upewnij się, że wykonało się bez błędów.
