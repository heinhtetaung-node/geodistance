#!/bin/bash
docker run --rm --interactive --tty \
    --volume $PWD:/app \
    composer install
docker-compose exec app php artisan key:generate

#run php test
docker-compose exec app vendor/bin/phpunit

docker-compose exec app php artisan migrate:refresh

