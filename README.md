# Discord PFP (CZ/SK)

Tento projekt poskytuje jednoduchý PHP skript pro získání profilového obrázku uživatele z Discordu pomocí jeho uživatelského ID.

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
3. Pokud je uživatelské ID vyplněné, provede cURL požadavek na Discord API pro získání informací o uživateli.
4. Pokud je požadavek úspěšný a uživatel má avatar, stáhne avatar a zobrazí jej.
5. Pokud uživatel nemá avatar, zobrazí výchozí avatar.
6. Pokud požadavek na Discord API selže, zobrazí náhodný výchozí avatar.

## Licence

Tento projekt je licencován pod MIT licencí.

# Discord PFP (EN)

This project provides a simple PHP script to fetch a user's profile picture from Discord using their user ID.

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
3. If the user ID is provided, it makes a cURL request to the Discord API to fetch user information.
4. If the request is successful and the user has an avatar, it downloads and displays the avatar.
5. If the user does not have an avatar, it displays a default avatar.
6. If the request to the Discord API fails, it displays a random default avatar.

## License

This project is licensed under the MIT License.