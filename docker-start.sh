#!/bin/bash
docker run --rm --interactive --tty \
    --volume $PWD:/app \
    composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate:refresh