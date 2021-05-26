# serwisant-cp-php

Customer panel dla aplikacji Serwisant Online (https://serwisant.online)

## Informacja wstępna

Niniejsza aplikacja jest panelem klienckim do aplikacji Serwisant Online: ta aplikacja nie może pracować samodzielnie,
ponieważ korzysta z API, nie przechowując lokalnie żadnych danych. Do działania wymaga zarejestrowanego konta oraz
ważnej subskrypcji na poziomie umożliwiającym dostęp do API.

Aplikacja jest opcjonalną alternatywą dla standardowo oferowanego panelu klienta serwowanego z zasobów Serwisant Online.
Nie ma potrzeby instalowania tej aplikacji w celu uruchomienia panelu klienckiego. Operator w ramach usługi oferuje
standardowy panel kliencki.

Aplikację można zainstalować na własnym serwerze i mając na względzie licencję, na której jest udostępniona samodzielnie
zmodyfikować:

- domenę, pod którą pracuje aplikacja.
- logikę,
- wygląd
- zakres funkcjonalny.

Wyżej wymienione cele, są jedynym rozsądnym uzasadnieniem dla samodzielnej instalacji tej aplikacji.

Aplikacja opiera się o dodatkową bibliotekę `serwisant/serwisant-cp` która zapewnia całą jej funkcjonalność.

## Zastrzeżenie licencyjne

Z uwagi na licencjonowanie aplikacji, niniejszy kod nie jest objęty gwarancją, nie jest także częścią usługi świadczonej
przez operatora aplikacji Serwisant Online.

Z uwagi na powyższe operator aplikacji Serwisant Online:

- nie udziela żadnego wsparcia w ramach subskrypcji głównej aplikacji.
- nie udziela żadnej gwarancji co do poprawności działania niniejszej aplikacji.
- nie zobowiązuje się do naprawiania błędów w tej aplikacji oraz wynikających z konfiguracji środowisk, w których
  aplikacja będzie pracowała.
- może zaoferować odpłatne konsultacje związane z instalacją lub modyfikacją tej aplikacji.

# Wymagania

## Serwer

- PHP w wersji 7.2 lub 7.x
- instalacja aplikacji pod domeną lub subdomeną gdzie można w ramach konfiguracji wskazać `root` katalog aplikacji
  na `<katalog z aplikacją>/pubic`
- (opcjonalnie) git, SSH, możliwość ustalenia zmiennych środowiskowych na serwerze.

__UWAGA__.  
Nie ma możliwości instalacji aplikacji w ramach istniejącej strony (eg. nie można 'wrzucić' aplikacji do katalogu ze
swoją stroną na serwerze).

## Instalator

- composer: https://getcomposer.org
- npm

# Instalacja aplikacji

Wygenerować w panelu ustawień API aplikacji http://serwisant.online klucze APII ze scope  `public` oraz `customer`.

SSH na serwer hostingowy, instalujemy przykładowo w katalogu `/home/user` Tam:

```
cd /home/user
git clone https://github.com/SerwisantOnline/serwisant-cp-php.git
cd /home/user/serwisant-cp-php
```

Po pobraniu kodu aplikacji, jeśli jest możliwość ustawiania zmiennych środowiskowych ustawiamy:

- `OAUTH_KEY` - klucz API.
- `OAUTH_SECRET` - hasło API.

Jeśli nie ma możliwości użycia zmiennych środowiskowych proszę wyedytować plik `public/index.php` i zastąpić kod:

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
