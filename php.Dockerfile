FROM php:7.3-apache-buster

COPY php.ini /usr/local/etc/php/php.ini
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    vim \
    sendmail

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-enable zip