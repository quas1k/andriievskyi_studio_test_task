# Bot

The script was created to constantly receive and save cryptocurrency rates.
Coingecko and Cryptorank services are currently supported

This script is a simple bot that uses a while-loop to continuously check the current memory usage, and restarts the script if the usage exceeds a certain threshold. The script also calls the handle() method of a Kernel object, which starts various services, such as CoingeckoService and CryptorankService, based on the configuration. These services make HTTP requests to external APIs to retrieve data and handle the response data.

## Getting Started

To run this script, you will need to have the following installed on your machine:
- PHP
- Composer
- PostgreSQL

To install the dependencies, run the following command:
```sh
composer install
```

To run the script, use the following command:
```sh
php bot.php
```

The script will continuously run, making requests to the external APIs, and handling the response data. You can configure the services that the script will run, and the pairs and currencies that will be used in the requests, in the config.ini file.

## Config
You can configure the necessary parameters, database connection, api key in the `config.ini` file

An example configuration file can be found in this repository, you can also use my Cryptorank service api key, I will leave it in the configuration

## File Structure

Here's an overview of the file structure for this project:

- `bot.php` - The main script file that runs the bot. It continuously checks the current memory usage, and restarts the script if the usage exceeds a certain threshold. It also calls the handle() method of the Kernel object, which starts various services.
- `bot/Kernel.php` - The Kernel class that contains the handle() method. This method starts various services based on the configuration.
- `bot/Services/ServiceInterface.php` - The interface that all services must implement.
- `bot/Services/BaseService.php` - The base class for all services. It contains common code that all services can use.
- `bot/Services/CoingeckoService.php` - A service that makes requests to the Coingecko API.
- `bot/Services/CryptorankService.php` - A service that makes requests to the Cryptorank API.
- `bot/Config/Config.php` - Class for working with the configuration file.
- `bot/Database/Database.php` - Class for working with the database.
- `config.ini` - A configuration file that contains settings for the script.

## Additional

I also provided two files

- `bot.service`
- `schema.sql`

`bot.service` file configuration provided for systemd

`schema.sql` file provided for create table in database

## Logs

Memory usage information is logged in the `bot.log` file