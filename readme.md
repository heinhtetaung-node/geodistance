# Project installation

## By Using Docker
- docker-compose up -d
- bash start.sh -d

can run in localhost:8080 or MachineIP:8080

can run automatic testing by running this command but it is already done in start.sh
- docker-compose exec app vendor/bin/phpunit


## Without Docker
- bash start.sh
- php artisan serve --port=8080

can run in localhost:8080

can run automatic testing by running this command but it is already done in start.sh
- vendor/bin/phpunit

