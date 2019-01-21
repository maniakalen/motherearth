FROM php:7.3.1-apache-stretch

COPY ./vhost-docker.conf /etc/apache2/sites-enabled/vhost-docker.conf
RUN docker-php-ext-install pdo_mysql mysqli
RUN ["a2enmod","rewrite"]
