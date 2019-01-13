FROM php:7.1.8-apache

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/app

RUN docker-php-ext-install mbstring pdo pdo_mysql
RUN chown -R www-data:www-data /srv/app
RUN chmod -R 777 /srv/app/storage && a2enmod rewrite