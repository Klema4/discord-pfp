# Discord PFP (CZ/SK)

Tento projekt poskytuje jednoduchý PHP skript pro získání a cachování profilového obrázku uživatele z Discordu pomocí jeho uživatelského ID.

## Požadavky

- PHP 7.0 nebo novější
- cURL rozšíření pro PHP

## Instalace

1. Naklonujte tento repozitář do vašeho lokálního prostředí.
2. Ujistěte se, že máte nainstalovaný PHP a cURL rozšíření.
3. Otevřete soubor `index.php` a nahraďte `YOUR_TOKEN_GOES_HERE` vaším Discord bot tokenem.

## Použití

1. Spusťte PHP server v adresáři projektu:
    ```sh
    php -S localhost:8000
    ```
2. Otevřete webový prohlížeč a přejděte na adresu `http://localhost:8000/index.php?user=USER_ID`, kde `USER_ID` je ID uživatele, jehož profilový obrázek chcete získat.

## Popis kódu

Skript `index.php` provádí následující kroky:

1. Získá uživatelské ID z parametru URL `user`.
2. Pokud je uživatelské ID prázdné, zobrazí chybovou zprávu.
3. Pokud je uživatelské ID vyplněné, zkontroluje, zda existuje cachovaná verze profilového obrázku a zda je stále platná (ne starší než 5 dní).
4. Pokud existuje platná cachovaná verze, zobrazí cachovaný obrázek.
5. Pokud neexistuje platná cachovaná verze, provede cURL požadavek na Discord API pro získání informací o uživateli.
6. Pokud je požadavek úspěšný a uživatel má avatar, stáhne a cachuje avatar, poté jej zobrazí.
7. Pokud uživatel nemá avatar, zobrazí a cachuje výchozí avatar.
8. Pokud požadavek na Discord API selže, zobrazí a cachuje náhodný výchozí avatar.

## Licence

Tento projekt je licencován pod MIT licencí.

# Discord PFP (EN)

This project provides a simple PHP script to fetch and cache a user's profile picture from Discord using their user ID.

## Requirements

- PHP 7.0 or higher
- cURL extension for PHP

## Installation

1. Clone this repository to your local environment.
2. Ensure you have PHP and the cURL extension installed.
3. Open the `index.php` file and replace `YOUR_TOKEN_GOES_HERE` with your Discord bot token.

## Usage

1. Start the PHP server in the project directory:
    ```sh
    php -S localhost:8000
    ```
2. Open a web browser and navigate to `http://localhost:8000/index.php?user=USER_ID`, where `USER_ID` is the ID of the user whose profile picture you want to fetch.

## Code Description

The `index.php` script performs the following steps:

1. Retrieves the user ID from the `user` URL parameter.
2. If the user ID is empty, it displays an error message.
3. If the user ID is provided, it checks if a cached version of the profile picture exists and is still valid (not older than 5 days).
4. If a valid cached version exists, it serves the cached image.
5. If no valid cached version exists, it makes a cURL request to the Discord API to fetch user information.
6. If the request is successful and the user has an avatar, it downloads and caches the avatar, then displays it.
7. If the user does not have an avatar, it displays and caches a default avatar.
8. If the request to the Discord API fails, it displays and caches a random default avatar.

## License

This project is licensed under the MIT License.