FROM php:8.1-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli \
 && a2enmod rewrite

WORKDIR /var/www/html

COPY public    /var/www/html
COPY source       /var/www/source
