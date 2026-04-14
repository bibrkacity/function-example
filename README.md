# The example of moving some logic to MySQL. Laravel 13, php 8.5, MySQL 8.4

<!-- TOC -->
* [The example of moving some logic to MySQL. Laravel 13, php 8.5, MySQL 8.4](#the-example-of-moving-some-logic-to-mysql-laravel-13-php-85-mysql-84)
  * [Installation](#installation)
  * [Explanation of key points](#explanation-of-key-points)
  * [MySQL console](#mysql-console)
  * [Unit testing of the REST API](#unit-testing-of-the-rest-api)
<!-- TOC -->

This is an example of moving logic of a user's zodiac sign setting to a MySQL-loaded function.
MySQL will set zodiac signs for the users, not PHP code. 
It can be crucial if a Laravel project is not a single client of the database.
In any case, the PHP code becomes cleaner.

I will be glad to see your issues or your pull requests.

## Installation

1. Clone this repository (https://github.com/bibrkacity/function-example.git) and `cd` into root folder ( *your-path*/function-example)
2. Copy `.env.example` to `.env`
3. Run `composer install`
4. Run `./vendor/bin/sail up`
5. Run `./vendor/bin/sail artisan migrate`
6. Run `./vendor/bin/sail artisan db:seed`
7. Run `php artisan l5-swagger:generate`

Now you can visit the Swagger UI at http://127.0.0.1:8000/api/docs (authorization is not required for this example).

Now you can use Swagger UI to test your API.

## Explanation of key points

The logic of the zodiac sign setting is moved to a MySQL-loaded function "zodiac()". It created by the migration file `0001_01_01_000003_create_zodiac_function.php`.

This function is called in the triggers of the table `users`. They are created by the migration file `0001_01_01_000005_create_users_trigger.php`.
Thiggers set the zodiac sign for the user by `birth_date` column before update and insert. If the query tries to set the invalid zodiac sign for the user, triggers will correct it without any warning or error.

PHP code does not set the zodiac sign for the user. But it calls the method refresh() of the User model for get the updated zodiac sign.

## MySQL console

run `./vendor/bin/sail mysql` to open MySQL console. 

Also, you can use `mysql -h0.0.0.0 -P3307 -uroot -p` (password `password`) to connect to MySQL.

## Unit testing of the REST API

Run `php artisan test` to run unit tests for the REST API endpoints.








