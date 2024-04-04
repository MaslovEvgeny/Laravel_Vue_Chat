FROM php:8.2-fpm

WORKDIR /var/www/laravel

RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql

RUN chown -R www-data:www-data /var/www/laravel && \
    chmod -R 777 /var/www/laravel

