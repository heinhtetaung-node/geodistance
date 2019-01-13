#!/bin/bash
if [ "$1" != "" ]; then
if [ "$1" == "-d" ]; then
docker run --rm --interactive --tty \
--volume $PWD:/app \
composer install
docker-compose exec app php artisan key:generate
#run unit test
docker-compose exec app vendor/bin/phpunit
docker-compose exec app php artisan migrate:refresh
fi	
else
composer install
php artisan key:generate
#run unit test
vendor/bin/phpunit
php artisan migrate:refresh
fi