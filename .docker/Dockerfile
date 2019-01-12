FROM php:7.1.8-apache

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/app

RUN docker-php-ext-install mbstring pdo pdo_mysql
RUN chown -R www-data:www-data /srv/app && a2enmod rewrite
#RUN chgrp -R www-data storage bootstrap/cache
#RUN chmod -R ug+rwx storage bootstrap/cache
#RUN setfacl -Rdm u:nginx:rwx,u:systemuser:rwx storage
#RUN setfacl -Rm u:nginx:rwx,u:systemuser:rwx storage
#RUN chmod -R 777 /srv/app/storage

#CMD ["/bin/bash", "/srv/app/start.sh"]
