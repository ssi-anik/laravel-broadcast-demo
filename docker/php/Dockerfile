FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y libpq-dev libpng-dev curl nano unzip zip git jq supervisor

RUN docker-php-ext-install pdo_pgsql

RUN pecl install -o -f redis

RUN docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY /docker/php/conf.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html