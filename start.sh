#!/bin/bash

# Comment

composer install
composer require predis/predis

docker-compose up -d
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate:refresh