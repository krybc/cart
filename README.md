# Simple Symfony 4 cart

## Requirements

- composer
- php >= 7.1
- webpack
- mysql >= 5.6
- nodeJS (8.11.1 and above)

## Installation

- run `git clone https://github.com/kamil-rybczynski/cart.git` command
- run `composer install` command
- run `npm install` command to install frontend dependencies
- rename `.env.dist` file to `.env` and type your database connection data
- run `php/bin console doctrine:migrations:migrate` to add database tables
- run `php bin/console doctrine:fixtures:load` to load default products, payments, shipments and discount codes data
- map host to `public` folder
- enjoy that shit in web browser

