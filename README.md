# Larapets

A simple pet-owning sim inspired by my childhood memories of Neopets and Tamagotchi built in Laravel with Vue.

## Start up

Clone the repository and navigate into the project directory.

```sh
git clone https://github.com/MapleThunder/Larapets.git
cd Larapets
```

Create the `.env` file by copying the `.env.example` then install the dependencies.

```sh
composer install
npm install && npm run build
```

Copy the `.env.example` to create an `.env` file and generate an app key.

```sh
cp .env.example .env
php artisan key:generate
```

## Running locally using Laravel Sail

> Requires Docker to be installed

To get started using [Laravel Sail](https://laravel.com/docs/12.x/sail#main-content) in this project install it with artisan.

```sh
php artisan sail:install
```

Using the space bar, uncheck the `mysql` option and check the `pgsql` option. Then prepare the database using artisan through sail.

```sh
./vendor/bin/sail artisan migrate
```

Once the database is prepared, start the containers using the `up` command. Passing the `-d` flag will start the containers detached so it doesn't take over the terminal window.

```sh
./vendor/bin/sail up -d
```
