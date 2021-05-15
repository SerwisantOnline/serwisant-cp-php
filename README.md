# serwisant-cp-php

Customer panel for Serwisant Online

# Wymagania

## Serwer

- PHP w wersji 7.2 lub 7.x
- instalacja aplikacji pod domeną lub subdomeną gdzie można w ramach konfiguracji wskazać `root` katalog aplikacji
  na `<katalog z aplikacją>/pubic`
- (opcjonalnie) git, SSH, możliwość ustalenia zmiennych środowiskowych na serwerze.

__UWAGA__.  
Nie ma możliwości instalacji aplikacji w ramach istniejącej strony.

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
